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
}
