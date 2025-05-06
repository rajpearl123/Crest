<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\CancelRequest;

class RazorpayController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // dd($request->all());
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $amount = intval($request->amount * 100); // Convert to paisa
        $order = $api->order->create([
            'amount' => $amount,
            'currency' => 'INR',
            'receipt' => Str::random(10)
        ]);
        return response()->json([
            'order_id' => $order['id'],
            'razorpay_key' => env('RAZORPAY_KEY'),
            'amount' => $request->amount,
            'currency' => 'INR',
            'customer' => [
                'name' => $request->name,
                'number' => $request->number,
                'email' => $request->email
            ]
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        Log::info('Razorpay Payment Success Request', $request->all());
    
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        try {
            // Fetch the payment details from Razorpay
            $payment = $api->payment->fetch($request->razorpay_payment_id);
    
            $paymentDetails = [
                'razorpay_payment_id' => $payment->id,
                'razorpay_order_id' => $payment->order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'total_amount' => $payment->amount / 100, // Convert paisa to INR
                'currency' => $payment->currency,
                'status' => $payment->status,
                'method' => $payment->method,
                'captured' => $payment->captured,
                'created_at' => date('Y-m-d H:i:s', $payment->created_at),
    
                // Customer details
                'name' => $payment->notes['name'] ?? $request->name,
                'email' => $payment->email,
                'contact' => $payment->contact,
    
                // UPI Details (if applicable)
                'upi_vpa' => $payment->vpa ?? null,
    
                // Bank Details (if applicable)
                'bank' => $payment->bank ?? null,
    
                // Wallet Details (if applicable)
                'wallet' => $payment->wallet ?? null,
    
                // Card Details (if applicable)
                'card_id' => isset($payment->card) ? $payment->card['id'] : null,
                'card_last4' => isset($payment->card) ? $payment->card['last4'] : null,
                'card_network' => isset($payment->card) ? $payment->card['network'] : null,
                'card_type' => isset($payment->card) ? $payment->card['type'] : null,
            ];
    
            // Log the full payment details for debugging
            Log::info('Full Payment Details', $paymentDetails);
    
            // Store in session or database
            session(['paymentDetails' => $paymentDetails]);
    
            return response()->json([
                'status' => 'Payment recorded successfully',
                'paymentDetails' => $paymentDetails
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching Razorpay payment details: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    // REFUND AMOUNT IF CANCELLED
    public function initiateRefund(Request $request)
    {
        if ($request->accept == "yes") {
            $transactions = Transaction::where('booking_id', $request->booking_id)->get();
            if ($transactions->isEmpty()) {
                Toastr::error('No transaction found for this booking!', 'Error');
                return back();
            }
            $api_key = env('RAZORPAY_KEY');
            $api_secret = env('RAZORPAY_SECRET');
            $api = new Api($api_key, $api_secret);

            foreach ($transactions as $transaction) {
                $payment_id = $transaction->razorpay_payment_id;

                try {
                    $refund = $api->payment->fetch($payment_id)->refund();
                    $transaction->status = 'refunded';
                    $transaction->save();
                    $booking = Booking::where('booking_id', $request->booking_id)->update(['status' => 'refunded']);
                    $booking = CancelRequest::where('booking_id', $request->booking_id)->update(['status' => 'approved']);
                    Toastr::success('Refund initiated successfully!', 'Success');
                } catch (\Exception $e) {
                    Toastr::error('Refund failed: ' . $e->getMessage(), 'Error');
                }
            }

            return back();
        } elseif ($request->accept == "no") {
            // Handle refund cancellation request
            $booking = CancelRequest::where('booking_id', $request->booking_id)->first();
            if ($booking) {
                $booking->status = "cancelled";
                $booking->save();
                Toastr::success('Refund Request Cancelled!', 'Success');
            } else {
                Toastr::error('Booking not found!', 'Error');
            }
            return back();
        }
    }


}
