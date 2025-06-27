<div class="flex items-center space-x-4 mb-6">
    <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 hover:text-indigo-600 font-semibold">
        <i class="fas fa-list mr-1"></i> Orders
    </a>
    <a href="{{ route('customers.index') }}" class="flex items-center text-gray-700 hover:text-indigo-600 font-semibold">
        <i class="fas fa-users mr-1"></i> Customers
    </a>
    <a href="{{ route('products.index') }}" class="flex items-center text-gray-700 hover:text-indigo-600 font-semibold">
        <i class="fas fa-box mr-1"></i> Products
    </a>
    <a href="{{ route('order-details.index') }}" class="flex items-center text-gray-700 hover:text-indigo-600 font-semibold">
        <i class="fas fa-clipboard-list mr-1"></i> Order Details
    </a>
</div>
