<x-layout-admin>
    <x-slot:title>Thống kê doanh thu</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Tổng quan doanh thu</h2>

            {{-- Form lọc theo ngày --}}
            <form method="GET" class="mb-6 flex gap-4 items-end">
                <div>
                    <label class="block text-sm text-gray-700">Từ ngày</label>
                    <input type="date" name="from_date" value="{{ $fromDate }}" class="border rounded px-2 py-1">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Đến ngày</label>
                    <input type="date" name="to_date" value="{{ $toDate }}" class="border rounded px-2 py-1">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lọc</button>
            </form>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="p-4 bg-green-100 rounded">
                    <p class="text-lg font-semibold text-green-800">Tổng doanh thu:</p>
                    <p class="text-2xl font-bold text-green-900">
                        {{ number_format($totalRevenue, 0, ',', '.') }}₫
                    </p>
                </div>
                <div class="p-4 bg-blue-100 rounded">
                    <p class="text-lg font-semibold text-blue-800">Số đơn hàng thành công:</p>
                    <p class="text-2xl font-bold text-blue-900">{{ $successfulOrders }}</p>
                </div>
            </div>

            {{-- Biểu đồ --}}
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2">Biểu đồ doanh thu theo tháng</h3>
                <canvas id="revenueChart" height="100"></canvas>
            </div>

            {{-- Bảng chi tiết --}}
            <h3 class="text-xl font-semibold mb-4">Chi tiết doanh thu theo tháng</h3>
            <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Tháng</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Doanh thu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($revenueByMonth as $item)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">Tháng {{ $item->month }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ number_format($item->revenue, 0, ',', '.') }}₫
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart.js CDN + Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($revenueByMonth->pluck('month')) !!},
                datasets: [{
                    label: 'Doanh thu',
                    data: {!! json_encode($revenueByMonth->pluck('revenue')) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + '₫';
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-layout-admin>
