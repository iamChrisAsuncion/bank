<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  public $primaryKey = 'user_id';
    public function users() {
      return $this->belongsTo('App\User', 'user_id');
    }
}
