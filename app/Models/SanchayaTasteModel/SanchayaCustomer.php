<?php

namespace App\Models\SanchayaTasteModel;

use CodeIgniter\Model;

class SanchayaCustomer extends Model
{
    protected $DBGroup = 'secondary';
    protected $table        = 'customer';
    protected $primaryKey   = 'id';
    protected $allowedFields = [
        'customer_name',
        'customer_email',
        'password'
    ];
    protected $returnType   = 'array';

    /**
     * Validasi user berdasarkan email dan password.
     *
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function validateUser($email, $password)
    {
        return $this->where('customer_email', $email)
                    ->where('password', $password)
                    ->first();
    }

    /**
     * Mengambil data user.
     *
     * @param int|bool $id
     * @return array|object|null
     */
    public function getUser($email = false)
    {
        if ($email === false) {
            return $this->findAll();
        } else {
            // Perhatikan primary key Anda 'id', bukan 'user_id'.
            // Jika memang kolom pk di DB adalah 'id', maka gunakan ini:
            return $this->where(['id' => $email])->first();
            
            // Atau jika di database Anda nama kolom PK-nya user_id:
            // return $this->where(['user_id' => $id])->first();
        }
    }

    /**
     * Menyisipkan (insert) user baru ke dalam tabel customer.
     *
     * @param array $data
     * @return int|string|bool
     */
    public function insertUser($data)
    {
        return $this->insert($data);
    }
}
