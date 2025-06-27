<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Akses ditolak.');
        }
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Akses ditolak.');
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Akses ditolak.');
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus.');
    }
}
