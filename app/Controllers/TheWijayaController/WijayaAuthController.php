<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class WijayaAuthController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $customerModel = new CustomerModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|string|max_length[255]',
            'email' => 'required|valid_email',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari input
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // Cek apakah customer sudah ada di database
        $customer = $customerModel->where('email', $data['email'])->first();

        if (!$customer) {
            // Jika belum ada, simpan ke database
            $customerModel->insert($data);
            $customerId = $customerModel->getInsertID();
        } else {
            $customerId = $customer['id'];
        }

        // Simpan informasi customer ke session
        session()->set('id', $customerId);
        session()->set('name', $data['name']);

        // Redirect ke halaman check-in
        return redirect()->to('/BookingController/selectDate');
    }
}
