<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk</title>
    @vite('resources/css/app.css') {{-- Tailwind dari Vite --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="px-4 sm:px-6 lg:px-8 py-6">
        <div class="mb-6 text-sm sm:text-base text-gray-700">
            <p class="font-semibold text-lg mb-2">Perihal: {{ $judul }}</p>
            <p>Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse text-sm text-gray-700 bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-indigo-600 text-white text-left">
                        <th class="px-4 py-3 border-b border-gray-300">No</th>
                        <th class="px-4 py-3 border-b border-gray-300">Kategori</th>
                        <th class="px-4 py-3 border-b border-gray-300">Status</th>
                        <th class="px-4 py-3 border-b border-gray-300">Nama Produk</th>
                        <th class="px-4 py-3 border-b border-gray-300">Harga</th>
                        <th class="px-4 py-3 border-b border-gray-300">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cetak as $row)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">{{ $row->kategori->nama_kategori }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">
                                @if ($row->status == 1)
                                    Publis
                                @elseif ($row->status == 0)
                                    Blok
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">{{ $row->nama_produk }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">{{ $row->stok }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
