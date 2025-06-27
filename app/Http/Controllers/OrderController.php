<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        $order->load(['customer', 'orderDetails.product']);
        return view('orders.show', compact('order'));
    }
    public function index()
    {
        $orders = Order::with('customer')->where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1'
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'total_amount' => 0,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        $totalAmount = 0;
        foreach ($request->products as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index];
            $subtotal = $product->price * $quantity;

            // Simpan ke tabel order_details
            \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal,
                'user_id' => Auth::id(),
            ]);

            // Simpan juga ke relasi pivot jika ingin, atau hapus baris berikut jika tidak perlu
            $order->products()->attach($productId, [
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal
            ]);

            $totalAmount += $subtotal;
        }

        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('orders.index')
            ->with('success', 'Order berhasil dibuat.');
    }

    public function edit(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Akses ditolak.');
        }
        $customers = Customer::all();
        $products = Product::all();
        $order->load('orderDetails');
        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Akses ditolak.');
        }
        $request->validate([
            'order_date' => 'required|date',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1'
        ]);

        $order->update([
            'order_date' => $request->order_date,
            'status' => $request->status
        ]);

        // Hapus semua order details lama
        $order->orderDetails()->delete();
        $order->products()->detach();

        $totalAmount = 0;
        foreach ($request->products as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index];
            $subtotal = $product->price * $quantity;

            \App\Models\OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal,
                'user_id' => Auth::id(),
            ]);

            $order->products()->attach($productId, [
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal
            ]);

            $totalAmount += $subtotal;
        }
        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diupdate.');
    }

    public function destroy(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Akses ditolak.');
        }
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
