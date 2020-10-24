<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member_order_list';

    public $fillable = ['name','product','buy_date','buy_money','pay_method','phone','email','other_contact','address','notes'];//
}
