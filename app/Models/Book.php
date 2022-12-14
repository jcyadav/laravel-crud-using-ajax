<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
 
class Book extends Model
{
    protected $fillable = [
        'name', 'email', 'mobile', 'class', 'father_name', 'mother_name'
    ];
}