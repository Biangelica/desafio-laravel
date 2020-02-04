<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;

    protected $fillable=[ 'title', 'start', 'end', 'description', 'id_users'];


}
