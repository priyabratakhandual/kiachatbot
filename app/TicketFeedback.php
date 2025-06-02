<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketFeedback extends Model
{   
    protected $connection = 'kia_activity';

    protected $table ="ticket_feedback";

    
}
