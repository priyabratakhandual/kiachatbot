<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	
    protected $connection = 'kia_activity';
    protected $table = "feedbacks";
    protected $fillable = [
        'activity_id',
        'question_id',
        'answer',
        'attendie_id',
    ];

    public function attendie(){
        return $this->belongsTo('App\Attendie');
    }

    public function questions()
    {
        return $this->belongsTo('App\FeedBackMaster', 'question_id', 'id');
    }
}
