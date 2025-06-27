<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-info leading-tight tracking-widest uppercase mb-2">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-900 px-6 py-3 rounded flex items-center gap-2 justify-center">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
    @endif
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                <div class="bg-primary rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-2">
    <!-- Jika icon tidak muncul, pastikan CDN Font Awesome termuat di layout utama dan clear cache browser -->
    <i class="fas fa-shopping-cart text-black text-3xl"></i>
</div>
                    <div class="text-gray-800 text-lg font-semibold mb-2">Total Orders</div>
                    <div class="text-5xl font-bold text-gray-900">{{ $totalOrders }}</div>
                </div>
                <div class="bg-secondary rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-2">
    <i class="fas fa-file text-black text-3xl"></i>
</div>
                    <div class="text-gray-800 text-lg font-semibold mb-2">Total Order Details</div>
                    <div class="text-5xl font-bold text-gray-900">{{ $totalOrderDetails }}</div>
                </div>
                <div class="bg-accent rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-2">
    <i class="fas fa-users text-black text-3xl"></i>
</div>
                    <div class="text-gray-800 text-lg font-semibold mb-2">Total Customers</div>
                    <div class="text-5xl font-bold text-gray-900">{{ $totalCustomers }}</div>
                </div>
                <div class="bg-info rounded-xl shadow-lg p-8 text-center">
                    <div class="flex justify-center mb-2">
    <i class="fas fa-box text-black text-3xl"></i>
</div>
                    <div class="text-gray-800 text-lg font-semibold mb-2">Total Products</div>
                    <div class="text-5xl font-bold text-gray-900">{{ $totalProducts }}</div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-primary to-info rounded-xl shadow-lg p-8 mt-6">
                <h3 class="text-xl font-bold mb-4 text-info tracking-widest uppercase">Order Terbaru</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-info text-black">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-secondary uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-primary to-info divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-lg italic">Belum ada order terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
