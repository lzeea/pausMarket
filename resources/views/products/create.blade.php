<x-app-layout>
    <x-slot name="header">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-900 px-6 py-3 rounded flex items-center gap-2 justify-center">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
    @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk
        </h2>
    </x-slot>
    <div class="max-w-lg mx-auto bg-gradient-to-br from-primary to-info rounded-lg shadow p-6 mt-8">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-info font-semibold mb-2">Nama Produk</label>
                <input type="text" name="name" id="name" placeholder="Nama Produk" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-info font-semibold mb-2">Harga</label>
                <input type="number" name="price" id="price" placeholder="Harga" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-6">
                <label for="stock" class="block text-info font-semibold mb-2">Stok</label>
                <input type="number" name="stock" id="stock" placeholder="Stok" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <button type="submit" class="w-full bg-info hover:bg-accent text-white font-bold py-2 px-4 rounded shadow">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
