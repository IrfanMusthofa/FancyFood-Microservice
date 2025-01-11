<?php 
namespace App\Controllers\SanchayaTasteController;

use App\Controllers\BaseController;
use App\Models\SanchayaTasteModel\Special;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class SpecialController extends BaseController
{
    private $client;
    /**
     * Menampilkan semua record 'special' dalam view (HTML).
     */
    
    public function __construct()
    {
        $this->client = new Client([
            'timeout'         => 20,          // Timeout total request
        ]);
    }
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

    public function viewSpecialDiscount($bookingId)
    {
        // 1. Ambil data booking untuk dapatkan room_id
        $bookingModel = new Booking();
        $bookingData  = $bookingModel->find($bookingId);

        if (!$bookingData) {
            // Booking tidak ditemukan
            return view('errors/html/error_404', [
                'message' => 'Booking not found'
            ]);
        }

        $roomId = $bookingData['room_id'];

        // 2. Ambil data special + join menu (menu_name, menu_price)
        $specialModel = new Special();
        $specials     = $specialModel->getSpecialWithMenu();

        // 3. Loop & hitung final price
        $specialDiscounts = [];
        foreach ($specials as $item) {
            $menuPrice       = $item['menu_price'];
            $specialDiscount = $item['special_discount']; // persentase
            $discountAmount  = ($specialDiscount / 100) * $roomId;
            $finalPrice      = $menuPrice - $discountAmount;

            // Simpan ke array baru
            $specialDiscounts[] = [
                'id'               => $item['id'],
                'menu_name'        => $item['menu_name'],
                'menu_price'       => $menuPrice,
                'special_discount' => $specialDiscount,
                'discount_amount'  => $discountAmount,
                'final_price'      => $finalPrice,
            ];
        }

        // 4. Kirim hasil ke view
        return view('SanchayaTaste/view_special_discount', [
            'bookingId'         => $bookingId,
            'roomId'            => $roomId,
            'specialDiscounts'  => $specialDiscounts
        ]);
    }

    public function enterBookingId()
    {
        return view('SanchayaTaste/enter_booking_id');
    }

    /**
     * Menerima booking_id dari user, lalu panggil endpoint TheWijaya
     * untuk dapatkan data booking (termasuk room_id).
     */
    public function processBookingDiscount()
    {
        // Ambil booking_id dari form POST
        $bookingId = $this->request->getPost('booking_id');

        if (empty($bookingId)) {
            return redirect()->back()->with('error', 'Booking ID cannot be empty!');
        }

        $postData = [
            'booking_id' => $bookingId,
        ];
        
        try {
            $response = $this->client->post('http://irfancy.com/thewijaya/booking/getbookingbyid', [
                
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $postData, // Guzzle akan set body JSON & header automatically
            ]);

            if ($response->getStatusCode() === 200) {
                log_message('info', 'Success calling booking endpoint');
                $result = json_decode($response->getBody(), true);
            } else 
            { log_message('error', 'Error calling booking endpoint: ' . $response->getStatusCode());}
            $result   = json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            // Tangani kesalahan (termasuk timeout)
            
            return redirect()->back()->with(
                'error',
                'Error calling booking endpoint: ' . $e->getMessage()
            );
        }

        // 2. Cek response dari endpoint
        if (!isset($result['status']) || $result['status'] !== 'success') {
            $message = $result['message'] ?? 'Unknown error from booking endpoint.';
            return redirect()->back()->with('error', $message);
        }

        // Data booking
        $bookingData = $result['data'];
        $roomId      = $bookingData['room_id'] ?? null;
        if (!$roomId) {
            return redirect()->back()->with('error', 'room_id not found in booking data!');
        }

        // 3. Dapatkan data special + join menu
        $specialModel = new Special();
        $specials     = $specialModel->getSpecialWithMenu(); 

        // 4. Loop & hitung final price
        $specialDiscounts = [];
        foreach ($specials as $item) {
            $menuPrice       = $item['menu_price'];
            $specialDiscount = $item['special_discount']; // persentase
            $discountAmount  = ($specialDiscount / 100) * $roomId;
            $finalPrice      = $menuPrice - $discountAmount;

            $specialDiscounts[] = [
                'id'               => $item['id'],
                'menu_name'        => $item['menu_name'],
                'menu_price'       => $menuPrice,
                'special_discount' => $specialDiscount,
                'discount_amount'  => $discountAmount,
                'final_price'      => $finalPrice,
            ];
        }

        // 5. Tampilkan di view 
        return view('SanchayaTaste/view_special_discount', [
            'bookingId'         => $bookingId,
            'roomId'            => $roomId,
            'specialDiscounts'  => $specialDiscounts
        ]);
    }

}
