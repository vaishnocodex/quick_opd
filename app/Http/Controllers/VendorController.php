<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;

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
class VendorController extends Controller
{
    //

    public function AdminHome()
    {
        return view('admin.home');
    } 

    //-----------------Hospital CRUD Operation Start
    public function ShowStore(Request $rest){
        if($rest->id){
            $arr["staff_id"]=$rest->id;
            $decrypted = Crypt::decrypt($rest->id);
            $arr['data'] = DB::table('users')->where('id',$decrypted)->where('role','2')->first();
            return view('admin.edit_store')->with($arr);
        }
        else{
            $arr["staff_id"]=null;
        }

        $data = DB::table('users as a')
        ->select(['a.*', 'b.name as state_name', 'c.name as city_name'])
        ->leftJoin('state as b', 'a.state', '=', 'b.id')
        ->leftJoin('city as c', 'a.city', '=', 'c.id')
        ->where('a.type', '2')
        ->where('a.user_id', '0')->where('a.status', 1)
        ->orderBy('a.id', 'DESC')
        ->get();
       

        $arr['All_staff'] = $data;
       // $staff = DB::table('users')->where('id','2')->get();
        //dd($staff);
        return view('admin.hospital')->with($arr);
    }
    
    public function AddStore(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',
           

        ]);
        
        $checkemail = DB::table('users')->where('email', $rest->email)->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->route('admin.store');
        }

        $chkm = DB::table('users')->where('mobile', $rest->mobile)->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->route('admin.store');
        }else{
            
                $array['password'] = Hash::make($rest->password);
                $array['pw'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile'] =$rest->mobile;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['address'] =$rest->address;
                
                $array['role'] ='2';
                $array['type'] ='2';
                 $array['created_at'] = Carbon::now();
             
                
                    $ins=DB::table('users')->insert($array);
                

                if ($ins) {

                    session()->flash('msgVendor', 'Store Added Successfully.');
                      
                    return redirect()->route('admin.store');
                } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');
                       
                return redirect()->route('admin.store');
                }

         

        }





    }
    public function UpdateStore(Request $rest){

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',
           

        ]);
        $decrypted = Crypt::decrypt($rest->id);
        $chkm = DB::table('users')->where('mobile', $rest->mobile)->where('id','!=', $decrypted)->count();
        if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->route('admin.store');
        }else{
            
                $array['password'] = Hash::make($rest->password);
                $array['pw'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile'] =$rest->mobile;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['address'] =$rest->address;
              
                 $array['updated_at'] = Carbon::now();
               
                    $ins = DB::table('users')->where('id', $decrypted)->update($array);
               

                if ($ins) {

                session()->flash('msgVendor', 'Store Updated Successfully.');
                    
                    return redirect()->route('admin.store');
                } else {

                    session()->flash('errorVendor', 'Unable to Update try after some time .');
                  
                    return redirect()->route('admin.store');
                }

           

        }





    }

    //---------------------------------------------------------------Hospital Area End

}
