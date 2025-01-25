<?php

//---------------------------------------Maavaishnodevi
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\DoctorApiController;



//authentication
Route::get('/user/all_sliders', [UserApiController::class, 'getSliders']);
Route::post('/user/send-otp', [UserApiController::class, 'sendOtp']);
Route::post('/user/verify-otp', [UserApiController::class, 'verifyOtp']);

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
