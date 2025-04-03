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



    public function UserDashboard(Request $request)  
    {       
        
           $arr['hospital'] =  User::where('status', '1')->where('type', '2')->get();
           $arr['doctor'] =  User::where('status', '1')->where('type', '3')->get();
           $arr['category'] =  Category::where('status', '1')->where('parent', '0')->where('type', 'category')->get();
           $arr['symptom']  = Category::where('status', '1')->where('parent', '0')->where('type', 'symptom')->get();

           $arr['states'] = State::select('id', 'name')->where('fcountryid',101)->get();
           $arr['slider'] = Slider::where('status',1)->get();
            return view('website.user.dashboard')->with($arr);
    
    }

    public function User_Update_Password(Request $request)
    {
        // Validate Input
        $request->validate([
            'password'  => 'required',
            'npassword' => 'required|min:6',
            'cpassword' => 'required|same:npassword',
        ]);

        // Get authenticated user
        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect!');
        }

        // Update the password
        $user->password = Hash::make($request->npassword);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
