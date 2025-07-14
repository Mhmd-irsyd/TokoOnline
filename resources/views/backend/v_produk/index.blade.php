@extends('backend.v_layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('backend.produk.create') }}">
            <button type="button"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded shadow">
                <i class="fas fa-plus mr-2"></i> Tambah
            </button>
        </a>
    </div>

    {{-- Card Wrapper --}}
    <div class="bg-white shadow-md rounded-md overflow-hidden">
        <div class="p-4 sm:p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $judul }}</h2>

            {{-- Scroll horizontal agar responsif di HP --}}
            <div class="overflow-x-auto">
                <table id="zero_config" class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">No</th>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Kategori</th>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Status</th>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Nama Produk</th>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Harga</th>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Stok</th>
                            <th class="px-4 py-2 text-left font-medium whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($index as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $row->kategori->nama_kategori }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    @if ($row->status == 1)
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Publis</span>
                                    @else
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 rounded">Blok</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $row->nama_produk }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $row->stok }}</td>
                                <td class="px-4 py-2 whitespace-nowrap space-x-1">
                                    {{-- Tombol Ubah --}}
                                    <a href="{{ route('backend.produk.edit', $row->id) }}" title="Ubah Data">
                                        <button type="button"
                                            class="inline-flex items-center text-sm bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-1 rounded">
                                            <i class="far fa-edit mr-1"></i> Ubah
                                        </button>
                                    </a>

                                    {{-- Tombol Gambar --}}
                                    <a href="{{ route('backend.produk.show', $row->id) }}" title="Tambah Gambar">
                                        <button type="button"
                                            class="inline-flex items-center text-sm bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded">
                                            <i class="fas fa-plus mr-1"></i> Gambar
                                        </button>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form method="POST"
                                          action="{{ route('backend.produk.destroy', $row->id) }}"
                                          class="inline"
                                          onsubmit="return confirm('Apakah yakin ingin menghapus produk {{ $row->nama_produk }}?')">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center text-sm bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
