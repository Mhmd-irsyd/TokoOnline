@extends('backend.v_layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-md p-6">
        <form action="{{ route('backend.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ $judul }}</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Foto --}}
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                    <input type="file" name="foto" onchange="previewFoto()" class="block w-full text-sm text-gray-900
                        file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                    <img class="foto-preview mt-3 hidden rounded shadow max-w-full" alt="Preview Foto">
                    @error('foto')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kolom Lain --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none @error('kategori_id') border-red-500 @enderror">
                            <option value="">--Pilih Kategori--</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Masukkan Nama Produk"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none @error('nama_produk') border-red-500 @enderror">
                        @error('nama_produk')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Detail --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Detail</label>
                        <textarea name="detail" id="ckeditor" rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none @error('detail') border-red-500 @enderror">{{ old('detail') }}</textarea>
                        @error('detail')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                        <input type="text" name="harga" value="{{ old('harga') }}" onkeypress="return hanyaAngka(event)"
                            placeholder="Masukkan Harga Produk"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none @error('harga') border-red-500 @enderror">
                        @error('harga')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Berat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Berat</label>
                        <input type="text" name="berat" value="{{ old('berat') }}" onkeypress="return hanyaAngka(event)"
                            placeholder="Masukkan Berat Produk"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none @error('berat') border-red-500 @enderror">
                        @error('berat')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                        <input type="text" name="stok" value="{{ old('stok') }}" onkeypress="return hanyaAngka(event)"
                            placeholder="Masukkan Stok Produk"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none @error('stok') border-red-500 @enderror">
                        @error('stok')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col sm:flex-row justify-end items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 mt-6 border-t pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm sm:text-base">
                    Simpan
                </button>
                <a href="{{ route('backend.produk.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition text-sm sm:text-base">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Script preview foto --}}
<script>
    function previewFoto() {
        const foto = document.querySelector("input[name='foto']");
        const preview = document.querySelector(".foto-preview");

        preview.style.display = "block";
        const reader = new FileReader();
        reader.readAsDataURL(foto.files[0]);

        reader.onload = function(e) {
            preview.src = e.target.result;
        };
    }

    function hanyaAngka(evt) {
        const charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            evt.preventDefault();
        }
    }
</script>
@endsection
