<?php 

namespace App\Models\TheWijayaModel;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['booking_id', 'payment_method', 'amount'];
}
