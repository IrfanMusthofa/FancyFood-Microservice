<?php 

namespace App\Models\TheWijayaModel;

use CodeIgniter\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id';
    protected $allowedFields = ['room_id', 'customer_id', 'check_in_date', 'check_out_date', 'is_order_food', 'order_id', 'total_price', 'paid'];


    public function getBooking()
    {
        return $this->orderBy('price_per_night', 'ASC')->findAll();
    }

    public function getBookingCustomer($customerId)
    {
        return $this
        ->select('booking.*, room.room_number, room.room_type')
        ->join('room', 'room.id = booking.room_id') // inner join
        ->where('booking.customer_id', $customerId)
        ->orderBy('booking.check_in_date', 'ASC')
        ->findAll();    
    }
}
