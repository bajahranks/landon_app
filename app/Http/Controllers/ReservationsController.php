<?php

namespace App\Http\Controllers;

use App\Client;
use App\Reservation;
use App\Room;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    //
    public function bookRoom($client_id, $room_id, $date_in, $date_out)
    {
        // Create objects
        $reservation = new Reservation();
        $client_instance = new Client();
        $room_instance = new Room();

        // Find the particular client and room that matches the id
        $client = $client_instance->find($client_id);
        $room = $room_instance->find($room_id);

        // Store the dates in the reservation table
        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;

        // Make the relationships and store the id
        $reservation->room()->associate($room);
        $reservation->client()->associate($client);

        // Ensure that rooms are not booked concurrently
        if($room_instance->isRoomBooked($room_id, $date_in, $date_out)){

            abort(405, 'Trying to book an already booked room');
        }

        $reservation->save();

        return redirect()->route('clients');
        // return view('reservations/bookRoom');
    }
}
