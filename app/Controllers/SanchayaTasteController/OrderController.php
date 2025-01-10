<?php
namespace App\Controllers\SanchayaTasteController;

use App\Controllers\BaseController;
use App\Models\SanchayaTasteModel\Orderlist;

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
}
