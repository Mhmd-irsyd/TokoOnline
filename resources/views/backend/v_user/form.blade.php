@extends('backend.v_layouts.app')

@section('content')
<!-- Template Form Laporan -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="form-horizontal" action="{{ route('backend.laporan.cetakuser') }}" method="post" target="_blank">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">{{ $judul }}</h4>

                    <!-- Tanggal Awal -->
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" value="{{ old('tanggal_awal') }}" 
                               class="form-control @error('tanggal_awal') is-invalid @enderror" 
                               onkeypress="return hanyaAngka(event)" placeholder="Masukkan Tanggal Awal">

                        @error('tanggal_awal')
                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Akhir -->
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" 
                               class="form-control @error('tanggal_akhir') is-invalid @enderror" 
                               onkeypress="return hanyaAngka(event)" placeholder="Masukkan Tanggal Akhir">

                        @error('tanggal_akhir')
                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <br>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Template Form Laporan -->
@endsection
