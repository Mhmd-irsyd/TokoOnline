<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use App\Helpers\ImageHelper;
use App\Models\FotoProduk;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('updated_at', 'desc')->get();
return view('backend.v_produk.index', [
'judul' => 'Data Produk',
'index' => $produk
]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data kategori yang terurut berdasarkan nama_kategori secara ascending
    $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

    // Mengembalikan view dengan membawa data kategori dan judul
    return view('backend.v_produk.create', [
        'judul' => 'Tambah Produk', // Judul halaman
        'kategori' => $kategori     // Data kategori untuk dipilih pada form
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan user_id diambil dari pengguna yang sedang login
        $userId = auth()->id();  // Mengambil ID user yang sedang login
    
        // Validasi input
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required|max:255|unique:produk',
            'detail' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'stok' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], [
            'foto.image' => 'Format gambar harus menggunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ]);
    
        // Menambahkan status default
        $validatedData['status'] = 0;
        
        // Menambahkan user_id ke data produk
        $validatedData['user_id'] = $userId;
    
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-produk/';
    
            // Simpan gambar asli
            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            $validatedData['foto'] = $fileName;
    
            // Create thumbnail 1 (lg)
            $thumbnailLg = 'thumb_lg_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailLg, 800, null);
    
            // Create thumbnail 2 (md)
            $thumbnailMd = 'thumb_md_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailMd, 500, 519);
    
            // Create thumbnail 3 (sm)
            $thumbnailSm = 'thumb_sm_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailSm, 100, 110);
    
            // Simpan nama file asli di database
            $validatedData['foto'] = $originalFileName;
        }
    
        // Simpan data produk dengan user_id yang telah ditambahkan
        Produk::create($validatedData);
    
        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil tersimpan');
    }
    



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         
$produk = Produk::with('gambar')->findOrFail($id);
$kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
return view('backend.v_produk.show', [
'judul' => 'Detail Produk', 
'show' => $produk,
'kategori' => $kategori
]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         
$produk = Produk::findOrFail($id);
$kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
return view('backend.v_produk.edit', [
'judul' => 'Ubah Produk',
'edit' => $produk,
'kategori' => $kategori
]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          // dd($request); // Uncomment this line for debugging

$produk = Produk::findOrFail($id);

// Validasi data input
$rules = [
    'nama_produk' => 'required|max:255|unique:produk,nama_produk,' . $id,
    'kategori_id' => 'required',
    'status' => 'required',
    'detail' => 'required',
    'harga' => 'required',
    'berat' => 'required',
    'stok' => 'required',
    'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
];

$messages = [
    'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
    'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.',
];

// Menambahkan user_id
$validatedData['user_id'] = auth()->id();

// Melakukan validasi input
$validatedData = $request->validate($rules, $messages);

// Memproses file foto jika ada
if ($request->file('foto')) {
    // Menghapus gambar lama jika ada
    if ($produk->foto) {
        $oldImagePath = public_path('storage/img-produk/') . $produk->foto;
        $oldThumbnailLg = public_path('storage/img-produk/') . 'thumb_lg_' . $produk->foto;
        $oldThumbnailMd = public_path('storage/img-produk/') . 'thumb_md_' . $produk->foto;
        $oldThumbnailSm = public_path('storage/img-produk/') . 'thumb_sm_' . $produk->foto;

        // Menghapus gambar dan thumbnail lama jika ada
        foreach ([$oldImagePath, $oldThumbnailLg, $oldThumbnailMd, $oldThumbnailSm] as $filePath) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    // Menyimpan gambar baru
    $file = $request->file('foto');
    $extension = $file->getClientOriginalExtension();
    $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
    $directory = 'storage/img-produk/';

    // Simpan gambar asli
    $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName);
    $validatedData['foto'] = $fileName;

    // Membuat dan menyimpan thumbnail
    $thumbnailLg = 'thumb_lg_' . $originalFileName;
    ImageHelper::uploadAndResize($file, $directory, $thumbnailLg, 800, null);

    $thumbnailMd = 'thumb_md_' . $originalFileName;
    ImageHelper::uploadAndResize($file, $directory, $thumbnailMd, 500, 519);

    $thumbnailSm = 'thumb_sm_' . $originalFileName;
    ImageHelper::uploadAndResize($file, $directory, $thumbnailSm, 100, 110);
}

// Memperbarui produk dengan data yang sudah divalidasi
$produk->update($validatedData);

// Redirect ke halaman produk dengan pesan sukses
return redirect()->route('backend.produk.index')->with('success', 'Data berhasil diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $directory = public_path('storage/img-produk/');
        if ($produk->foto) {
        // Hapus gambar asli
        $oldImagePath = $directory . $produk->foto;
        if (file_exists($oldImagePath)) {
        unlink($oldImagePath);
        }
        // Hapus thumbnail lg
        $thumbnailLg = $directory . 'thumb_lg_' . $produk->foto;
        if (file_exists($thumbnailLg)) {
        unlink($thumbnailLg);
        }
        // Hapus thumbnail md
        $thumbnailMd = $directory . 'thumb_md_' . $produk->foto;
        if (file_exists($thumbnailMd)) {
        unlink($thumbnailMd);
        }
        // Hapus thumbnail sm
        $thumbnailSm = $directory . 'thumb_sm_' . $produk->foto;
        if (file_exists($thumbnailSm)) {
        unlink($thumbnailSm);
        }
        }
        // Hapus foto produk lainnya di tabel foto_produk
        $fotoProduks = FotoProduk::where('produk_id', $id)->get();
        foreach ($fotoProduks as $fotoProduk) {
        $fotoPath = $directory . $fotoProduk->foto;
        if (file_exists($fotoPath)) {
        unlink($fotoPath);
        }
        $fotoProduk->delete();
        }
        $produk->delete();
        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil 
        dihapus');
    }
    // Method untuk menyimpan foto tambahan
public function storeFoto(Request $request)
{
    // Validasi input
    $request->validate([
        'produk_id' => 'required|exists:produk,id',
        'foto_produk.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
    ]);

    if ($request->hasFile('foto_produk')) {
        foreach ($request->file('foto_produk') as $file) {
            // Buat nama file yang unik
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-produk/';

            // Simpan dan resize gambar menggunakan ImageHelper
            ImageHelper::uploadAndResize($file, $directory, $filename, 800, null);

            // Simpan data ke database
            FotoProduk::create([
                'produk_id' => $request->produk_id,
                'foto' => $filename,
            ]);
        }
    }

    return redirect()->route('backend.produk.show', $request->produk_id)
                     ->with('success', 'Foto berhasil ditambahkan.');
}

// Method untuk menghapus foto
public function destroyFoto($id)
{
    $foto = FotoProduk::findOrFail($id);
    $produkId = $foto->produk_id;

    // Hapus file gambar dari storage
    $imagePath = public_path('storage/img-produk/') . $foto->foto;
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Hapus record dari database
    $foto->delete();

    return redirect()->route('backend.produk.show', $produkId)
                     ->with('success', 'Foto berhasil dihapus.');
}

       // Method untuk Form Laporan Produk
public function formProduk()
{
    return view('backend.v_produk.form', [
        'judul' => 'Laporan Data Produk',
    ]);
}

// Method untuk Cetak Laporan Produk
public function cetakProduk(Request $request)
{
    // Menambahkan aturan validasi
    $request->validate([
        'tanggal_awal' => 'required|date', // Validasi tanggal_awal harus ada dan berupa tanggal
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal', // Tanggal akhir harus ada dan lebih besar atau sama dengan tanggal_awal
    ], [
        'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
        'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
        'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
    ]);

    // Mendapatkan input dari request
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Menyusun query untuk mengambil data produk yang diupdate antara tanggal yang diberikan
    $query = Produk::whereBetween('updated_at', [$tanggalAwal, $tanggalAkhir])
                   ->orderBy('id', 'desc'); // Menyortir berdasarkan ID secara menurun

    // Mengambil data produk
    $produk = $query->get();

    // Mengirimkan data ke view
    return view('backend.v_produk.cetak', [
        'judul' => 'Laporan Produk', // Judul laporan
        'tanggalAwal' => $tanggalAwal, // Tanggal Awal yang dipilih
        'tanggalAkhir' => $tanggalAkhir, // Tanggal Akhir yang dipilih
        'cetak' => $produk, // Data produk yang diambil
    ]);
}



}
