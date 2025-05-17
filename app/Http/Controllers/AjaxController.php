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
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use App\Models\User; 

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

      public function login(Request $request)
      {   
          $input = $request->all();
       
          $this->validate($request, [
              'email' => 'required|email',
              'password' => 'required',
          ]);
       
          if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
          {
              if (auth()->user()->type == 'admin') {
                  return redirect()->route('admin.home');
              }else if (auth()->user()->type == 'manager') {
                  return redirect()->route('manager.home');
              }else{
                  return redirect()->route('home');
              }
          }else{
              return redirect()->route('login')
                  ->with('error','Email-Address And Password Are Wrong.');
          }
            
      }
}
