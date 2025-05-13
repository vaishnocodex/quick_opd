<?php

//---------------------------------------Maavaishnodevi
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\DoctorApiController;



//authentication

Route::get('get-home-data/', [UserApiController::class, 'Home_Category_data']);
Route::get('all-specialist-categories/', [UserApiController::class, 'getAllSpecialCategory']);  
Route::get('all-symptom-categories/', [UserApiController::class, 'getAllSymptomCategory']);  
Route::get('all-radiology-categories/', [UserApiController::class, 'getAllRadiologyCategory']);  
Route::get('get-all-hospital/', [UserApiController::class, 'getAllHospital']);  


Route::get('/user/all_sliders', [UserApiController::class, 'getSliders']);
Route::post('/user/send-otp', [UserApiController::class, 'sendOtp']);
Route::post('/user/verify-otp', [UserApiController::class, 'verifyOtp']);
Route::get('/user/all_districts/', [UserApiController::class, 'districts_all']);
Route::get('/user/all_states/', [UserApiController::class, 'states_all']);
Route::get('/user/top_category', [UserApiController::class, 'getTopCategories']);
Route::get('/user/all_category/{type}', [UserApiController::class, 'getAllCategories']);
Route::get('/user/child_category/{parent_id}', [UserApiController::class, 'getChildCategories']);

//---------------routes
Route::middleware('auth:sanctum')->get('/user/get_doctor_bycategory/{category_id}', [UserApiController::class, 'Doctor_get_by_Specilist']);
Route::middleware('auth:sanctum')->get('/user/get_doctor_byhospital/{hsopital_id}', [UserApiController::class, 'Doctor_get_by_Hospital']);
Route::middleware('auth:sanctum')->get('/user/get_doctor_bysymptom/{symptom_id}', [UserApiController::class, 'Doctor_get_by_Symptom']);
Route::middleware('auth:sanctum')->get('/user/get_singledoctor_detail/{doctor_id}', [UserApiController::class, 'get_doctor_details']);
Route::middleware('auth:sanctum')->get('/user/get_all_hospitals/{doctor_id}', [UserApiController::class, 'get_AllHospital']);

//forget password
Route::post('/user/forgot-password', [UserApiController::class, 'forgotPassword']);
Route::post('/user/verify_forget_password_otp', [UserApiController::class, 'verify_ForgetPassword_Otp']);

//current user detail
Route::middleware('auth:sanctum')->get('/user/current/', [UserApiController::class, 'current_user']);
Route::middleware('auth:sanctum')->post('/user/change-password', [UserApiController::class, 'changePassword']);
//logout
Route::middleware('auth:sanctum')->post('/user/logout', [UserApiController::class, 'logout_user']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
