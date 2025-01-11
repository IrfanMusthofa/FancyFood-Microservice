<?php namespace App\Controllers\TheWijayaController;

use App\Controllers\BaseController;
use App\Models\TheWijayaModel\Booking;
use App\Models\TheWijayaModel\Room;


class BookingController extends BaseController
{
    public function selectBook()
    {
        // Pastikan customer sudah login
        if (session()->get('customer_email') == '') {
            // Jika belum login, arahkan untuk login
            return redirect()->to('/thewijaya/error_login');
        }

        // Ambil semua data room
        $roomModel = new Room();
        $allRooms  = $roomModel->getRoom(); // sudah diurutkan ascending by price_per_night

        // Muat view select_book
        // Mengirim data room agar bisa ditampilkan di dropdown/list
        return view('TheWijaya/select_book', [
            'rooms' => $allRooms
        ]);
    }

    public function viewBookingCustomer() 
    {
        $customerId = session()->get('id');
        $bookingModel = new Booking();
        $bookings = $bookingModel->getBookingCustomer($customerId);

        return view('TheWijaya/booking_customer', ['bookings' => $bookings]);
    }

    public function getBookingCustomer() 
    {
        $json = $this->request->getJSON();
        $customerId = $json->id ?? null;
      
        if (!$customerId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Customer ID is required.'
            ])->setStatusCode(400);
        }
    
        $bookingModel = new Booking();
        $bookings = $bookingModel->getBookingCustomer($customerId);
    
        if (empty($bookings)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'No bookings found for this customer.',
                'data' => []
            ])->setStatusCode(200);
        }
    
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $bookings
        ])->setStatusCode(200);
    }

    public function goToPayment()
    {
        // Pastikan customer sudah login, atau handle sesuai kebutuhan
        if (!session()->get('id')) {
            return redirect()->to('/thewijaya/error_login');
        }
    
        // Ambil data dari form
        $roomId       = $this->request->getPost('room_id');
        $checkInDate  = $this->request->getPost('check_in_date');
        $checkOutDate = $this->request->getPost('check_out_date');
        $totalPrice   = $this->request->getPost('total_price');
    
        // Dalam DB, kita ingin menyimpan total_price sebagai integer atau numeric
        // Format di form adalah misal "1.500.000" => kita buang dulu titiknya
        $cleanTotalPrice = str_replace('.', '', $totalPrice); // "1500000"
    
        // Siapkan data untuk dimasukkan ke tabel booking
        $data = [
            'room_id'        => $roomId,
            'customer_id'    => session()->get('id'), // asumsikan id customer disimpan di session
            'check_in_date'  => $checkInDate,
            'check_out_date' => $checkOutDate,
            'total_price'    => $cleanTotalPrice,
            'paid'           => 0,  // default 0, nanti bisa di-update jadi 1 setelah dibayar
        ];
    
        // Insert data ke tabel booking
        $bookingModel = new Booking();
        $newBookingId = $bookingModel->insert($data);
    
        // Redirect ke halaman /thewijaya/payment
        return redirect()->to('/thewijaya/payment/' . $newBookingId);
    }

    public function getBookingById()
    {
        // Ambil JSON input
        // log_message('debug', 'Masuk ke getBookingById()');
        $json = $this->request->getJSON();
        $bookingId = $json->booking_id ?? null;
       
        if (!$bookingId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Booking ID is required.'
            ])->setStatusCode(400);
        }
        // log_message('debug', 'lewat check bookingID');
        // Ambil data booking dari model
        $bookingModel = new Booking();
        $booking = $bookingModel->find($bookingId);

        
        if (!$booking) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Booking not found.',
            ])->setStatusCode(404);
        }
        // log_message('debug', 'Selesai memanggil bookingModel->find('.$bookingId.')');
        // log_message('debug', 'booking data ditemukan berdasarkan bookingId');

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $booking
        ])->setStatusCode(200);
    }
}
