<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{

    public $fillable = ['coupon_id','user_id','product_id','total'];

}