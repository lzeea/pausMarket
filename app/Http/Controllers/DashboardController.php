<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalOrderDetails = OrderDetail::count();
        $totalCustomers = Customer::count();
        $totalProducts = Product::count();
        $recentOrders = Order::with('customer')->latest()->take(5)->get();
        return view('dashboard', compact('totalOrders', 'totalOrderDetails', 'totalCustomers', 'totalProducts', 'recentOrders'));
    }
}
