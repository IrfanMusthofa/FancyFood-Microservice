<?php namespace App\Controllers\TheWijayaController;

use App\Controllers\BaseController;
use App\Models\TheWijayaModel\Booking;

class BookingController extends BaseController
{
    public function selectDates()
    {
        if (session()->get('customer_email') == '') {
            echo 'Anda harus login terlebih dahulu';
            return redirect()->to('/thewijaya/error_login');
        }
        return view('TheWijaya/select_date');
    }

    public function selectRoom()
    {
        $checkInDate = $this->request->getPost('check_in_date');
        $checkOutDate = $this->request->getPost('check_out_date');

        return view('select_room', [
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate
        ]);
    }

    public function paymentPage()
    {
        $roomId = $this->request->getPost('room_id');
        // $roomType = $this->request->getPost('room_type');
        $checkInDate = $this->request->getPost('check_in_date');
        $checkOutDate = $this->request->getPost('check_out_date');
        $totalPrice = $this->request->getPost('total_price');

        return view('payment_page', [
            'roomId' => $roomId,
            // 'roomType' => $roomType,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function processPayment()
    {
        $bookingModel = new Booking();
        $paymentModel = new PaymentModel();

        // Insert booking
        $bookingData = [
            'room_id' => $this->request->getPost('room_id'),
            // 'room_type' => $this->request->getPost('room_type'),
            'customer_name' => $this->request->getPost('customer_name'),
            'customer_email' => $this->request->getPost('customer_email'),
            'check_in_date' => $this->request->getPost('check_in_date'),
            'check_out_date' => $this->request->getPost('check_out_date'),
            'total_price' => $this->request->getPost('total_price'),
        ];
        $bookingId = $bookingModel->insert($bookingData);

        // Insert payment
        $paymentData = [
            'booking_id' => $bookingId,
            'payment_method' => $this->request->getPost('payment_method'),
            'amount' => $this->request->getPost('total_price'),
        ];
        $paymentModel->insert($paymentData);

        return view('payment_success');
    }

    public function bookingHistory()
    {
        $bookingModel = new Booking();
        $bookings = $bookingModel->findAll();

        return view('booking_history', ['bookings' => $bookings]);
    }

    public function confirmBooking()
    {
        $bookingModel = new \App\Models\BookingModel();

        $data = [
            'customer_name' => $this->request->getPost('customer_name'),
            'customer_email' => $this->request->getPost('customer_email'),
            'check_in_date' => $this->request->getPost('check_in_date'),
            'check_out_date' => $this->request->getPost('check_out_date'),
            'room_id' => $this->request->getPost('room_id'),
            'total_price' => $this->calculateTotalPrice(
                $this->request->getPost('room_id'),
                $this->request->getPost('check_in_date'),
                $this->request->getPost('check_out_date')
            ),
            'is_order_food' => $this->request->getPost('is_order_food') ?? 0,
            'room_food_id' => $this->request->getPost('room_food_id') ?? null,
        ];

        $bookingModel->insert($data);

        return redirect()->to('/paymentPage');
    }

}
