<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\DoctorSlotController;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HospitalController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AppointmentController;


Route::get('user/logout', function (Request $request) {
  Auth::logout();

  $request->session()->invalidate();
  $request->session()->regenerateToken();
  return redirect('login/user/');
})->name('user.logout');



Route::get('/clear-cache', function () {
  // Clear route cache
  Artisan::call('route:clear');

  // Cache routes
  Artisan::call('route:cache');

//   return view('test');
});

Route::get('admin/', function () {
    return view('auth.login');
});

Route::get('hospital/login', function () {
    return view('auth.hospital');
})->name('hospital.login');

Route::get('privacy-policy', function(){
   return view('website.privacy');
})->name('privacy-policy');

Route::get('faq', function(){
   return view('website.faq');
})->name('faq');

Route::get('terms-and-conditions', function(){
   return view('website.terms');
})->name('terms-and-conditions');
Route::get('/thank-you', function () {
  return view('website.thank-you');
})->name('thank-you');

Route::get('home3/',[WebController::class,'Home_View3'])->name('home3');
Route::get('about-us/', function () {
  return view('website.about');
})->name("about.us");
Route::get('contact-us/', function () {
  return view('website.contact');
})->name("contact.us");
Route::get('abt/', function () {
  return view('website.home2');
});
Route::post('/contact-submit', [AjaxController::class, 'submit'])->name('contact.submit');


//=========================================================//website routes
Route::get('/payment/gateway', [PaymentController::class, 'gateway'])->name('payment.gateway');

//-------------------------------------Custom Routes
Route::post('/login/admin',[VendorController::class,'loginAdmin'])->name("login.admin");
Route::post('/login/doctor',[DoctorController::class,'Login_Doctor'])->name("login.doctor");


Route::post('/getStateCity',[AjaxController::class,'getStateCity'])->name("getStateCity");
Route::post('/logout',[AjaxController::class,'Logout'])->name("logout");
Route::post('/hospital/logout',[AjaxController::class,'logoutHospital'])->name("hospital.logout");
Route::post('/login/',[AjaxController::class,'login'])->name("login");


//==================================>Website Routes
Route::get('login/user/',[WebController::class,'User_Login'])->name('login.user');
Route::get('register/user/',[WebController::class,'User_Register'])->name('register.user');

//user login register route
Route::post('user-register/submit/',[WebController::class,'User_RegisterSubmit'])->name('user-register.submit');
Route::post('user/do-login/',[WebController::class,'login_User_Submit'])->name('user.do-login');

Route::get('/',[WebController::class,'Home_View'])->name('welcome');
Route::get('specialist/all-doctor/{id?}',[WebController::class,'All_Specialist_Doctor'])->name('specialist.all-doctor');
Route::get('problem/all-doctor/{id?}',[WebController::class,'All_Specialist_Doctor'])->name('problem.all-doctor');
Route::get('hospital/all-doctor/{id?}',[WebController::class,'AllHospital_Doctor'])->name('hospital.all-doctor');
Route::get('doctor/detail/{id?}',[WebController::class,'SingleDoctorDetail'])->name('doctor.detail');


Route::get('all-hospital/',[WebController::class,'All_Hospital'])->name('all.hospital');
Route::get('all-doctor/',[WebController::class,'All_Doctor'])->name('all.doctor');

//===radiology website routes
Route::get('radiology/subcategory/{id?}',[WebController::class,'Radiology_Subcategory'])->name('radiology.subcategory');
Route::get('radiology/list/{id?}',[WebController::class,'All_Radiology'])->name('radiology.list');
Route::get('radiology/service-list/{id?}',[WebController::class,'Radiology_ServiceList'])->name('radiology.service-list');
Route::get('radiology/detail/{id?}',[WebController::class,'SingleRadiologyDetail'])->name('radiology.detail');

// web.php


Route::post('/check-availability', [WebController::class, 'checkAvailability'])->name('check.availability');
Route::post('/service-check-availability', [WebController::class, 'check_ServiceAvailability'])->name('service-check.availability');


//=========================================================//user logged routes
Route::middleware(['auth', 'CustomerMiddleware:user'])->group(function () {

  Route::post('/radiology-booking/submit', [WebController::class, 'Radiology_AddToCart'])->name('radiology-booking.submit');
  Route::post('/booking/submit', [WebController::class, 'addToCart'])->name('booking.submit');
  Route::post('/radiology-booking-payment-submit', [WebController::class, 'RadiologyPayment_SubmitPage'])->name('radiology-booking-payment-submit');
  Route::post('/booking-payment-submit', [WebController::class, 'Payment_SubmitPage'])->name('booking-payment-submit');
  Route::get('booking/checkout/{id?}',[WebController::class,'CheckoutPage'])->name('booking.checkout');



    Route::get('home/', [HomeController::class, 'index'])->name('home');

    Route::get('user/dashboard/',[WebUserController::class,'UserDashboard'])->name('user.dashboard');
    Route::post('user/update-password/',[WebUserController::class,'User_Update_Password'])->name('user.update-password');
    Route::post('user/updateProfile/',[WebUserController::class,'update_UserProfile'])->name('user.updateProfile');

});

//=========================================================//Doctor routes files
Route::middleware(['auth', 'user-access:doctor'])->group(function () {
    Route::get('/doctor/home', [DoctorController::class, 'doctorHome'])->name('doctor.home');
    // Route::get('/doctor/profile', [WebUserController::class, 'DoctorProfile'])->name('doctor.profile');
    // Route::post('/doctor/update-profile', [WebUserController::class, 'UpdateDoctorProfile'])->name('doctor.update-profile');
    // Route::post('/doctor/update-password', [WebUserController::class, 'UpdateDoctorPassword'])->name('doctor.update-password');
    // Route::get('/doctor/appointment', [WebUserController::class, 'DoctorAppointment'])->name('doctor.appointment');

});

  //=========================================================//Admin routes
  Route::middleware(['user-access:admin,admin'])->group(function () {


    Route::get('admin/profile', function () {
    return view('admin.profile');
     })->name('admin.profile');
  

     //firm  details
      Route::get('admin/firm-detail',[vendorController::class,'showFirmDetails'])->name('admin.firm-detail');
      Route::post('admin/firmdetails',[vendorController::class,'updateFirmDetails'])->name('admin.firmdetails.update');
    //balance sheet
    Route::get('admin/hospital/balance-sheet', [VendorController::class, 'HospitalLedgerReport'])->name('admin.hospital.balance-sheet');
    Route::post('/admin/hospital/balance-sheet-filter', [VendorController::class, 'HospitalLedgerReport'])->name('admin.hospital.balance-sheet-filter');

    //admin detail update
    Route::post('admin/profile-update', [VendorController::class, 'UpdateAdminDetail'])->name('admin.profile-update');

    Route::get('/admin/home', [VendorController::class, 'AdminHome'])->name('admin.home');

    Route::get('/doctor-slots/fetch', [DoctorSlotController::class, 'fetchSlots']);

    //======Radiology add
    Route::get('/admin/radiology/{id?}', [VendorController::class, 'ShowRAdiology'])->name('admin.radiology');
    Route::post('/admin/radiology/add', [VendorController::class, 'AddRadiology'])->name('admin.radiology.add');
    Route::post('/admin/radiology/update', [VendorController::class, 'UpdateHospital'])->name('admin.radiology.update');

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
    Route::get('/admin/doctor-slot-display', [DoctorSlotController::class, 'Admin_Doctor_SlotView'])->name('admin.doctor-slot-display');
    Route::post('/admin/doctor-slot-display-filter', [DoctorSlotController::class, 'Admin_Doctor_SlotView'])->name('admin.doctor-slot-display-filter');

    Route::get('/admin/doctor-schedule/{doctor_id?}', [VendorController::class, 'DoctorScheduleList'])->name('admin.doctor-schedule');
    //Route::get('/admin/doctor-schedules/{doctor_id?}', [VendorController::class, 'getDoctorSchedule'])->name('admin.doctor.schedules');
    Route::post('/admin/doctor-schedule-add', [VendorController::class, 'Add_DoctorSchedule'])->name('admin.doctor.schedule-add');

   

    //location update by id
    Route::get('/admin/hospital-map-location/{id?}', [VendorController::class, 'ShowLocation'])->name('admin.hospital-map-location');
    Route::post('/admin/update-hospital-map-location', [VendorController::class, 'Update_Hospital_location'])->name('admin.update-hospital-map-location');
    
    //=======>Admin doctor Slot admin.doctor.slot

    Route::get('/admin-doctor-slots', [DoctorSlotController::class, 'AdminDoctor_SlotForm'])->name('admin.doctor.slot');
    Route::post('/admin-doctor-slots/generate', [DoctorSlotController::class, 'Admin_generateSlots'])->name('admin-doctor-slots.generate');
    Route::post('/admin-doctor-slots/save-selection', [DoctorSlotController::class, 'Admin_SaveSelectedSlots'])->name('admin-doctor-slots.saveSelection');

    Route::get('/doctor-slots/create', [DoctorSlotController::class, 'showSlotForm'])->name('doctor-slots.create');
    Route::post('/doctor-slots/generate', [DoctorSlotController::class, 'generateSlots'])->name('doctor-slots.generate');
    Route::post('/doctor-slots/save-selection', [DoctorSlotController::class, 'saveSelectedSlots'])->name('doctor-slots.saveSelection');
    Route::get('/doctor-slots', [DoctorSlotController::class, 'index'])->name('doctor-slots.index');


      //Slider
      Route::get('admin/slider/{id?}',[VendorController::class,'showSlider'])->name('admin.slider');
      Route::post('admin/add/slider',[VendorController::class,'AddSlider'])->name('admin.add.slider');
      Route::get('/admin/delete/slider/{id?}',[VendorController::class,'DeleteSlider'])->name('admin.delete.slider');
    /*category*/
      Route::get('/admin/symptom/{id?}',[VendorController::class,'showSymptom'])->name('admin.symptom');
      Route::get('/admin/radiology-category/{id?}',[VendorController::class,'showRadiologyCat'])->name('admin.radiology-category');

      Route::get('/admin/category/{id?}',[VendorController::class,'showCategory'])->name('admin.category');
      Route::post('/admin/category/add',[VendorController::class,'insertCategory'])->name('admin.category.add');
      Route::post('/admin/category/edit/',[VendorController::class,'editCategoryFinal'])->name('admin.category.edit');
      Route::get('/admin/category/delete/{id}',[VendorController::class,'deleteCategory'])->name('admin.category.delete');
      Route::get('/admin/category/status/{id}',[VendorController::class,'categoryChangeStatus'])->name('admin.category.status');
      Route::get('/admin/all/category/{keyword?}',[VendorController::class,'categorySearch'])->name('admin.category.all');


});


Route::post('/login/hospital',[HospitalController::class,'Login_Hospital'])->name("login.hospital");

Route::middleware(['user-access:hospital,hospital'])->group(function () {

Route::get('/hospital/home', [HospitalController::class, 'Hospital_Home'])->name('hospital.home');
Route::get('/hospital/new/doctor/{id?}', [HospitalController::class, 'NewDoctor'])->name('hospital.new.doctor');
Route::post('/hospital/doctor/add', [HospitalController::class, 'AddDoctor'])->name('hospital.doctor.add');
Route::get('/hospital/doctor/{id?}', [HospitalController::class, 'ShowDoctor'])->name('hospital.doctor');
Route::get('/hospital/edit/doctor/{id?}', [HospitalController::class, 'NewDoctor'])->name('hospital.edit.doctor');
Route::post('/hospital/doctor/update', [HospitalController::class, 'UpdateDoctor'])->name('hospital.doctor.update');
Route::get('/hospital/doctor-schedule/{doctor_id?}', [HospitalController::class, 'DoctorScheduleList'])->name('hospital.doctor-schedule');
Route::post('/hospital-doctor-slots/generate', [DoctorSlotController::class, 'hospital_generateSlots'])->name('hospital-doctor-slots.generate');
Route::get('/hospital/appointment/list/', [HospitalController::class, 'orders'])->name('hospital.appointment.list');

//=====radiology services


Route::get('/hospital/appointment/', [HospitalController::class, 'appointment'])->name('hospital.appointment');
Route::post('/appointment/update-status', [HospitalController::class, 'updateStatus'])->name('appointment.updateStatus');


Route::get('/get-doctor-data/{id?}', [AppointmentController::class, 'doctor_data'])->name('get.doctor.data');
Route::Post('hospital/appointment-create', [AppointmentController::class, 'create'])->name('hospital.appointment.create');
Route::Post('hospital/patient-store', [AppointmentController::class, 'patient_store'])->name('patient.store');



//=====radiology services
Route::get('/radiology/new-service/{id?}', [HospitalController::class, 'NewRService'])->name('radiology.new-service');
Route::post('/radiology/service/add', [HospitalController::class, 'AddRadiology_Service'])->name('radiology.service.add');
Route::get('/radiology/service/{id?}', [HospitalController::class, 'Show_Radiology'])->name('radiology.service');

//radiology schedule add

Route::get('/radiology/service-schedule/{doctor_id?}', [HospitalController::class, 'Service_ScheduleList'])->name('radiology.service-schedule');
Route::post('/radiology-service-slots/generate', [DoctorSlotController::class, 'RadiologySchedule'])->name('radiology-service-slots.generate');

});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

