<x-app-layout>
    <x-slot name="header">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-900 px-6 py-3 rounded flex items-center gap-2 justify-center">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
    @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Order
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto bg-gradient-to-br from-primary to-info rounded-lg shadow p-6 mt-8">
        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
    <label class="block text-info font-semibold mb-2">Customer</label>
    <input type="text" value="{{ $order->customer->nama ?? $order->customer->name }}" class="w-full border-gray-300 rounded px-3 py-2 bg-gray-100" readonly>
</div>
<div class="mb-4">
    <label for="order_date" class="block text-info font-semibold mb-2">Tanggal Order</label>
    <input type="date" name="order_date" id="order_date" value="{{ $order->order_date }}" required class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
</div>
<div class="mb-4">
    <label for="status" class="block text-info font-semibold mb-2">Status</label>
    <select name="status" id="status" class="w-full border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>
</div>
            <div class="mb-4">
    <label class="block text-info font-semibold mb-2">Daftar Produk</label>
    <div id="product-container">
        @foreach($order->orderDetails as $i => $detail)
            <div class="flex items-center mb-2 product-row">
                <select name="products[]" class="product-select w-3/5 border-gray-300 rounded px-3 py-2 mr-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $detail->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" class="quantity-input w-2/5 border-gray-300 rounded px-3 py-2 mr-2" value="{{ $detail->quantity }}" placeholder="Jumlah" required>
                <button type="button" class="remove-product bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">-</button>
            </div>
        @endforeach
    </div>
    <button type="button" id="add-product" class="mt-2 bg-accent hover:bg-info text-white px-4 py-2 rounded shadow">
        + Tambah Produk
    </button>
</div>
<button type="submit" class="w-full bg-info hover:bg-accent text-white font-bold py-2 px-4 rounded shadow mt-4">
    Update
</button>
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
        <input type="number" name="quantities[]" class="quantity-input w-2/5 border-gray-300 rounded px-3 py-2 mr-2" placeholder="Jumlah" required>
        <button type="button" class="remove-product bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">-</button>
    `;
    container.appendChild(newRow);
});
document.addEventListener('click', function(e) {
    if(e.target && e.target.classList.contains('remove-product')) {
        e.target.parentNode.remove();
    }
});
</script>
        </form>
    </div>
</x-app-layout>
