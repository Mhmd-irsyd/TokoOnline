@extends('backend.v_layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    
    {{-- Tombol Tambah --}}
    <div class="mb-4">
        <a href="{{ route('backend.user.create') }}">
            <button type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Tambah
            </button>
        </a>
    </div>

    {{-- Card Table --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $judul }}</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 font-semibold">No</th>
                            <th class="px-4 py-2 font-semibold">Nama</th>
                            <th class="px-4 py-2 font-semibold">Email</th>
                            <th class="px-4 py-2 font-semibold">Role</th>
                            <th class="px-4 py-2 font-semibold">Status</th>
                            <th class="px-4 py-2 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($index as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $row->nama }}</td>
                            <td class="px-4 py-2">{{ $row->email }}</td>
                            <td class="px-4 py-2">
                                @if ($row->role == 1)
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded">Super Admin</span>
                                @elseif ($row->role == 0)
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded">Admin</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if ($row->status == 1)
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded">Aktif</span>
                                @elseif ($row->status == 0)
                                    <span class="inline-block px-2 py-1 text-xs font-medium text-gray-600 bg-gray-200 rounded">NonAktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-1 whitespace-nowrap">
                                {{-- Tombol Ubah --}}
                                <a href="{{ route('backend.user.edit', $row->id) }}" title="Ubah Data">
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 bg-cyan-600 text-white text-xs font-medium rounded hover:bg-cyan-700 transition">
                                        <i class="far fa-edit mr-1"></i> Ubah
                                    </button>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form method="POST" action="{{ route('backend.user.destroy', $row->id) }}" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus {{ $row->nama }}?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($index->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
