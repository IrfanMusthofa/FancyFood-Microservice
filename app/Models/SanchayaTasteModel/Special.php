<?php 
namespace App\Models\SanchayaTasteModel;

use CodeIgniter\Model;

class Special extends Model
{
    protected $DBGroup      = 'secondary';   // Sesuaikan nama DB group Anda
    protected $table        = 'special';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['menu_id', 'special_discount'];

    /**
     * Mengambil semua data 'special' dari tabel.
     */
    public function getSpecial()
    {
        return $this->findAll();
    }

    public function getSpecialWithMenu()
    {
        // SELECT special.*, menu.menu_name, menu.menu_price
        //   FROM special
        //   JOIN menu ON menu.id = special.menu_id
        return $this->select('special.*, menu.menu_name, menu.menu_price')
                    ->join('menu', 'menu.id = special.menu_id')
                    ->findAll();
    }
    
}
