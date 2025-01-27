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
  Route::post('/admin/hospital/add', [VendorController::class, 'AddHospital'])->name('admin.hospital.add');
  Route::post('/admin/store/update', [VendorController::class, 'UpdateStore'])->name('admin.store.update');

  //Slider
  Route::get('admin/all/slider/{id?}',[App\Http\Controllers\vendorController::class,'showSlider'])->name('admin.all.slider');
  Route::post('admin/add/slider',[App\Http\Controllers\vendorController::class,'AddSlider'])->name('admin.add.slider');
  Route::get('/admin/delete/slider/{id?}',[App\Http\Controllers\vendorController::class,'DeleteSlider'])->name('admin.delete.slider');
/*category*/
  Route::get('/admin/symptom/{id?}',[App\Http\Controllers\vendorController::class,'showSymptom'])->name('admin.symptom');
  
  Route::get('/admin/category/{id?}',[App\Http\Controllers\vendorController::class,'showCategory'])->name('admin.category');
  Route::post('/admin/category/add',[App\Http\Controllers\vendorController::class,'insertCategory'])->name('admin.category.add');
  Route::post('/admin/category/edit/',[App\Http\Controllers\vendorController::class,'editCategoryFinal'])->name('admin.category.edit');
  Route::get('/admin/category/delete/{id}',[App\Http\Controllers\vendorController::class,'deleteCategory'])->name('admin.category.delete');
  Route::get('/admin/category/status/{id}',[App\Http\Controllers\vendorController::class,'categoryChangeStatus'])->name('admin.category.status');
  Route::get('/admin/all/category/{keyword?}',[App\Http\Controllers\vendorController::class,'categorySearch'])->name('admin.category.all');

});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

