<?php

use Illuminate\Support\Facades\DB;

class backHelper
{

   public static function Check_RadiologySubacategory_Count($id){

       $platinum = DB::table('category')->where('parent',$id)->get();
       return $platinum;
   }
    public static function Get_SpecilastName($specialist_id)
    {
        if ($specialist_id) {
            $ids = explode(',', $specialist_id);
    
            $names = DB::table("category")
                ->whereIn("id", $ids)
                ->pluck('name') 
                ->toArray(); // convert collection to array
    
            return implode(', ', $names); // return as comma-separated string
        }
    
        return '';
    }
    
    public static function get_radiology_name($ids)
{
    if (is_null($ids) || empty($ids)) {
        return '';
    }

    // Convert to array if it's a comma-separated string
    if (!is_array($ids)) {
        $ids = explode(',', $ids);
    }

    // Fetch names
    $names = DB::table('category')->whereIn('id', $ids)->pluck('name');

    // Return as comma-separated string
    return $names->implode(', ');
}


 public static function Get_CountDoctor($id)
    {
        return  DB::table('users')->where('user_id',$id)->count('id');
    }
    public static function get_fimddetails()
    {
        return  DB::table('firmdetails')->get()[0];
    }
    public static function  get_AllCategories()
    {
        return DB::table("category")->where(['parent'=>0,'status'=>1])->get();
    }
    
    public static function Sub_Categories($id)
    {
    return DB::table("category")->where("parent",$id)->get();
    }

    public static function Get_parent_Category_name($id)
    {
    return DB::table("category")->where("parent",$id)->first();
    }
    public static function get_category($id)
    {
        return  DB::table('category')->find($id);
    }

}