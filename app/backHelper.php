<?php

use Illuminate\Support\Facades\DB;

class backHelper
{
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