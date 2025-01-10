<?php namespace App\Controllers\TheWijayaController;

use App\Controllers\BaseController;
use App\Models\TheWijayaModel\Room;
use App\Models\TheWijayaModel\Booking;
use App\Models\TheWijayaModel\Payment;

class PaymentController extends BaseController
{
    public function index($bookingId = null)
    {

        // Ambil data booking + join table room untuk info room_number, room_type
        $bookingModel = new Booking();
        $booking = $bookingModel
            ->select('booking.*, room.room_number, room.room_type, room.price_per_night')
            ->join('room', 'room.id = booking.room_id')
            ->where('booking.id', $bookingId)
            ->first();

        if (!$booking) {
            return redirect()->to('/thewijaya/dashboard');
        }

        // Tampilkan view payment, kirim data booking
        return view('TheWijaya/payment', [
            'booking' => $booking
        ]);
    }

    public function processPayment()
    {
        // Ambil data dari form
        $bookingId      = $this->request->getPost('booking_id');
        $paymentMethod  = $this->request->getPost('payment_method');
        $amount         = $this->request->getPost('amount');

        // Simpan data payment
        $paymentModel = new Payment();
        $paymentModel->insert([
            'booking_id'     => $bookingId,
            'payment_method' => $paymentMethod,
            'amount'         => $amount,
        ]);

        // Update status paid di tabel booking
        $bookingModel = new Booking();
        $bookingModel->update($bookingId, ['paid' => 1]);

        // Tampilkan payment_success
        return view('TheWijaya/payment_success');
    }
    
}
