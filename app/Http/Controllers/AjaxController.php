<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use PDF;
use TCPDF as GlobalTCPDF;
use Hash;
use function Ramsey\Uuid\v1;
use webhelper;
use backHelper;
use Log;

class AjaxController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

       // return response()->json(['message' => 'Logged out successfully.']);
       return redirect()->route('login.user');


    }
    public function getStateCity(Request $request){
     
        $rec = DB::table('city')->where('fstateid', $request->city)->orderBy('name', 'asc')->get();   
        $str = "";
        $str .= '<option value="">select</option>';
         foreach ($rec as $item) {
            
          $str .= '<option value="' . $item->id . '">' . $item->name . '</option>';
      
         }
       
       
        $arr['code'] = $str;
         echo json_encode($arr);  
      } 
}
