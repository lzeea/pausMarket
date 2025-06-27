<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with('order', 'product')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('order-details.index', compact('orderDetails'));
    }

    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order-details.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        $product = Product::find($request->product_id);
        $subtotal = $request->jumlah * $request->harga;

        OrderDetail::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->jumlah,
            'price' => $request->harga,
            'subtotal' => $subtotal,
            'user_id' => Auth::id()
        ]);

        // Update total amount in order
        $order = Order::find($request->order_id);
        $order->update([
            'total_amount' => $order->total_amount + $subtotal
        ]);

        return redirect()->route('order-details.index')
                         ->with('success', 'Order detail berhasil ditambahkan.');
    }

    public function edit(OrderDetail $orderDetail)
    {
        if ($orderDetail->user_id !== Auth::id()) {
            return redirect()->route('order-details.index')->with('error', 'Akses ditolak.');
        }
        $orders = Order::all();
        $products = Product::all();
        return view('order-details.edit', compact('orderDetail', 'orders', 'products'));
    }

    public function update(Request $request, OrderDetail $orderDetail)
    {
        if ($orderDetail->user_id !== Auth::id()) {
            return redirect()->route('order-details.index')->with('error', 'Akses ditolak.');
        }
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer',
        ]);

        $orderDetail->update($request->all());

        return redirect()->route('order-details.index')
                         ->with('success', 'Order detail berhasil diperbarui.');
    }

    public function destroy(OrderDetail $orderDetail)
    {
        if ($orderDetail->user_id !== Auth::id()) {
            return redirect()->route('order-details.index')->with('error', 'Akses ditolak.');
        }
        $orderDetail->delete();

        return redirect()->route('order-details.index')
                         ->with('success', 'Order detail berhasil dihapus.');
    }
}
