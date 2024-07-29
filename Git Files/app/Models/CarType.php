<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    // If the table name is not the plural form of the model name, specify it
    protected $table = 'cartypes'; // Adjust if needed

    // Define the attributes that are mass assignable
    protected $fillable = ['value', 'label']; // Adjust based on your schema

    public $timestamps = false;
}
