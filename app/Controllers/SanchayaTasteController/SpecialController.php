<?php 
namespace App\Controllers\SanchayaTasteController;

use App\Controllers\BaseController;
use App\Models\SanchayaTasteModel\Special;

class SpecialController extends BaseController
{
    /**
     * Menampilkan semua record 'special' dalam view (HTML).
     */
    public function viewSpecial()
    {
        // Buat instance model
        $specialModel = new Special();

        // Ambil data special
        $specials = $specialModel->getSpecial();

        // Kirim data ke view
        return view('SanchayaTaste/view_special', ['specials' => $specials]);
    }

    /**
     * Mengembalikan semua record 'special' dalam format JSON (API endpoint).
     */
    public function getSpecial()
    {
        $specialModel = new Special();
        $specials = $specialModel->getSpecial();

        return $this->response->setJSON($specials);
    }
}
