<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Collection;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::paginate(10);
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('firstname', 'LIKE', "%{$value}%")
                        ->orWhere('lastname', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%")
                        ->orWhere('mobile1', 'LIKE', "%{$value}%")
                        ->orWhere('mobile2', 'LIKE', "%{$value}%")
                        ->orWhere('city', 'LIKE', "%{$value}%")
                        ->orWhere('state', 'LIKE', "%{$value}%")
                        ->orWhere('country', 'LIKE', "%{$value}%")
                        ->orWhere('area', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        $users = QueryBuilder::for(Customer::class)
                ->allowedSorts(['firstname', 'email', 'lastname','role','created_at'])
                ->allowedFilters([
                    'firstname',
                    'lastname',
                    'email',
                    'customerid',
                    'address',
                    'city',
                    'state',
                    'country',
                    'area',
                    'mobile1',
                    'mobile2',
                      $globalSearch])
                ->orderBy('created_at', 'DESC')
                ->paginate()
                ->withQueryString();
       

        return Inertia::render('Customers/Customers', [
            'users' => $users,
        ])->table(function (InertiaTable $table) {
            $table
                ->withGlobalSearch()
                ->defaultSort('created_at')
                ->column(key:'firstname', searchable:true, sortable:true, canBeHidden:false)
                ->column(key:'lastname', searchable:true, sortable:true, canBeHidden:true,)
                ->column(key:'email', searchable:true, sortable:true)
                ->column(key:'mobile1', searchable:true, canBeHidden:true)
                ->column(key:'mobile2', searchable:true, canBeHidden:true)
                ->column(key:'address', searchable:true, canBeHidden:true)
                ->column(key:'city', searchable:true, canBeHidden:true, hidden: true,)
                ->column(key:'state', searchable:true, canBeHidden:true, hidden: true,)
                ->column(key:'country', searchable:true, canBeHidden:true, hidden: true,)
                ->column(key:'area', searchable:true, canBeHidden:true, hidden: true,)
                ->column(key:'created_at', searchable:true, sortable:true, hidden: true,)
                ->column(label:'Actions')
                ;
        }
        );
    
    }
    public function updateCustomer(Request $request)
    {
            $this->validate($request, [
                'firstname' => 'required',
                'address' => 'required',
                'city' => 'required',
                'mobile1' => 'required',
            ]);
            $customer = Customer::findOrFail($request->id);
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
            $customer->save();

        return response()->json(['status' => true]);
    }

}
