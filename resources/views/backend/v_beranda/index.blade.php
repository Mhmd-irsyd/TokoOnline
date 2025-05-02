@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal -->
<div class="container">
    <!-- Hero Section -->
    <div class="hero">
        <h1>Selamat Datang di Toko Online Makanan Kami!</h1>
        <p>Temukan makanan lezat dengan berbagai pilihan yang menggugah selera.</p>
    </div>

    <!-- Greeting Message -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-top">
                    <h5 class="card-title">{{ $judul }}</h5>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Selamat Datang, {{ Auth::user()->nama }}</h4>
                        Aplikasi Toko Online dengan hak akses yang Anda miliki sebagai
                        <b>
                            @if (Auth::user()->role == 1)
                                Super Admin
                            @elseif (Auth::user()->role == 0)
                                Admin
                            @endif
                        </b>
                        ini adalah halaman utama dari aplikasi Web Programming. Studi Kasus Toko Online.
                        <hr>
                        <p class="mb-0">Kuliah..? BSI Aja !!!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <h2 style="text-align: center; margin-top: 40px; color: #333;">Produk Pilihan</h2>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <img src="https://source.unsplash.com/1600x900/?pizza" alt="Produk 1">
                <div class="card-body">
                    <h5 class="card-title">Pizza Margherita</h5>
                    <p class="card-text">Nikmati kelezatan pizza dengan topping mozzarella dan basil segar.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="https://source.unsplash.com/1600x900/?burger" alt="Produk 2">
                <div class="card-body">
                    <h5 class="card-title">Burger Spesial</h5>
                    <p class="card-text">Burger lezat dengan daging sapi berkualitas dan bahan segar.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="https://source.unsplash.com/1600x900/?pasta" alt="Produk 3">
                <div class="card-body">
                    <h5 class="card-title">Pasta Carbonara</h5>
                    <p class="card-text">Nikmati pasta creamy dengan saus carbonara yang menggugah selera.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="https://source.unsplash.com/1600x900/?pasta" alt="Produk 3">
                <div class="card-body">
                    <h5 class="card-title">Pasta Carbonara</h5>
                    <p class="card-text">Nikmati pasta creamy dengan saus carbonara yang menggugah selera.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="https://source.unsplash.com/1600x900/?pasta" alt="Produk 3">
                <div class="card-body">
                    <h5 class="card-title">Pasta Carbonara</h5>
                    <p class="card-text">Nikmati pasta creamy dengan saus carbonara yang menggugah selera.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img src="https://source.unsplash.com/1600x900/?pasta" alt="Produk 3">
                <div class="card-body">
                    <h5 class="card-title">Pasta Carbonara</h5>
                    <p class="card-text">Nikmati pasta creamy dengan saus carbonara yang menggugah selera.</p>
                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- contentAkhir -->
@endsection



