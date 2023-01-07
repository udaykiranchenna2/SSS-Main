<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Call;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\CallStatus;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CallsContoller extends Controller
{
    public function createCall(Request $request)
    {

        $brands = BrandController::brandsForDropDown();
        $pcats = ProductCategoryController::pcatsForDropDown();

        if($request->customer)
        {
            $customer  = Customer::where('customerid', $request->customer)->first();
            if(!$customer)
            {
                $customer = null;
            }
        }else{
            $customer = null;
        }

        return Inertia::render('Calls/CreateCall', [
            'brands'=>$brands,
            'pcats'=>$pcats,
            'customer'=>$customer,
        ]);
    }
    public  function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    
    public function storeCall(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'mobile1' => 'required',
            'calltype' => 'required',
        ]);

        if($request->customerid)
        {
            $customer = Customer::where('customerid',$request->customerid)->first();
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
        }else{

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
            $customer->customerid = 'CUST_'.$this->generateRandomString(8);
            $customer->addedby = Auth::user()->id;
            $customer->save();

        }

         $call = new Call();
         $call->requestdate = Carbon::now();
         $call->requestno ='Call_'.$this->generateRandomString(10);
         $call->customerid =$customer->customerid;
         $call->calltype =$request->calltype;
         
         if($request->brandname == 'Other'){
            $checkBrand = Brand::where('brandname',$request->extrabrand)->first();
            $brand = new Brand();

            if($checkBrand){
                $brand->brandname = $request->extrabrand;
            }else{
                $brand->brandname = $request->extrabrand;
                $brand->status = true;
                $brand->save();
            }
          
            $call->brand =$brand->brandname;
         }else{
            $call->brand =$request->brandname;
         }
         if($request->productcategory == 'Other'){
            $checkproductcategory = ProductCategory::where('productcategory',$request->extraproductcategory)->first();
            $productcategory = new ProductCategory();

            if($checkproductcategory){
                $productcategory->productcategory = $request->extraproductcategory;
            }else{
                $productcategory->productcategory = $request->extraproductcategory;
                $productcategory->status = true;
                $productcategory->save();
            }
            $call->productcategory = $productcategory->productcategory;
          
         }else{
            $call->productcategory =$request->productcategory;
         }
         $call->description =$request->description;
         $call->addedby =Auth::user()->id;
         $call->save();

         $status = New CallStatus();
         $status->callid = $call->requestno;
         $status->status = 'Registered';
         $status->type = 'normal';
         $status->mode = 1;
         $status->level = 1;
         $status->addedby = Auth::user()->id;
         $status->save();

            return response()->json(['status'=>true]);
    
    }
    public function openCalls(Request $request)
    {
    //    return $calls = Call::where('status', 'open')->paginate(10);
    $brands = BrandController::brandsForDropDown();
    $pcats = ProductCategoryController::pcatsForDropDown(); 
        $query = Call::query();
      $calls =   $query->with('customer')->with('statuses')->with('assignees')->with('user')->paginate(10);
      $engineers =   User::where('role', 2)->pluck('name','id');
      $assignedusers =   User::where('role', 2)->select('name','id')->get();
        return Inertia::render('Calls/Calls', [
                'calls'=> $calls,
                'engineers'=>$engineers,
                'assignedusers'=>$assignedusers,
                'brands'=>$brands,
                 'pcats'=>$pcats,
        ]);
    }
}
