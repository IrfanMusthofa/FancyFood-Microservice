<?php
namespace App\Controllers\SanchayaTasteController;

use App\Controllers\BaseController;
use App\Models\SanchayaTasteModel\Orderlist;
use App\Models\SanchayaTasteModel\Menu;

class OrderController extends BaseController
{
    /**
     * Menampilkan semua order milik customer (ke view).
     */
    public function viewOrder()
    {
        // Ambil session
        $session = session();
        // Dapatkan customer_id dari session
        $customerId = $session->get('id');
   
        // Jika customer_id tidak ada di session, Anda bisa redirect ke login, misalnya:
        if (!$customerId) {
            return redirect()->to('/sanchayataste/error_login');
        }

        // Ambil data order + join menu
        $orderlistModel = new Orderlist();
        $orders = $orderlistModel->getAllOrdersByCustomer($customerId);

        // Kirim data orders ke view
        return view('SanchayaTaste/view_order', [
            'orders' => $orders
        ]);
    }

    /**
     * Endpoint API untuk mengambil semua order (JSON) 
     * berdasarkan session customer_id.
     */
    public function getOrder()
    {
        // Ambil session
        $json = $this->request->getJSON();
        $customerId = $json->id ?? null;

        // Cek jika belum login atau session tidak valid
        if (!$customerId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Customer ID is required.'
            ])->setStatusCode(401);
        }

        $orderlistModel = new Orderlist();
        $orders = $orderlistModel->getAllOrdersByCustomer($customerId);

        return $this->response->setJSON($orders)->setStatusCode(200);
    }

    public function orderNow()
    {
        // Pastikan customer sudah login
        $session = session();
        $customerId = $session->get('id');
        if (!$customerId) {
            return redirect()->to('/sanchayataste/error_login');
        }

        // Ambil data menu (untuk dropdown)
        $menuModel = new Menu();
        $menus = $menuModel->findAll(); // atau $menuModel->getMenu();

        return view('SanchayaTaste/order', [
            'menus' => $menus
        ]);
    }

    /**
     * Memproses form "Order Now" 
     * dan menambahkan data ke tabel orderlist.
     */
    public function createOrder()
    {
        // Cek session login
        $session = session();
        $customerId = $session->get('id');
        if (!$customerId) {
            return redirect()->to('/sanchayataste/error_login');
        }

        // Ambil input
        $menuId   = $this->request->getPost('menu_id');
        $quantity = $this->request->getPost('quantity');

        // Dapatkan harga menu dari DB
        $menuModel = new Menu();
        $menuData  = $menuModel->find($menuId);
        if (!$menuData) {
            return redirect()->back()->with('error', 'Menu not found.');
        }

        $menuPrice = $menuData['menu_price'];
        // Hitung total
        $totalPrice = $quantity * $menuPrice;

        // Siapkan data untuk insert
        $data = [
            'menu_id'     => $menuId,
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'order_date'  => date('Y-m-d'),
            'customer_id' => $customerId
        ];

        $orderlistModel = new Orderlist();
        $orderlistModel->insert($data);
        $session->setFlashdata('success', 'Order created successfully!');

        // Setelah sukses insert, arahkan ke halaman order list
        return redirect()->to('/sanchayataste/order/vieworder')->with('success', 'Order created successfully!');
    }

}
