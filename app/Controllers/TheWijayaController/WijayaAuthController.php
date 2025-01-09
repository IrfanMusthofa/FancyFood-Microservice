<?php namespace App\Controllers\TheWijayaController;
use App\Controllers\BaseController;
use App\Models\TheWijayaModel\WijayaCustomer;

class WijayaAuthController extends BaseController
{
    public function index()
    {
        return view ('TheWijaya/login');
    }

    public function login_action()
    { 
        $model = new WijayaCustomer();
        $email = $this->request->getPost('customer_email');
        $password = md5($this->request->getPost('password'));
        $user = $model->validateUser($email, $password);
 
        if ($user) {
            session()->set('customer_email', $user['customer_email']);
            return redirect()->to('/thewijaya/booking/selectDates');
        } else {
            session()->setFlashdata('errors', ['Email atau password salah']);
            return redirect()->to('/');
        }
    }
    public function logout_action()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function logout_action_api()
    {
        session()->destroy();
        return $this->response->setJSON(['message' => 'Logout berhasil']);
    }

    public function getUser()
    {
        $model = new WijayaCustomer();
        $user = $model->getUser();
        return $this->response->setJSON($user);
    }
}
