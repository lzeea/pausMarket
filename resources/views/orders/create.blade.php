<x-app-layout>
    <x-slot name="header">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-900 px-6 py-3 rounded flex items-center gap-2 justify-center">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
    @endif
        <h2 class="font-semibold text-secondary leading-tight">
            Tambah Order
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto bg-gradient-to-br from-primary to-info rounded-lg shadow p-6 mt-8">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="customer_id" class="text-info font-semibold mb-2">Pilih Customer</label>
                <select name="customer_id" id="customer_id" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="order_date" class="text-info font-semibold mb-2">Tanggal Order</label>
                <input type="date" name="order_date" id="order_date" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-6">
                <label class="text-info font-semibold mb-2">Pilih Produk</label>
                <div id="product-container">
                    <div class="flex items-center mb-2 product-row">
                        <select name="products[]" class="product-select w-3/5 border-gray-300 rounded px-3 py-2 mr-2 focus:outline-none focus:ring focus:border-blue-300" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="quantities[]" class="quantity-input w-2/5 border-gray-300 rounded px-3 py-2" placeholder="Jumlah" required>
                    </div>
                </div>
                <button type="button" id="add-product" class="bg-accent hover:bg-info text-white px-4 py-2 rounded shadow">
                    + Tambah Produk
                </button>
            </div>
            <button type="submit" class="w-full bg-info hover:bg-accent text-white font-bold py-2 px-4 rounded shadow">
                Simpan
            </button>
        </form>
    </div>
    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const container = document.getElementById('product-container');
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center mb-2 product-row';
            newRow.innerHTML = `
                <select name="products[]" class="product-select w-3/5 border-gray-300 rounded px-3 py-2 mr-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" class="quantity-input w-2/5 border-gray-300 rounded px-3 py-2" placeholder="Jumlah" required>
                <button type="button" class="remove-product ml-2 bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
            `;
            container.appendChild(newRow);
            newRow.querySelector('.remove-product').addEventListener('click', function() {
                container.removeChild(newRow);
            });
        });
    </script>
</x-app-layout>
