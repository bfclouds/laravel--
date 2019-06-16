<?php

namespace App;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model as BaseModel;

//若不写则对应posts表，否则:protected $table = 'your_table_name';
class Model extends BaseModel
{
    //
    //protected $fillable = ['title','content'];//可注入的数据
    //protected $guarded;//不可注入的数据
    protected $guarded = [];//不可注入的数据
}
