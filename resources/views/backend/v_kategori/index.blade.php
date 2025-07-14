@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal -->
<div class="space-y-6 px-4 sm:px-6 lg:px-8 py-6">

    <!-- Tombol Tambah -->
    <div class="flex justify-between items-center">
        <a href="{{ route('backend.kategori.create') }}">
            <button type="button"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah
            </button>
        </a>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h5 class="text-xl font-semibold mb-4">{{ $judul }}</h5>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm" id="zero_config">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">No</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Nama Kategori</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($index as $row)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $row->nama_kategori }}</td>
                                <td class="px-4 py-2 whitespace-nowrap space-x-2">
                                    <a href="{{ route('backend.kategori.edit', $row->id) }}" title="Ubah Data">
                                        <button type="button"
                                                class="inline-flex items-center px-3 py-1 text-xs font-medium bg-cyan-600 text-white rounded hover:bg-cyan-700">
                                            <i class="far fa-edit mr-1"></i> Ubah
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ route('backend.kategori.destroy', $row->id) }}" class="inline-block">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 text-xs font-medium bg-red-600 text-white rounded hover:bg-red-700 show_confirm"
                                                data-konf-delete="{{ $row->nama_kategori }}" title="Hapus Data">
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
<!-- contentAkhir -->
@endsection
