<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\ReturnStatusMail;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = Order::whereIn('return_status', ['requested', 'accepted', 'rejected', 'refunded'])->latest()->get();
        return view('Admin.return', compact('returns'));
    }


    public function rejectReturn(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'return_status' => 'rejected',
            'reject_reason' => $request->reject_reason,
        ]);
        Mail::to($order->user->email)->send(new ReturnStatusMail($order, 'rejected'));
        return back()->with('error', 'Return request rejected.');
    }

    public function acceptReturn($id)
    {
        $order = Order::findOrFail($id);

        $order->update(['return_status' => 'accepted']);

      
        Mail::to($order->user->email)->send(new ReturnStatusMail($order, 'accepted'));

        return back()->with('success', 'Return accepted successfully.');
    }

  
    public function refundPayment($id)
    {
        $order = Order::findOrFail($id);

       
        if ($order->payment_method === 'online' && $order->razorpay_payment_id) {
            try {
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $payment = $api->payment->fetch($order->razorpay_payment_id);
                $payment->refund(['amount' => $order->total * 100]); // Razorpay uses paise

                $order->update(['return_status' => 'refunded']);

              
                Mail::to($order->user->email)->send(new ReturnStatusMail($order, 'refunded'));

                return back()->with('success', 'Refund processed successfully via Razorpay.');

            } catch (\Exception $e) {
                \Log::error('Razorpay refund failed: '.$e->getMessage());
                return back()->with('error', 'Online refund failed: '.$e->getMessage());
            }
        }

      
        if ($order->payment_method === 'cod') {
            $order->update(['return_status' => 'refunded']);

         
            Mail::to($order->user->email)->send(new ReturnStatusMail($order, 'refunded'));

            return back()->with('success', 'COD refund marked as completed manually.');
        }

        return back()->with('error', 'Invalid payment mode or missing payment ID.');
    }
}