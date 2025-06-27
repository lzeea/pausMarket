<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-info leading-tight tracking-widest uppercase mb-2">
            {{ __('Daftar Produk') }}
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
                <a href="{{ route('products.create') }}" class="bg-secondary hover:bg-accent text-white font-bold py-2 px-4 rounded shadow">
                    + Tambah Produk
                </a>
            </div>

            <div class="bg-gradient-to-br from-primary to-info overflow-x-auto shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-info text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-primary to-info divide-y divide-gray-200">
                        @forelse($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('products.edit', $product) }}" class="bg-accent hover:bg-blue-600 text-white px-3 py-1 rounded shadow mr-2">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow open-delete-modal" data-id="{{ $product->id }}" data-action="{{ route('products.destroy', $product) }}">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('layouts.delete-modal')
</x-app-layout>

        </tbody>
    </table>
</div>

