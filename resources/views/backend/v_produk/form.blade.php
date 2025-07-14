@extends('backend.v_layouts.app')

@section('content')
<!-- Container Utama -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-md p-6">
        <form action="{{ route('backend.laporan.cetakproduk') }}" method="POST" target="_blank">
            @csrf
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ $judul }}</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Tanggal Awal --}}
                <div>
                    <label for="tanggal_awal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal"
                        value="{{ old('tanggal_awal') }}"
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none @error('tanggal_awal') border-red-500 @enderror"
                        placeholder="Masukkan Tanggal Awal">
                    @error('tanggal_awal')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Akhir --}}
                <div>
                    <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                        value="{{ old('tanggal_akhir') }}"
                        class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none @error('tanggal_akhir') border-red-500 @enderror"
                        placeholder="Masukkan Tanggal Akhir">
                    @error('tanggal_akhir')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tombol Cetak --}}
            <div class="mt-6">
                <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                    Cetak
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
