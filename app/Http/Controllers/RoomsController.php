<?php

namespace App\Http\Controllers;

use App\Client;
use App\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms(Request $request, $client_id)
    {
        $dateFrom = $request->input('dateFrom');
        $dateTo = $request->input('dateTo');
        $client = new Client();
        $room = new Room();

        $data = [];
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['client'] = $client->find($client_id);
        $data['rooms'] = $room->getAvailableRooms($dateFrom, $dateTo);

        return view('rooms/checkAvailableRooms', $data);
    }
}
