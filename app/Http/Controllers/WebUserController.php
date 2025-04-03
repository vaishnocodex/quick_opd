<?php

namespace App\Http\Controllers;

use Redirect, Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PartnerRegOtp;
use App\Models\Category;
use App\Models\State; 
use App\Models\City;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WebUserController extends Controller
{
    //



    public function AllHospital_Doctor(Request $request)  
    {       
         $decrypted = Crypt::decrypt($request->id);
           $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
           $arr['doctor'] =  User::where('status', '1')->where('type', '3')->get();
           $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.user.dashboard')->with($arr);
    
    }
}
