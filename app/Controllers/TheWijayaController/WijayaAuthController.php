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
            session()->set('id', $user['id']);
            return redirect()->to('/thewijaya/dashboard');
        } else {
            session()->setFlashdata('errors', ['Email atau password salah']);
            return redirect()->to('/thewijaya/error_login');
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

    public function error_login()
    {
        return view('TheWijaya/error_login');
    }

    public function dashboard()
    {
        if (session()->get('customer_email') == '') {
            return redirect()->to('/thewijaya/error_login');
        }
        return view('TheWijaya/dashboard');
    }
}
