<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan User</title>
    @vite('resources/css/app.css') {{-- Load Tailwind via Vite --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Report Table Header -->
    <div class="max-w-4xl mx-auto my-6 p-4 bg-gray-100 border border-gray-300 text-sm rounded-md shadow">
        <p class="text-gray-700">
            <strong>Perihal:</strong> {{ $judul }}<br>
            <strong>Tanggal Awal:</strong> {{ $tanggalAwal }} s/d <strong>Tanggal Akhir:</strong> {{ $tanggalAkhir }}
        </p>
    </div>

    <!-- Data Table -->
    <div class="max-w-6xl mx-auto px-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow rounded-md">
                <thead class="bg-green-600 text-white text-sm">
                    <tr>
                        <th class="whitespace-nowrap px-4 py-3 text-left font-semibold uppercase">No</th>
                        <th class="whitespace-nowrap px-4 py-3 text-left font-semibold uppercase">Email</th>
                        <th class="whitespace-nowrap px-4 py-3 text-left font-semibold uppercase">Nama</th>
                        <th class="whitespace-nowrap px-4 py-3 text-left font-semibold uppercase">Role</th>
                        <th class="whitespace-nowrap px-4 py-3 text-left font-semibold uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach ($cetak as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-4 py-2 font-semibold text-gray-700">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-800">{{ $row->email }}</td>
                            <td class="whitespace-nowrap px-4 py-2 text-gray-800">{{ $row->nama }}</td>
                            <td class="whitespace-nowrap px-4 py-2 font-semibold {{ $row->role == 1 ? 'text-purple-600' : 'text-blue-600' }}">
                                {{ $row->role == 1 ? 'Super Admin' : 'Admin' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-2 font-semibold {{ $row->status == 1 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $row->status == 1 ? 'Aktif' : 'NonAktif' }}
                            </td>
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
