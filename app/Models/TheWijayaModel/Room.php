<?php 
namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $allowedFields = ['room_name', 'room_type', 'price_per_night'];

    public function getAllRooms()
    {
        return $this->findAll();
    }
}
