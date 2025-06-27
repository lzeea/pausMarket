<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'limelife')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ route('orders.index') }}" class="logo">
                    <i class="fas fa-shopping-cart"></i> lzeea_
                </a>
            </div>
            <div class="navbar-menu">
                <a href="{{ route('orders.index') }}" class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> Orders
                </a>
                <a href="{{ route('customers.index') }}" class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Customers
                </a>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Products
                </a>
                <a href="{{ route('order-details.index') }}" class="nav-link {{ request()->routeIs('order-details.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> Order Details
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success fade-in bg-green-100 border border-green-400 text-green-900 px-4 py-3 rounded flex items-center gap-2">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger fade-in bg-red-100 border border-red-400 text-red-900 px-4 py-3 rounded flex items-center gap-2">
    <i class="fas fa-exclamation-circle text-red-600"></i> <span>{{ session('error') }}</span>
</div>
        @endif

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });

        // Form validation and submission handling
        $('form').on('submit', function(e) {
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        });

        // Dynamic form field updates
        $(document).on('change', 'select[data-update]', function() {
            const targetField = $(this).data('update');
            const value = $(this).val();
            $(targetField).val(value);
        });
    </script>
    @stack('scripts')
</body>
</html>
