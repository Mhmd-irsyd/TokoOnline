<style>
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fa;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
    }

    table td {
        font-size: 14px;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Styling for the table row number column */
    table tbody tr td:first-child {
        font-weight: bold;
        color: #333;
    }

    /* Conditional Styling for Status and Role */
    .status-active {
        color: #28a745;
        font-weight: bold;
    }

    .status-inactive {
        color: #dc3545;
        font-weight: bold;
    }

    .role-admin {
        color: #007bff;
        font-weight: bold;
    }

    .role-super-admin {
        color: #6610f2;
        font-weight: bold;
    }

    /* Header Styling */
    .header-info {
        padding: 10px 15px;
        background-color: #f1f1f1;
        border: 1px solid #ddd;
        margin-bottom: 20px;
    }
</style>

<!-- Report Table Header -->
<table>
    <tr>
        <td class="header-info">
            Perihal: {{ $judul }} <br>
            Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
        </td>
    </tr>
</table>

<!-- Data Table -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->nama }}</td>
            <td class="{{ $row->role == 1 ? 'role-super-admin' : 'role-admin' }}">
                @if ($row->role == 1)
                    Super Admin
                @elseif($row->role == 0)
                    Admin
                @endif
            </td>
            <td class="{{ $row->status == 1 ? 'status-active' : 'status-inactive' }}">
                @if ($row->status == 1)
                    Aktif
                @elseif($row->status == 0)
                    NonAktif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>

