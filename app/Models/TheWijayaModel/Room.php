<?php 
namespace App\Models\TheWijayaModel;

use CodeIgniter\Model;

class Room extends Model
{
    protected $table = 'room';
    protected $primaryKey = 'id';
    protected $allowedFields = ['room_number', 'room_type', 'price_per_night'];

    public function getRoom()
    {
        return $this->orderBy('price_per_night', 'ASC')->findAll();
    }

}