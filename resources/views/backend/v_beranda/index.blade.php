@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal -->
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di Toko Online Makanan Kami!</h1>
        <p class="text-gray-600 mt-2">Temukan makanan lezat dengan berbagai pilihan yang menggugah selera.</p>
    </div>

    <!-- Greeting Message -->
    <div class="mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h5 class="text-xl font-semibold text-gray-800 mb-4">{{ $judul }}</h5>
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                <h4 class="text-lg font-bold">Selamat Datang, {{ Auth::user()->nama }}</h4>
                <p class="mt-2">
                    Aplikasi Toko Online dengan hak akses yang Anda miliki sebagai
                    <b>
                        @if (Auth::user()->role == 1)
                            Super Admin
                        @elseif (Auth::user()->role == 0)
                            Admin
                        @endif
                    </b>.
                    Ini adalah halaman utama dari aplikasi Web Programming. Studi Kasus Toko Online.
                </p>
                <hr class="my-3">
                <p class="text-sm">Kuliah..? BSI Aja !!!</p>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Produk Pilihan</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ([
            ['img' => 'pizza', 'title' => 'Pizza Margherita', 'desc' => 'Nikmati kelezatan pizza dengan topping mozzarella dan basil segar.'],
            ['img' => 'burger', 'title' => 'Burger Spesial', 'desc' => 'Burger lezat dengan daging sapi berkualitas dan bahan segar.'],
            ['img' => 'pasta', 'title' => 'Pasta Carbonara', 'desc' => 'Nikmati pasta creamy dengan saus carbonara yang menggugah selera.'],
            ['img' => 'pasta', 'title' => 'Pasta Carbonara', 'desc' => 'Nikmati pasta creamy dengan saus carbonara yang menggugah selera.'],
            ['img' => 'pasta', 'title' => 'Pasta Carbonara', 'desc' => 'Nikmati pasta creamy dengan saus carbonara yang menggugah selera.'],
            ['img' => 'pasta', 'title' => 'Pasta Carbonara', 'desc' => 'Nikmati pasta creamy dengan saus carbonara yang menggugah selera.'],
        ] as $product)
        <div class="bg-white rounded-lg overflow-hidden shadow">
            <img src="https://source.unsplash.com/600x400/?{{ $product['img'] }}" alt="{{ $product['title'] }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h5 class="text-lg font-semibold text-gray-800">{{ $product['title'] }}</h5>
                <p class="text-gray-600 mt-2">{{ $product['desc'] }}</p>
                <a href="#" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- contentAkhir -->
@endsection
