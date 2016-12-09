<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='message';
    protected $primaryKey='id';
    public $timestamps=false;
    protected  $guarded = []; // 不能填充的字段
}
