<?php namespace App\Controllers\SanchayaTasteController;
use App\Controllers\BaseController;
use App\Models\SanchayaTasteModel\SanchayaCustomer;

class SanchayaAuthController extends BaseController
{
    public function index()
    {
        return view ('SanchayaTaste/login');
    }

    public function login_action()
    { 
        $model = new SanchayaCustomer();
        $email = $this->request->getPost('customer_email');
        $password = md5($this->request->getPost('password'));
        $user = $model->validateUser($email, $password);
 
        if ($user) {
            session()->set('customer_email', $user['customer_email']);
            session()->set('id', value: $user['id']);
            return redirect()->to('/sanchayataste/dashboard');
        } else {
            session()->setFlashdata('errors', ['Email atau password salah']);
            return redirect()->to('/sanchayataste/error_login');
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
        $model = new SanchayaCustomer();
        $user = $model->getUser();
        return $this->response->setJSON($user);
    }

    public function error_login()
    {
        return view('SanchayaTaste/error_login');
    }

    public function dashboard()
    {
        if (session()->get('customer_email') == '') {
            return redirect()->to('/SanchayaTaste/error_login');
        }
        return view('SanchayaTaste/dashboard');
    }
}
