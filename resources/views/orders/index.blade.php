<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-info leading-tight tracking-widest uppercase mb-2">
            {{ __('Daftar Order') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-900 px-4 py-3 rounded flex items-center gap-2">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
            @endif

            
<div class="flex justify-end mb-4">
                <a href="{{ route('orders.create') }}" class="bg-secondary hover:bg-accent text-white font-bold py-2 px-4 rounded shadow">
                    + Tambah Order
                </a>
            </div>

            <div class="bg-gradient-to-br from-primary to-info overflow-x-auto shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-info text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-primary to-info divide-y divide-gray-200">
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('orders.show', $order->id) }}" class="bg-accent hover:bg-secondary text-white px-3 py-1 rounded shadow mr-2">Lihat Detail</a>
                                    <a href="{{ route('orders.edit', $order) }}" class="bg-secondary hover:bg-accent text-white px-3 py-1 rounded shadow mr-2">Edit</a>
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-600 hover:bg-red-800 text-white font-bold px-3 py-1 rounded shadow open-delete-modal" data-id="{{ $order->id }}" data-action="{{ route('orders.destroy', $order) }}">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-lg">Belum ada data order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.delete-modal')
</x-app-layout>
