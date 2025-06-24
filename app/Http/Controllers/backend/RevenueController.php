<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // Lọc ngày nếu có
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Query OrderDetail kèm Order, có thể lọc ngày
        $orderDetails = OrderDetail::with('order')
            ->whereHas('order', function ($query) use ($fromDate, $toDate) {
                $query->where('status', 2);

                if ($fromDate) {
                    $query->whereDate('created_at', '>=', $fromDate);
                }

                if ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                }
            })
            ->get();

        // Tổng doanh thu
        $totalRevenue = $orderDetails->sum('amount');

        // Số đơn hàng thành công (đếm riêng theo Order)
        $successfulOrders = Order::where('status', 2)
            ->when($fromDate, fn($q) => $q->whereDate('created_at', '>=', $fromDate))
            ->when($toDate, fn($q) => $q->whereDate('created_at', '<=', $toDate))
            ->count();

        // Doanh thu theo tháng
        $revenueByMonth = $orderDetails
            ->groupBy(function ($item) {
                return Carbon::parse($item->order->created_at)->format('Y-m');
            })
            ->map(function ($group, $month) {
                return (object)[
                    'month' => $month,
                    'revenue' => $group->sum('amount'),
                ];
            })
            ->values();

        return view('backend.revenue.index', compact('totalRevenue', 'successfulOrders', 'revenueByMonth', 'fromDate', 'toDate'));
    }
}
