<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PartnerRegOtp;
use App\Models\Category;
use App\Models\State; 
use App\Models\City;
use App\Models\Slider;


class WebController extends Controller
{
    //
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
}
