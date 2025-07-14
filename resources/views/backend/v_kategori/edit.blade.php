@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal -->
<div class="max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('backend.kategori.update', $edit->id) }}" method="POST" class="space-y-6">
            @method('put')
            @csrf

            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $judul }}</h2>
            </div>

            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    value="{{ old('nama_kategori', $edit->nama_kategori) }}"
                    placeholder="Masukkan Nama Kategori"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_kategori') border-red-500 @enderror"
                >
                @error('nama_kategori')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-between gap-3">
                <button type="submit"
                    class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-150">
                    Perbaharui
                </button>
                <a href="{{ route('backend.kategori.index') }}"
                    class="w-full sm:w-auto px-4 py-2 bg-gray-500 text-white text-center rounded hover:bg-gray-600 transition duration-150">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<!-- contentAkhir -->
@endsection
