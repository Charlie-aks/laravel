<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('site.cart')->with('error', 'Giỏ hàng trống');
        }

        return view('frontend.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'note' => 'nullable|string',
                'payment_method' => 'required|in:cod,vnpay',
            ]);

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->route('site.cart')->with('error', 'Giỏ hàng trống');
            }

            DB::beginTransaction();

            // Tạo đơn hàng
            $orderData = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note,
                'status' => 1, // 1: Chờ xử lý
                'payment_method' => $request->payment_method,
                'total_amount' => array_sum(array_map(function($item) { 
                    return $item['price'] * $item['quantity']; 
                }, $cart)),
            ];

            // Thêm user_id nếu người dùng đã đăng nhập
            if (Auth::check()) {
                $orderData['user_id'] = Auth::id();
            }

            $order = Order::create($orderData);

            // Tạo chi tiết đơn hàng
            foreach ($cart as $productId => $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price_buy' => $item['price'],
                    'qty' => $item['quantity'],
                    'amount' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            // Xóa giỏ hàng
            session()->forget('cart');

            // Nếu là thanh toán VNPay, chuyển hướng đến trang thanh toán
            if ($request->payment_method == 'vnpay') {
                return redirect()->route('payment.create', [
                    'amount' => $order->total_amount,
                    'order_id' => $order->id
                ]);
            }

            return redirect()->route('site.home')->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi đặt hàng: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
} 