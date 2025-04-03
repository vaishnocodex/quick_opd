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

class WebController extends Controller
{
    //

    public function User_RegisterSubmit(Request $request)
    {
        // Validation Rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:6',
            'agree_terms_and_policy' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
    
        // Get Last 10 Digits of Mobile Number
        $lastTenDigits = substr($request->phone, -10);
    
        // Check if Mobile Number Exists
        $user_check = User::where('mobile_no', $lastTenDigits)->where('type', '0')->first();
        if ($user_check) {
            return response()->json(['status' => false, 'message' => 'Mobile Number already exists']);
        }
    
        // Check if Email Exists
        $user_check = User::where('email', $request->email)->where('type', '0')->first();
        if ($user_check) {
            return response()->json(['status' => false, 'message' => 'Email Address already exists']);
        }
    
        // Create New User
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $lastTenDigits;
        $user->type = '0';
        $user->password = Hash::make($request->password);
        $user->pass_hint = $request->password;
        $user->save();
    
        // Authenticate User
        Auth::login($user);
    
        // Redirect to Dashboard
        return response()->json([
            'status' => true,
            'message' => 'Registration successful!',
            'redirect' => route('user.dashboard') // Ensure you have a named route for dashboard
        ]);
    }
    public function login_User_Submit(Request $request): RedirectResponse
    {
       
        // Find the user by mobile number

        $user = User::where('mobile_no', $request->username)->where('type','0')->first();

        if (!$user) {
            return redirect()->route('login.user')->with('error', 'User not found.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('login.user')->with('error', 'Incorrect password.');
        }

        // Log in the user manually
        Auth::login($user);
        // Retrieve intended URL or default to home
        $redirectTo = session('url.intended', route('welcome'));

        // Clear session value
        session()->forget('url.intended');

        // Redirect based on user type
        return ($user->type == 'user')
            ? redirect()->intended($redirectTo)  // Redirect to previous page or default
            : redirect()->route('welcome');
    }

    public function User_Login(Request $request)  
    {  
      
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
        
            return view('website.user_login')->with($arr);
    
    }
    public function User_Register(Request $request)  
    {  
      
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
        
            return view('website.register_user')->with($arr);
    
    }
    public function Home_View(Request $request)  
    {  
      
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['radiology_category'] = Category::where('status', '1')  
            ->where('parent', '0')
            ->where('type', 'category')  
            ->where('is_top', '1')  
            ->orderBy('id', 'desc') 
            ->take(10)  
            ->get();  
        
            return view('website.home')->with($arr);
    
    }

    public function Home_View3(Request $request)  
    {  
      
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
           $arr['radiology_category'] = Category::where('status', '1')  
            ->where('parent', '0')
            ->where('type', 'category')  
            ->where('is_top', '1')  
            ->orderBy('id', 'desc') 
            ->take(10)  
            ->get();  
        
            return view('website.oldhoe')->with($arr);
    
    }
    public function All_Hospital(Request $request)  
    {       
      
          $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.all_hospital')->with($arr);
    
    }

    public function AllHospital_Doctor(Request $request)  
    {       
         $decrypted = Crypt::decrypt($request->id);
         $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
          $arr['doctor'] =  User::where('status', '1')->where('type', '3')->get();
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.all_doctor')->with($arr);
    
    }

    
    public function SingleDoctorDetail(Request $request)  
    {       
         $decrypted = Crypt::decrypt($request->id);
         $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
          $arr['doctor'] =  User::where('id', $decrypted)->where('status', '1')->where('type', '3')->first();
          $arr['similar_doctor'] =  User::where('status', '1')->where('type', '3')->get();
            return view('website.doctor_detail')->with($arr);
    
    }
    public function All_Doctor(Request $request)  
    {  
      
          $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
          $arr['doctor'] =  User::where('status', '1')->where('type', '3')->get();
          $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.all_doctor')->with($arr);
    
    }
    
}
