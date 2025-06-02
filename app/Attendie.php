<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Attendie extends Model
{
    protected $connection = 'kia_activity';
    protected $table = "attendies";
    protected $fillable = ['activity_id', 'dealer_code', 'name', 'location', 'dms_employee_id', 'designation', 'mobile_no'];  

    public function feedback(){
        return $this->hasMany('App\Feedback', 'attendie_id');
    }
}