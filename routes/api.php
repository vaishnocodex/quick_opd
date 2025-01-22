<?php  

use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Route;  

Route::get('/example', function (Request $request) {  
    return ['message' => 'Hello, API!'];  
});