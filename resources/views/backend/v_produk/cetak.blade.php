<style>
    /* Styling untuk seluruh tabel */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        color: #333;
    }

    /* Gaya untuk baris dan kolom header */
    table th {
        background-color: #6c7ae0;
        color: #ffffff;
        font-weight: bold;
        text-align: left;
        padding: 12px;
        border-bottom: 2px solid #ddd;
    }

    /* Gaya untuk sel data */
    table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    /* Hover effect untuk baris */
    table tbody tr:hover {
        background-color: #f3f3f9;
    }

    /* Gaya untuk sel dan header pertama */
    table td:first-child,
    table th:first-child {
        border-left: 1px solid #ddd;
    }

    /* Gaya untuk sel dan header terakhir */
    table td:last-child,
    table th:last-child {
        border-right: 1px solid #ddd;
    }

    /* Gaya khusus untuk header */
    .table-header {
        font-size: 18px;
        font-weight: bold;
        color: #555;
        padding: 20px;
    }
</style>

<table>
    <tr>
        <td class="table-header">
            Perihal: {{ $judul }} <br>
            Tanggal Awal: {{ $tanggalAwal }} s/d Tanggal Akhir: {{ $tanggalAkhir }}
        </td>
    </tr>
</table>

<p></p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->kategori->nama_kategori }}</td>
                <td>
                    @if ($row->status == 1)
                        Publis
                    @elseif ($row->status == 0)
                        Blok
                    @endif
                </td>
                <td>{{ $row->nama_produk }}</td>
                <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                <td>{{ $row->stok }}</td>
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

