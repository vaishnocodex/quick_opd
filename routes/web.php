<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\VendorController;


Route::get('/', function () {
    return view('welcome');
});

//-------------------------------------Custom Routes
Route::post('/getStateCity',[AjaxController::class,'getStateCity'])->name("getStateCity");
Route::post('/logout',[AjaxController::class,'Logout'])->name("logout"); 
Route::post('/login/',[AjaxController::class,'login'])->name("login"); 
Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [VendorController::class, 'AdminHome'])->name('admin.home');


        
//==Store CRUD Operation
//Route::get('/admin/default/store/{id?}', [VendorController::class, 'SetDefaultStore'])->name('admin.default.store');
Route::get('/admin/hospital/{id?}', [VendorController::class, 'ShowStore'])->name('admin.hospital');
Route::post('/admin/store/add', [VendorController::class, 'AddStore'])->name('admin.store.add');
Route::post('/admin/store/update', [VendorController::class, 'UpdateStore'])->name('admin.store.update');

   // Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

