<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Artisan;
Route::get('/clear-cache', function () {
  // Clear route cache
  Artisan::call('route:clear'); 
  
  // Cache routes
  Artisan::call('route:cache');

  return view('test');
}); 

Route::get('admin/', function () {
    return view('auth.login');
});

Route::get('hospital/', function () {
  return view('auth.login');
});

Route::get('about-us/', function () {
  return view('website.about');
})->name("about.us");
Route::get('contact-us/', function () {
  return view('website.contact');
})->name("contact.us");
Route::get('abt/', function () {
  return view('website.home2');
});
//-------------------------------------Custom Routes
Route::post('/getStateCity',[AjaxController::class,'getStateCity'])->name("getStateCity");
Route::post('/logout',[AjaxController::class,'Logout'])->name("logout"); 
Route::post('/login/',[AjaxController::class,'login'])->name("login"); 


//==================================>Website Routes
Route::get('/',[WebController::class,'Home_View'])->name('welcome'); 
Route::get('all-hospital/',[WebController::class,'All_Hospital'])->name('all.hospital'); 
Route::get('all-doctor/',[WebController::class,'All_Doctor'])->name('all.doctor'); 



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
  Route::get('/admin/hospital/{id?}', [VendorController::class, 'ShowHospital'])->name('admin.hospital');
  Route::post('/admin/hospital/add', [VendorController::class, 'AddHospital'])->name('admin.hospital.add');
  Route::post('/admin/hospital/update', [VendorController::class, 'UpdateHospital'])->name('admin.hospital.update');

  //=======Doctor Module  admin.doctor
  Route::get('/admin/doctor/{id?}', [VendorController::class, 'ShowDoctor'])->name('admin.doctor');
  Route::get('/admin/new/doctor/{id?}', [VendorController::class, 'NewDoctor'])->name('admin.new.doctor');
  Route::get('/admin/edit/doctor/{id?}', [VendorController::class, 'NewDoctor'])->name('admin.edit.doctor');
  Route::post('/admin/doctor/add', [VendorController::class, 'AddDoctor'])->name('admin.doctor.add');
  Route::post('/admin/doctor/update', [VendorController::class, 'UpdateDoctor'])->name('admin.doctor.update');

  //Slider
  Route::get('admin/slider/{id?}',[VendorController::class,'showSlider'])->name('admin.slider');
  Route::post('admin/add/slider',[VendorController::class,'AddSlider'])->name('admin.add.slider');
  Route::get('/admin/delete/slider/{id?}',[VendorController::class,'DeleteSlider'])->name('admin.delete.slider');
/*category*/
  Route::get('/admin/symptom/{id?}',[VendorController::class,'showSymptom'])->name('admin.symptom');
  Route::get('/admin/radiology/category/{id?}',[VendorController::class,'showRadiologyCat'])->name('admin.radiology.category');
  
  Route::get('/admin/category/{id?}',[VendorController::class,'showCategory'])->name('admin.category');
  Route::post('/admin/category/add',[VendorController::class,'insertCategory'])->name('admin.category.add');
  Route::post('/admin/category/edit/',[VendorController::class,'editCategoryFinal'])->name('admin.category.edit');
  Route::get('/admin/category/delete/{id}',[VendorController::class,'deleteCategory'])->name('admin.category.delete');
  Route::get('/admin/category/status/{id}',[VendorController::class,'categoryChangeStatus'])->name('admin.category.status');
  Route::get('/admin/all/category/{keyword?}',[VendorController::class,'categorySearch'])->name('admin.category.all');

});
  


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});



Route::middleware(['auth', 'hospital'])->prefix('hospital')->name('hospital.')->group(function () {

  Route::get('/', [HomeController::class, 'hospital'])->name('dashboard');
  Route::get('doctor-index', [HospitalController::class, 'index'])->name('doctor.index');
  Route::get('doctor-create', [HospitalController::class, 'create'])->name('doctor.create');

  Route::post('doctor-store', [HospitalController::class, 'store'])->name('doctor.store');

});

