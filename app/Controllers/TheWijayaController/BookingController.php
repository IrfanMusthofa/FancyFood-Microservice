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

    public function viewBookingCustomer() 
    {
        $customerId = session()->get('id');
        $bookingModel = new Booking();
        $bookings = $bookingModel->getBookingCustomer($customerId);

        return view('TheWijaya/booking_customer', ['bookings' => $bookings]);
    }

    public function getBookingCustomer() 
    {
        $customerId = $this->request->getPost('id');
        print_r($this->request->getPost('id'));
        echo $customerId;
        echo 'melewati getPost(id)';
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
