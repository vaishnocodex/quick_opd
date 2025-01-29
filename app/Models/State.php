<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class State extends Model  
{  
    use HasFactory;  

    // Specify the table name if it doesn't follow Laravel's conventions  
    protected $table = 'state';  

    // Specify the primary key if not 'id'  
    protected $primaryKey = 'id';  

    // Disable timestamps if there are no 'created_at' and 'updated_at' columns  
    public $timestamps = false;  

    // Specify which attributes are mass assignable  
    protected $fillable = [  
        'fcountryid',  
        'name',  
        'status',  
    ];  

    
}