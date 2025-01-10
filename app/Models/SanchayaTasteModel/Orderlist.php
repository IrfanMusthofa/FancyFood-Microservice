<?php 
namespace App\Models\SanchayaTasteModel;

use CodeIgniter\Model;

class Orderlist extends Model
{
    protected $DBGroup      = 'secondary';
    protected $table        = 'orderlist';
    protected $primaryKey   = 'id';
    protected $allowedFields = [
        'menu_id',
        'quantity',
        'total_price',
        'order_date',
        'customer_id'
    ];

    /**
     * Mengambil semua order beserta data menu
     * berdasarkan customer tertentu.
     */
    public function getAllOrdersByCustomer($customerId)
    {
        /**
         * Query JOIN:
         * SELECT orderlist.*, menu.menu_name, menu.menu_price
         *   FROM orderlist
         *   JOIN menu ON orderlist.menu_id = menu.id
         *  WHERE orderlist.customer_id = ?
         */
        $builder = $this->db->table($this->table);
        $builder->select('orderlist.*, menu.menu_name, menu.menu_price');
        $builder->join('menu', 'orderlist.menu_id = menu.id');
        $builder->where('orderlist.customer_id', $customerId);

        return $builder->get()->getResultArray();
    }
}
