@extends('backend.v_layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white shadow-md rounded-md overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">{{ $judul }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Detail Produk -->
                <div class="md:col-span-2 space-y-4">
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori_id" disabled
                            class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 focus:ring focus:ring-indigo-200">
                            <option value="" selected> - Pilih Kategori - </option>
                            @foreach ($kategori as $row)
                                <option value="{{ $row->id }}" {{ old('kategori_id', $show->kategori_id) == $row->id ? 'selected' : '' }}>
                                    {{ $row->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nama Produk --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk', $show->nama_produk) }}" disabled
                               class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 focus:ring focus:ring-indigo-200">
                    </div>

                    {{-- Detail --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Detail</label>
                        <textarea disabled name="detail"
                                  class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100 text-gray-700 focus:ring focus:ring-indigo-200"
                                  rows="5">{{ old('detail', $show->detail) }}</textarea>
                    </div>
                </div>

                <!-- Foto Produk -->
                <div class="space-y-6">
                    {{-- Foto Utama --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Utama</label>
                        <img src="{{ asset('storage/img-produk/' . $show->foto) }}" alt="Foto Utama"
                             class="w-full rounded-md shadow object-cover max-h-60">
                    </div>

                    {{-- Foto Tambahan --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Tambahan</label>
                        <div class="space-y-4">
                            @foreach($show->gambar as $gambar)
                                <div class="flex flex-col sm:flex-row gap-4 items-start">
                                    <div class="flex-1">
                                        <img src="{{ asset('storage/img-produk/' . $gambar->foto) }}" alt="Foto Tambahan"
                                             class="w-full rounded-md shadow object-cover max-h-60">
                                    </div>
                                    <form action="{{ route('backend.foto_produk.destroy', $gambar->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 text-sm rounded shadow">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        {{-- (Jika butuh tambah foto secara manual bisa tambahkan form di sini) --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="bg-gray-50 px-6 py-4 flex justify-end">
            <a href="{{ route('backend.produk.index') }}">
                <button type="button"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow text-sm">
                    Kembali
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
