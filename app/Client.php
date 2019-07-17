<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // This table has a one to many relationship with the reservation table
    public function reservations() {

        return $this->hasMany('App\Reservation');
    }
}
