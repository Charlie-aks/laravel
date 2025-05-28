<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['orderDetails.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'status'  => 'required|in:0,1,2,3',
            'note'    => 'nullable|string|max:1000'
        ]);
    
        try {
            DB::beginTransaction();

            $order = new Order();
            $order->user_id = Auth::check() ? Auth::id() : 1;
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->status = $request->status;
            $order->note = $request->note;
            $order->created_at = now();
            $order->save();

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Thêm đơn hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm đơn hàng: ' . $e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with(['orderDetails.product'])->findOrFail($id);
        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::with(['orderDetails.product'])->findOrFail($id);
        return view('backend.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'note' => 'nullable|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $order->update([
                'status' => $request->status,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note
            ]);

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật đơn hàng: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            
            // Xóa các chi tiết đơn hàng (soft delete)
            $order->orderDetails()->delete();
            
            // Xóa đơn hàng (soft delete)
            $order->delete();

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Xóa đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa đơn hàng: ' . $e->getMessage());
        }
    }

    public function trash()
    {
        $orders = Order::onlyTrashed()
            ->with(['orderDetails.product'])
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);
        return view('backend.order.trash', compact('orders'));
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::onlyTrashed()->findOrFail($id);
            $order->restore();
            $order->orderDetails()->restore();

            DB::commit();
            return redirect()->route('order.trash')->with('success', 'Khôi phục đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi khôi phục đơn hàng: ' . $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $order->status = $order->status == 3 ? 0 : $order->status + 1;
            $order->save();

            DB::commit();
            return redirect()->route('order.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật trạng thái: ' . $e->getMessage());
        }
    }
}
