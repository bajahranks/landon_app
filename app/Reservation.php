<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // This table has a one to one relationship with the client table
    public function client(){

        return $this->belongsTo('App\Client', 'client_id', 'id');
    }

    public function room(){

        return $this->belongsTo('App\Room', 'room_id', 'id');
    }
}
