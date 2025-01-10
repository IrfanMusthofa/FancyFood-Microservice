<?php 
namespace App\Models\SanchayaTasteModel;

use CodeIgniter\Model;

class Menu extends Model
{
    protected $DBGroup = 'secondary';
    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_name', 'menu_price'];

    public function getMenu()
    {
        return $this->findAll();
    }

}