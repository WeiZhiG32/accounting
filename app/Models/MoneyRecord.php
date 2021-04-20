<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyRecord extends Model
{
    //use HasFactory;

    //連接資料表
    protected $table = 'money_record';

     //資料表欄位
     protected $fillable = [
        'pay_name', 'money_amount', 'record_date', 'created_at',
    ];
}
