<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botgotest extends Model
{
  protected $table = 'botgotest';

   protected $fillable = ['name', 'email', 'mobile','chatId'];   
}
