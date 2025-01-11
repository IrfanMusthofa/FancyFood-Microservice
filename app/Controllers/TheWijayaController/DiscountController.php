<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DiscountController extends BaseController
{
    private $client;

    public function __construct()
    {
        // Inisialisasi Guzzle Client
        $this->client = new Client([
            'timeout' => 20, // Sesuaikan sesuai kebutuhan
        ]);
    }

    /**
     * Contoh method untuk menampilkan data menu dengan diskon
     * Memanggil endpoint SanchayaTaste yang mengembalikan data menu
     * beserta 'special_discount' (atau silakan sesuaikan structure JSON API).
     *
     * Misalnya menembak endpoint: /sanchayataste/special/getspecial
     * atau /sanchayataste/menu/getmenu (tergantung API mana yang menyediakan 'special_discount').
     */
    public function viewDiscount()
    {
        $menus = [];

        try {
            // Sesuaikan URL di bawah dengan endpoint yang mengembalikan data:
            // - menu_price
            // - special_discount
            // misal: /sanchayataste/special/getspecial
            $response = $this->client->get('http://localhost:8080/sanchayataste/special/getspecial');

            if ($response->getStatusCode() === 200) {
                $menus = json_decode($response->getBody(), true);
            } else {
                log_message('error', 'Error menembak API special, status: ' . $response->getStatusCode());
            }
        } catch (GuzzleException $e) {
            log_message('error', 'GuzzleException: ' . $e->getMessage());
        }

        // Lakukan perhitungan diskon
        $menusWithDiscount = [];
        foreach ($menus as $m) {
            $menuName        = $m['menu_name'] ?? '-';
            $menuPrice       = isset($m['menu_price'])       ? (int)$m['menu_price']       : 0;
            $specialDiscount = isset($m['special_discount']) ? (int)$m['special_discount'] : 0;

            // Formula: discount_amount = (special_discount / 100) * menu_price
            $discountAmount  = ($specialDiscount / 100) * $menuPrice;
            $finalPrice      = $menuPrice - $discountAmount;

            $menusWithDiscount[] = [
                'menu_name'        => $menuName,
                'menu_price'       => $menuPrice,
                'special_discount' => $specialDiscount,
                'discount_amount'  => $discountAmount,
                'final_price'      => $finalPrice
            ];
        }

        // Lempar data ke view
        return view('/TheWijaya/discount_view', [
            'menusWithDiscount' => $menusWithDiscount
        ]);
    }
}
