<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class City extends Model  
{  
    use HasFactory;  

    // Specify the table name if it doesn't follow Laravel's conventions  
    protected $table = 'city';  

    // Specify the primary key if not 'id'  
    protected $primaryKey = 'id';  

    // Disable timestamps if 'created_at' and 'updated_at' columns do not exist  
    public $timestamps = false;  

    // Specify which attributes are mass assignable  
    protected $fillable = [  
        'name',  
        'fstateid',  
        'status',  
    ];  

    // Define relationships, if applicable  
    public function state()  
    {  
        return $this->belongsTo(State::class, 'fstateid', 'id');  
    }  
}