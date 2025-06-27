<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-info leading-tight">
            Detail Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primary to-accent shadow rounded-lg p-8 mb-8">
                <h3 class="text-info lg font-semibold mb-4">Informasi Order</h3>
                <div class="mb-2"><span class="font-medium text-info">Customer:</span> {{ $order->customer->name ?? '-' }}</div>
                <div class="mb-2"><span class="font-medium text-info">Tanggal Order:</span> {{ $order->created_at->format('d-m-Y') }}</div>
                <!-- Tambahkan info lain jika perlu -->
            </div>
            <div class="bg-gradient-to-br from-primary to-accent shadow rounded-lg p-8">
                <h3 class="text-info lg font-semibold mb-4">Daftar Produk (Order Details)</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-info text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-primary to-accent divide-y divide-gray-200">
                        @forelse($order->orderDetails as $detail)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detail->product->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $detail->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-lg">Belum ada detail produk pada order ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
