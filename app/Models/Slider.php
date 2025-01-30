<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class Slider extends Model  
{  
    use HasFactory;  

    // Specify the table name (optional if it's the plural of the model name)  
    protected $table = 'slider';  

    // Specify the fillable attributes  
    protected $fillable = [  
        'title',  
        'image',  
        'type',  
        'url',  
        'description',  
        'status',  
        'created_at',  
        'updated_at',  
    ];  

    // Alternatively, you can use guarded to specify which fields are not mass assignable:  
    // protected $guarded = ['id'];  
}