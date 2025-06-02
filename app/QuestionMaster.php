<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionMaster extends Model
{
     protected $table ="question_master";
     protected $fillable = ['title', 'status'];
}
