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
            $arr['data'] = DB::table('users')->where('id',$decrypted)->where('role_id','2')->first();
            return view('admin.edit_hospital')->with($arr);
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
       
        $arr['state_data'] = DB::table('state')->where('fcountryid', 101)->get();

        $arr['All_staff'] = $data;
       // $staff = DB::table('users')->where('id','2')->get();
        //dd($staff);
        return view('admin.hospital')->with($arr);
    }
    
    public function AddHospital(Request $rest)
    {

        $this->validate($rest, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required',
            'email' => 'required|string',
           

        ]);
        
        $checkemail = DB::table('users')->where('email', $rest->email)->where('type','2')->count();
       if ($checkemail > 0) {
            session()->flash('msgVendor', 'Email Address already exist.');
            return redirect()->route('admin.hospital');
        }

        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type','2')->count();
       if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->route('admin.hospital');
        }else{
            
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                $array['role_id'] ='2';
                $array['type'] ='2';
                 $array['created_at'] = Carbon::now();
             
                
                    $ins=DB::table('users')->insert($array);
                

                if ($ins) {

                    session()->flash('msgVendor', 'Hospital Added Successfully.');
                      
                    return redirect()->route('admin.hospital');
                } else {

                session()->flash('errorVendor', 'Unable to add try after some time .');
                       
                return redirect()->route('admin.hospital');
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
        $chkm = DB::table('users')->where('mobile_no', $rest->mobile)->where('type','2')->where('id','!=', $decrypted)->count();
        if ($chkm > 0) {
            session()->flash('msgVendor', 'This Mobile No. already exist.');
            return redirect()->route('admin.hospital');
        }else{
            
                $array['password'] = Hash::make($rest->password);
                $array['pass_hint'] =$rest->password;
                $array['name'] =$rest->name;
                $array['mobile_no'] =$rest->mobile;
                $array['user_id'] =0;
                $array['email'] =$rest->email;
                $array['state'] =$rest->state;
                $array['city'] =$rest->city;
                $array['pincode'] =$rest->pincode;
                $array['address'] =$rest->address;
                $array['status'] =1;
                $array['role_id'] ='2';
                $array['type'] ='2';
                $array['updated_at'] = Carbon::now();
               
                    $ins = DB::table('users')->where('id', $decrypted)->update($array);
               

                if ($ins) {

                session()->flash('msgVendor', 'Hospital Updated Successfully.');
                    
                    return redirect()->route('admin.hospital');
                } else {

                    session()->flash('errorVendor', 'Unable to Update try after some time .');
                  
                    return redirect()->route('admin.hospital');
                }

           

        }





    }

    //---------------------------------------------------------------Hospital Area End
       /*category section */
       public function showSymptom(Request $rest)
       {
           if($rest->id)
           {
               $arr["category_id"]=$rest->id;
           }
           else{
               $arr["category_id"]=null;
           }
           $arr['categories'] = DB::table('category')->where('type','symptom')->get();
           $cats = DB::table('category')->where(['parent'=>0])->where('type','symptom')->get();
           $arr['catall'] = $cats;
           $arr['heading_title'] = 'Symptom';
           $arr['cat_type'] = 'symptom';
   
           return view('admin.category')->with($arr);
       }
       public function showCategory(Request $rest)
       {
           if($rest->id)
           {
               $arr["category_id"]=$rest->id;
           }
           else{
               $arr["category_id"]=null;
           }
           $arr['categories'] = DB::table('category')->where('type','category')->get();
           $cats = DB::table('category')->where(['parent'=>0])->where('type','category')->get();
           $arr['catall'] = $cats;
           $arr['heading_title'] = 'category';
           $arr['cat_type'] = 'category';
           return view('admin.category')->with($arr);
       }
       public function editCategoryFinal($id, Request $request)
       {
           $this->validate($request, [
               'name' => 'required|string'
           ]);
           try {
               $decrypted = Crypt::decrypt($id);
   
               $array = $request->except(['_token','parent']);
               if ($request->image) {
                   $categoryImage = time() . rand(1000, 9999) . '.' . $request->image->extension();
                   $request->image->storeAs('category', $categoryImage, 'public');
                   $array['image'] = $categoryImage;
               }
               if($request->parent)
               {
                   $array['parent']=$request->parent;
               }
               else
               {
                   $array['parent']=0;
               }
   
               $upd = DB::table('category')->where('id', $decrypted)->update($array);
               if ($upd) {
                   session()->flash('msgVendor', 'Catgeory Updated Successfully .');
                   return redirect()->route('admin.category');
               } else {
                   session()->flash('errorVendor', 'Unable to Update try after some time .');
                   return redirect()->route('admin.category.edit', ['id' => $id]);
               }
           } catch (Exception $e) {
   
               session()->flash('errorVendor', 'Unable to Update try after some time .');
               return redirect()->route('admin.category.edit', ['id' => $id]);
           }
       }
       public function deleteCategory($id){
           try {
               $decrypted = Crypt::decrypt($id);
               $rslt = DB::table('category')->where('id', $decrypted)->delete();
               if ($rslt) {
                   session()->flash('errorVendor', 'Category Deleted Successfully .');
                   return redirect()->route('admin.category');
               } else {
                   session()->flash('errorVendor', 'Unable to Delete try after some time .');
                   return redirect()->route('admin.category');
               }
           } catch (Exception $e) {
               session()->flash('errorVendor', 'Unable to Delete try after some time .');
               return redirect()->route('admin.category');
           }
       }
       public function categoryChangeStatus($id)
       {
           $decrypted = Crypt::decrypt($id);
           $get = DB::table('category')->find($decrypted);
   
   
           if ($get->status == 0)
               $status = 1;
           else
               $status = 0;
   
   
           $rslt = DB::table('category')->where('id', $decrypted)->update(['status' => $status]);
           if ($rslt) {
               Session()->flash('msgVendor', 'Status changed successfully');
               return redirect()->back();
           } else {
               Session()->flash('errorVendor', 'Unable to change Status,try after some time');
               return redirect()->back();
           }
       }
       public function categorySearch(Request $rest){
        if (!$rest->keyword) {
           
            $cats = DB::table('category')
            ->where('fuserid', Auth::user()->id)
            ->where(['parent'=>0,'status'=>1])
            ->get();

            $arr['catall'] = $cats;
        }
        else{


            $cats = DB::table('category', 'a')
            ->leftJoin('category as b', 'a.parent', '=', 'b.id')
            ->select(['a.*', 'b.name as parentName'])
            ->where('a.fuserid', Auth::user()->id)
            ->where('a.name','like','%'. $rest->keyword.'%')
            ->get();
            $arr['catall'] = $cats;
            // dd($arr);

        }
        $arr['categories'] = DB::table('category')->where('fuserid', Auth::user()->id)->get();
        return view('admin.category')->with($arr);

    }
    public function insertCategory(Request $request)
    {

        $this->validate($request, [
            // 'name' => 'required|string|unique:category,name',
            'name' => 'required|string',
            'image' => 'image',

        ]);
    
        
          if ($request->image) {
             $firmImage = time() . rand(1000000, 9999999) . '.' . $request->image->extension();
             $request->image->move(public_path('storage/category'), $firmImage);
             $array['image'] = $firmImage;

        }

        // $array = $request->except('_token');
        if ($request->parent) {
            $array['parent'] = $request->parent;
        } else {
            $array['parent'] = 0;
        };
        $array['name'] = $request->name;
        $array['type'] = $request->type;
        $array['fuserid'] = Auth::user()->id;

        if($request->id==''){
            $ins=DB::table('category')->insert($array);
        }
        else{
            
            $ins = DB::table('category')->where('id', $request->id)->update($array);
        }

        if ($ins) {
            if ($request->id=='') {
                session()->flash('msgVendor', $request->type.' Added Successfully.');
            }
            else{
                session()->flash('msgVendor', $request->type.' Updated Successfully.');
            }
                if($request->type=="category"){
                    return redirect()->route('admin.category');
                }else{
                    return redirect()->route('admin.symptom');
                }
            
        } else {
            if ($request->id=='') {
                session()->flash('errorVendor', 'Unable to add try after some time .');
            }
            else{
                session()->flash('errorVendor', 'Unable to update try after some time .');
            }

            if($request->type=="category"){
                return redirect()->route('admin.category');
            }else{
                return redirect()->route('admin.symptom');
            }
        }
    }
    public function editCategory($id)
    {

        try {
            $decrypted = Crypt::decrypt($id);
            $arr['cat'] = DB::table('category')->where('id', $decrypted)->get();
            $arr['categories'] = DB::table('category')->where('id', '!=', $decrypted)->where('fuserid',Auth::user()->id)->get();
            return view('admin.categoryEdit')->with($arr);
        } catch (Exception $e) {
            session()->flash('errorVendor', 'Unable to update try after some time .');
            return redirect()->route('admin.category.edit', ['id' => $id]);
        }
    }
}
