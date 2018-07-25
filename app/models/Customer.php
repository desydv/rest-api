<?php 
namespace app\models;
use \Illuminate\Database\Eloquent\Model;

class Customer extends Model {  
    protected $table = "customer";
    protected $fillable = ['email', 'name', 'password', 'phone'];
    public $timestamps = false;
}