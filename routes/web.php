<?php

use App\Http\Controllers\AllocateController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CallsContoller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('/');
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('/dashboard');

    Route::get('/users', [UserController::class, 'Users'])->name('/users');
    Route::get('/create-users', [UserController::class, 'createUser'])->name('/create-users');
    Route::post('/user-store', [UserController::class, 'storeUser'])->name('/user-store');
    Route::get('/user-edit', [UserController::class, 'editUser'])->name('/user-edit');
    Route::post('/user-update', [UserController::class, 'updateUser'])->name('/user-update');
    
    // Calls

    Route::get('/create-call', [CallsContoller::class, 'createCall'])->name('/create-call');
    Route::get('/open-calls', [CallsContoller::class, 'openCalls'])->name('/open-calls');
    Route::get('/edit-call', [CallsContoller::class, 'editCall'])->name('/edit-call');
    Route::post('/update-call', [CallsContoller::class, 'updateCall'])->name('/update-call');
    Route::post('/create-store', [CallsContoller::class, 'storeCall'])->name('/create-store');
    Route::post('/allocate-engineer', [AllocateController::class, 'allocateEngineer'])->name('/allocate-engineer');

    Route::post('/add-new-status', [CallsContoller::class, 'addNewStatus'])->name('/add-new-status');


//Brands
Route::get('/dropdown-brands', [BrandController::class, 'brandsForDropDown'])->name('/dropdown-brands');
Route::get('/load-brands', [BrandController::class, 'loadBrands'])->name('/load-brands');
Route::get('/load-cats', [ProductCategoryController::class, 'loadPcats'])->name('/load-cats');

//Customers
Route::post('/update-customer', [CustomerController::class, 'updateCustomer'])->name('/update-customer');


Route::get('/customers', [CustomerController::class, 'index'])->name('/customers');


});
