<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{

    public $fillable = ['coupon_code','description','from_date','to_date','discount','max_redeem'];

}