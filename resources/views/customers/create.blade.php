<x-app-layout>
    <x-slot name="header">
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-900 px-6 py-3 rounded flex items-center gap-2 justify-center">
    <i class="fas fa-check-circle text-green-600"></i> <span>{{ session('success') }}</span>
</div>
    @endif
        <h2 class="font-semibold text-xl text-info leading-tight">
            {{ __('Tambah Customer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-lg mx-auto bg-gradient-to-br from-primary to-info rounded-lg shadow p-6 mt-8">
            @if ($errors->any())
                <div class="mb-4 font-medium text-sm text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-info font-semibold mb-2">Nama</label>
                    <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-400" placeholder="Masukkan nama" required>
                </div>
                <div>
                    <label for="email" class="block text-info font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-400" placeholder="Masukkan email" required>
                </div>
                <div class="flex justify-between items-center mt-6 gap-4">
                    <a href="{{ route('customers.index') }}" class="w-1/3 bg-secondary text-info border-2 border-info font-bold py-2 px-4 rounded shadow hover:bg-info hover:text-white transition-colors duration-200 text-center">Kembali</a>
                    <button type="submit" class="w-2/3 bg-info hover:bg-accent text-white font-bold py-2 px-4 rounded shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
