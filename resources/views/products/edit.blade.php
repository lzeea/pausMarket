<x-app-layout>
    <x-slot name="header">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-900 px-6 py-3 rounded flex items-center gap-2 justify-center">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
    @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk
        </h2>
    </x-slot>
    <div class="max-w-lg mx-auto bg-gradient-to-br from-primary to-info rounded-lg shadow p-6 mt-8">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-info font-semibold mb-2">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-info font-semibold mb-2">Harga</label>
                <input type="number" name="price" id="price" value="{{ $product->price }}" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-6">
                <label for="stock" class="block text-info font-semibold mb-2">Stok</label>
                <input type="number" name="stock" id="stock" value="{{ $product->stock }}" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="flex justify-between items-center mt-6 gap-4">
                <a href="{{ route('products.index') }}" class="w-1/3 bg-secondary text-info border-2 border-info font-bold py-2 px-4 rounded shadow hover:bg-info hover:text-white transition-colors duration-200 text-center">Kembali</a>
                <button type="submit" class="w-2/3 bg-info hover:bg-accent text-white font-bold py-2 px-4 rounded shadow">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
