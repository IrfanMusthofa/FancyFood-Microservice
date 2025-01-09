<?php 

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['room_id', 'room_type', 'customer_name', 'customer_email', 'check_in_date', 'check_out_date', 'total_price', 'is_order_food', 'room_food_id'];
}
