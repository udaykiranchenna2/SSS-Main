<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Call;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CallStatus;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class CallsContoller extends Controller {
	public function openPDF(Request $request) 
		{
			$invoiceItems = [
				['item' => 'Website Design', 'amount' => 50.50],
				['item' => 'Hosting (3 months)', 'amount' => 80.50],
				['item' => 'Domain (1 year)', 'amount' => 10.50]
			];
			$invoiceData = [
				'invoice_id' => 123,
				'transaction_id' => 1234567,
				'payment_method' => 'Paypal',
				'creation_date' => date('M d, Y'),
				'total_amount' => 141.50
			];
			$pdf = PDF::loadView('jobSheets.emptySheet')->setOptions(['defaultFont' => 'sans-serif']);
			return $pdf->download('invoice.pdf');
			return view('jobSheets.emptySheet',['invoiceItems' => $invoiceItems,'invoiceData' => $invoiceData]);
		}
	public function createCall(Request $request) {

		$brands = BrandController::brandsForDropDown();
		$pcats = ProductCategoryController::pcatsForDropDown();

		if ($request->customer) {
			$customer = Customer::where('customerid', $request->customer)->first();
			if (!$customer) {
				$customer = null;
			}
		} else {
			$customer = null;
		}

		return Inertia::render('Calls/CreateCall', [
			'brands' => $brands,
			'pcats' => $pcats,
			'customer' => $customer,
		]);
	}
	public function generateRandomString($length = 10) {
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}

	public function storeCall(Request $request) {
		$this->validate($request, [
			'firstname' => 'required',
			'address' => 'required',
			'city' => 'required',
			'mobile1' => 'required',
			'calltype' => 'required',
		]);

		if ($request->customerid) {
			$customer = Customer::where('customerid', $request->customerid)->first();

			$customer->firstname = $request->firstname;
			$customer->lastname = $request->lastname;
			$customer->email = $request->email;
			$customer->address = $request->address;
			$customer->city = $request->city;
			$customer->state = $request->state;
			$customer->country = $request->country;
			$customer->area = $request->area;
			$customer->pincode = $request->pincode;
			$customer->mobile1 = $request->mobile1;
			$customer->mobile2 = $request->mobile2;
			$customer->addedby = Auth::user()->id;
			$customer->save();
		} else {


				
			$customer = new Customer();
			$customer->firstname = $request->firstname;
			$customer->lastname = $request->lastname;
			$customer->email = $request->email;
			$customer->address = $request->address;
			$customer->city = $request->city;
			$customer->state = $request->state;
			$customer->country = $request->country;
			$customer->area = $request->area;
			$customer->pincode = $request->pincode;
			$customer->mobile1 = $request->mobile1;
			$customer->mobile2 = $request->mobile2;
			$customer->customerid = 'CUST_' . $this->generateRandomString(8);
			$customer->addedby = Auth::user()->id;
			$customer->save();

		};
		$Flatter =  mb_strtoupper(mb_substr($request->calltype, 0, 1));
		$callid = $Flatter . substr(date('Y'), -2) . date('md') . Call::whereDate('created_at', today())->count()+1;

		$call = new Call();
		$call->requestdate = Carbon::now();
		$call->requestno =$callid;
		$call->customerid = $customer->customerid;
		$call->calltype = $request->calltype;
		$call->visitdate = Carbon::parse($request->visitdate);
		$fileArray = [];
		if($request->file('files') ){
			foreach ($request->file('files') as $file) {
				$file_name = time().'_'.$file->getClientOriginalName();
                $file_path = $file->storeAs('/public/callfiles', $file_name);
                $fileArray[] = time().'_'.$file->getClientOriginalName();
				$call->files = json_encode($fileArray);
			}
		}
			
		if ($request->brandname == 'Other') {
			$checkBrand = Brand::where('brandname', $request->extrabrand)->first();
			$brand = new Brand();

			if ($checkBrand) {
				$brand->brandname = $request->extrabrand;
			} else {
				$brand->brandname = $request->extrabrand;
				$brand->status = true;
				$brand->save();
			}

			$call->brand = $brand->brandname;
		} else {
			$call->brand = $request->brandname;
		}
		if ($request->productcategory == 'Other') {
			$checkproductcategory = ProductCategory::where('productcategory', $request->extraproductcategory)->first();
			$productcategory = new ProductCategory();

			if ($checkproductcategory) {
				$productcategory->productcategory = $request->extraproductcategory;
			} else {
				$productcategory->productcategory = $request->extraproductcategory;
				$productcategory->status = true;
				$productcategory->save();
			}
			$call->productcategory = $productcategory->productcategory;

		} else {
			$call->productcategory = $request->productcategory;
		}
		$call->description = $request->description;
		$call->addedby = Auth::user()->id;
		$call->save();

		$status = New CallStatus();
		$status->callid = $call->requestno;
		$status->status = 'Registered';
		$status->type = 'normal';
		$status->mode = 1;
		$status->level = 1;
		$status->addedby = Auth::user()->id;
		$status->save();
		return response()->json(['status' => true]);

	}
    public function closedCalls(Request $request)
    {
		$brands = BrandController::brandsForDropDown();
		$pcats = ProductCategoryController::pcatsForDropDown();
		$query = Call::query();
		if($request->customerid != null && $request->customerid != ''){
			$query->where('customerid', $request->customerid);
		}
		if($request->requestno != null && $request->requestno != ''){
			$query->where('requestno', $request->requestno);
		}
		if($request->requestno != null && $request->requestno != ''){
			$query->where('requestno', $request->requestno);
		}
		if($request->calltype != null && $request->calltype != ''){
			$query->where('calltype', $request->calltype);
		}
		if($request->name != null && $request->name != ''){
			$name = $request->name;
			$query->whereHas('customer', function($query)  use ($name){
				$query->where('firstname', 'like', '%'.$name.'%')->orWhere('lastname','like', '%'.$name.'%');
			});
		}
		if($request->from != null && $request->from != ''){
			$query->where('requestdate', '>=', $request->from);
		}
		if($request->to != null && $request->to != ''){
			$query->where('requestdate', '<=', $request->to);
		}

		 $calls = $query->where('status','closed')
		 ->with('customer')->with('statuses')->with('assignees')->with('user')->paginate(10);
		 $query->toSql();
		$engineers = User::where('role', 2)->pluck('name', 'id');
		$assignedusers = User::where('role', 2)->select('name', 'id')->get();
		return Inertia::render('Calls/closedCalls', [
			'calls' => $calls,
			'engineers' => $engineers,
			'assignedusers' => $assignedusers,
			'brands' => $brands,
			'pcats' => $pcats,
			'request'=>$request
		]);

		
    }
	
	public function openCalls(Request $request) {
		//    return $calls = Call::where('status', 'open')->paginate(10);
		$brands = BrandController::brandsForDropDown();
		$pcats = ProductCategoryController::pcatsForDropDown();
		$query = Call::query();
		if($request->customerid != null && $request->customerid != ''){
			$query->where('customerid', $request->customerid);
		}
		if($request->requestno != null && $request->requestno != ''){
			$query->where('requestno', $request->requestno);
		}
		if($request->requestno != null && $request->requestno != ''){
			$query->where('requestno', $request->requestno);
		}
		if($request->calltype != null && $request->calltype != ''){
			$query->where('calltype', $request->calltype);
		}
		if($request->name != null && $request->name != ''){
			$name = $request->name;
			$query->whereHas('customer', function($query)  use ($name){
				$query->where('firstname', 'like', '%'.$name.'%')->orWhere('lastname','like', '%'.$name.'%');
			});
		}
		if($request->from != null && $request->from != ''){
			$query->where('requestdate', '>=', $request->from);
		}
		if($request->to != null && $request->to != ''){
			$query->where('requestdate', '<=', $request->to);
		}

		 $calls = $query->orderBy('created_at','DESC')->where('status','open')
		 ->with('customer')->with('statuses')->with('assignees')->with('user')->paginate(10);
		 $query->toSql();
		$engineers = User::where('role', 2)->pluck('name', 'id');
		$assignedusers = User::where('role', 2)->select('name', 'id')->get();
		return Inertia::render('Calls/Calls', [
			'calls' => $calls,
			'engineers' => $engineers,
			'assignedusers' => $assignedusers,
			'brands' => $brands,
			'pcats' => $pcats,
			'request'=>$request
		]);
	}
	public function dueCalls(Request $request) {
		//    return $calls = Call::where('status', 'open')->paginate(10);
		$brands = BrandController::brandsForDropDown();
		$pcats = ProductCategoryController::pcatsForDropDown();
		$query = Call::query();
		if($request->customerid != null && $request->customerid != ''){
			$query->where('customerid', $request->customerid);
		}
		if($request->requestno != null && $request->requestno != ''){
			$query->where('requestno', $request->requestno);
		}
		if($request->requestno != null && $request->requestno != ''){
			$query->where('requestno', $request->requestno);
		}
		if($request->calltype != null && $request->calltype != ''){
			$query->where('calltype', $request->calltype);
		}
		if($request->name != null && $request->name != ''){
			$name = $request->name;
			$query->whereHas('customer', function($query)  use ($name){
				$query->where('firstname', 'like', '%'.$name.'%')->orWhere('lastname','like', '%'.$name.'%');
			});
		}
			$query->whereHas('payment', function($query){
				$query->where('paymentStatus', 'Due');
			});
		
		if($request->from != null && $request->from != ''){
			$query->where('requestdate', '>=', $request->from);
		}
		if($request->to != null && $request->to != ''){
			$query->where('requestdate', '<=', $request->to);
		}

		 $calls = $query->where('status','closed')
		 ->with('customer')->with('statuses')->with('assignees')->with('user')->paginate(10);
		 $query->toSql();
		$engineers = User::where('role', 2)->pluck('name', 'id');
		$assignedusers = User::where('role', 2)->select('name', 'id')->get();
		return Inertia::render('Calls/DueCalls', [
			'calls' => $calls,
			'engineers' => $engineers,
			'assignedusers' => $assignedusers,
			'brands' => $brands,
			'pcats' => $pcats,
			'request'=>$request
		]);
	}
	public function editCall(Request $request) {
		$query = Call::query()->where('requestno', $request->callid);
		$call = $query->with('customer')->with('statuses')->with('assignees')->with('user')->first();
		$engineers = User::where('role', 2)->pluck('name', 'id');
		$assignedusers = User::where('role', 2)->select('name', 'id')->get();
		$brands = BrandController::brandsForDropDown();
		$pcats = ProductCategoryController::pcatsForDropDown();
		$statuses = CallStatus::where('callid', $request->callid)->orderBy('created_at', 'DESC')->get();
		return Inertia::render('Calls/edit-calls', [
			'call' => $call,
			'engineers' => $engineers,
			'assignedusers' => $assignedusers,
			'brands' => $brands,
			'pcats' => $pcats,
			'statuses' => $statuses,
		]);

	}
	public function updateCall(Request $request) {
		$this->validate($request, [
			'calltype' => 'required',
		]);

		$call = Call::where('requestno', $request->requestno)->first();
		$call->calltype = $request->calltype;
		$call->visitdate = Carbon::parse($request->visitdate);

		if ($request->brandname == 'Other') {
			$checkBrand = Brand::where('brandname', $request->extrabrand)->first();
			$brand = new Brand();

			if ($checkBrand) {
				$brand->brandname = $request->extrabrand;
			} else {
				$brand->brandname = $request->extrabrand;
				$brand->status = true;
				$brand->save();
			}

			$call->brand = $brand->brandname;
		} else {
			$call->brand = $request->brandname;
		}
		if ($request->productcategory == 'Other') {
			$checkproductcategory = ProductCategory::where('productcategory', $request->extraproductcategory)->first();
			$productcategory = new ProductCategory();

			if ($checkproductcategory) {
				$productcategory->productcategory = $request->extraproductcategory;
			} else {
				$productcategory->productcategory = $request->extraproductcategory;
				$productcategory->status = true;
				$productcategory->save();
			}
			$call->productcategory = $productcategory->productcategory;

		} else {
			$call->productcategory = $request->productcategory;
		}
		$call->description = $request->description;
		$call->save();
		return response()->json(['status'=>true]);
	}
	public function addNewStatus(Request $request) {

		$this->validate($request, [
			'status' => 'required',
			'visitdate' => 'required',
		]);
        $data = [];

		if ($request->hasfile('attachments')) {
			foreach ($request->file('attachments') as $file) {
				$name = time() . '.' . $file->extension();
				$path = $file->storeAs('public/attachments', $name);
				$data[] = $name;
			}
		}

		$status = New CallStatus();

		$status->attachments = json_encode($data);
		$status->callid = $request->requestno;
		$status->status = $request->status;
		$status->visitdate = $request->visitdate?Carbon::parse($request->visitdate):null;
		$status->sub_status = $request->sub_status;
		$status->remark = $request->remark;
		$status->status_json = null;
		if ($status->status == 'Call Close') {
        $call =  Call::where('requestno', $request->requestno)->update(['status'=>'closed']);
			$status->type = 'Call Close';
		} else {
			$status->type = 'onVisit';
		}
		$status->mode = 1;
		$status->level = CallStatus::where('callid', $request->requestno)->count()+1;
		$status->addedby = Auth::user()->id;
		$status->save();
        if($status->save() && $status->status == 'Call Close' && $request->amount){
            $payment = new Payment();
            $payment->callid =$request->requestno;
            $payment->type ='charge';
            $payment->mode =$request->mode;
            $payment->amount =$request->amount;
            $payment->paid =$request->paid;
            $payment->paymentStatus =$request->paymentStatus;
            $payment->save();
            
        }
	}
	public function pdfJobsheet(Request $request) {
		

		 $brands = BrandController::brandsForDropDown();
		$pcats = ProductCategoryController::pcatsForDropDown();
		$query = Call::query();
		$calls = $query->where('status','closed')->with('customer')->with('statuses')->with('assignees')->with('user')->paginate(10);
		$engineers = User::where('role', 2)->pluck('name', 'id');
		$assignedusers = User::where('role', 2)->select('name', 'id')->get();
		return Inertia::render('Calls/JobSheet', [
			'calls' => $calls,
			'engineers' => $engineers,
			'assignedusers' => $assignedusers,
			'brands' => $brands,
			'pcats' => $pcats,
		]);
	}

}
