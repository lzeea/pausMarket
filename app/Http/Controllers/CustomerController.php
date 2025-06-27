<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())->latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
        ]);

        // Simpan data
        $data = $request->all();
        $data['user_id'] = Auth::id();
        Customer::create($data);

        // Redirect ke daftar customer setelah simpan
        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        if ($customer->user_id !== Auth::id()) {
            return redirect()->route('customers.index')->with('error', 'Akses ditolak.');
        }
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        if ($customer->user_id !== Auth::id()) {
            return redirect()->route('customers.index')->with('error', 'Akses ditolak.');
        }
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diupdate.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->user_id !== Auth::id()) {
            return redirect()->route('customers.index')->with('error', 'Akses ditolak.');
        }
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus.');
    }
}
