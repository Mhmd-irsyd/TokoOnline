@extends('backend.v_layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <form action="{{ route('backend.laporan.cetakuser') }}" method="POST" target="_blank" class="p-6 space-y-6">
            @csrf

            {{-- Judul --}}
            <h2 class="text-xl font-semibold text-gray-700">{{ $judul }}</h2>

            {{-- Tanggal Awal --}}
            <div>
                <label for="tanggal_awal" class="block text-sm font-medium text-gray-700">Tanggal Awal</label>
                <input 
                    type="date" 
                    name="tanggal_awal" 
                    id="tanggal_awal"
                    value="{{ old('tanggal_awal') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_awal') border-red-500 @enderror"
                >
                @error('tanggal_awal')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Akhir --}}
            <div>
                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                <input 
                    type="date" 
                    name="tanggal_akhir" 
                    id="tanggal_akhir"
                    value="{{ old('tanggal_akhir') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('tanggal_akhir') border-red-500 @enderror"
                >
                @error('tanggal_akhir')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <div class="pt-4 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    Cetak
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
