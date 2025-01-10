<?php namespace App\Controllers\TheWijayaController;

use App\Controllers\BaseController;
use App\Models\TheWijayaModel\Room;

class RoomController extends BaseController
{
    public function viewRoom()
    {
        $roomModel = new Room();

        // Get all rooms sorted by price per night (ascending order)
        // Filter rooms with room_number other than 0
        $rooms = array_filter($roomModel->getRoom(), function($room) {
            return $room['room_number'] != 0;
        });

        return view('TheWijaya/view_room', ['rooms' => $rooms]);
    }

    public function getRoom()
    {
        $roomModel = new Room();

        // Fetch rooms using the method from the model
        $rooms = $roomModel->getRoom();

        return $this->response->setJSON($rooms);
    }
}
