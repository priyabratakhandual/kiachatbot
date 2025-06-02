<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
	protected $connection = 'kia_activity';
    protected $table = 'logs';
}
