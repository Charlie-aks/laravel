<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails.product')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'status' => 'required|in:0,1,2,3',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('admin.orders.index')
            ->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($id);
            $order->orderDetails()->delete();
            $order->delete();
            
            DB::commit();
            return redirect()->route('admin.orders.index')
                ->with('success', 'Xóa đơn hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.orders.index')
                ->with('error', 'Có lỗi xảy ra khi xóa đơn hàng');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
} 