<?php namespace App\Controllers\SanchayaTasteController;

use App\Controllers\BaseController;
use App\Models\SanchayaTasteModel\Menu;

class MenuController extends BaseController
{
    public function viewMenu()
    {
        $menuModel = new Menu();

        $menus = $menuModel->getMenu();

        return view('SanchayaTaste/view_menu', ['menus' => $menus]);
    }

    public function getMenu()
    {
        $menusModel = new Menu();

        // Fetch menuss using the method from the model
        $menus = $menusModel->getMenu();

        return $this->response->setJSON($menus);
    }
}
