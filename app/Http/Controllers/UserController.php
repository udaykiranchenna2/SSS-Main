<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Collection;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;

class UserController extends Controller {
    public function Users(Request $request) {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        $users = QueryBuilder::for(User::class)->defaultSort('name')
                ->allowedSorts(['name', 'email', 'lastname','role'])
                ->allowedFilters(['name', 'email', 'lastname', $globalSearch])
                ->paginate()
                ->withQueryString();
       

        return Inertia::render('Users/Users', [
            'users' => $users,
        ])->table(function (InertiaTable $table) {
            $table
                ->withGlobalSearch()
                ->defaultSort('name')
                ->column(key:'name', searchable:true, sortable:true, canBeHidden:false)
                ->column(key:'lastname', searchable:true, sortable:true, canBeHidden:false)
                ->column(key:'email', searchable:true, sortable:true)
                ->column(key:'mobile', searchable:true, )
                ->column(key:'role', searchable:true,sortable:true)
                ->column(label:'Actions')
                ;
        }
        );

    }

    public function createUser() {
        return Inertia::render('Users/create');
    }
    public function storeUser(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'password' => 'required_if:role,1',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->role = $request->role;
        if ($request->role == 1) {
            $user->password = Hash::make($request->password);

        } else {
            $user->password = Hash::make('9959501160');
        }
        if( $user->save())
        {
         return response()->json(['status'=>true]);
        }else{
          return response()->json(['status'=>false]);
  
        }
    }
    public function editUser(Request $request) {

        $user = User::find($request->id);
        return Inertia::render('Users/edit',[
            'user'=>$user,
        ]);
    }

    public function updateUser(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'role' => 'required',
            'password' => 'required_if:role,1',
        ],
        [
            'password' => 'The password field is required!',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->role = $request->role;
        if ($request->role == 1) {
            $user->password = Hash::make($request->password);

        } else {
            $user->password = Hash::make('9959501160');
        }
      if( $user->save())
      {
       return response()->json(['status'=>true]);
      }else{
        return response()->json(['status'=>false]);

      }
    }
}
