<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{   
    protected $connection = 'kia_activity';

    protected $table ="roles";
}
