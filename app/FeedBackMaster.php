<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedBackMaster extends Model
{
	
    protected $connection = 'kia_activity';
    protected $table = "feedback_master";
    protected $fillable = [
        'id',
        'question_text',
        'question_type',
        'total_answers',
        'status',
        'required',
    ]; 
}
