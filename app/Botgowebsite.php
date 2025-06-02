<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botgowebsite extends Model
{
  protected $table = 'botgoWebsite';

   protected $fillable = ['formOneData', 'previousValues','chatId'];   
}
