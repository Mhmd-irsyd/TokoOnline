@extends('Backend.V_Layouts.App')

@section('content')
<!-- contentAwal -->
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <form action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Header --}}
            <div class="px-6 pt-6">
                <h2 class="text-xl font-semibold text-gray-700">{{ $judul }}</h2>
            </div>

            {{-- Form Content --}}
            <div class="px-6 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Foto --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto</label>
                        <img class="foto-preview hidden mt-2 rounded-md w-full max-h-60 object-cover" id="preview-img">
                        <input type="file" name="foto" onchange="previewFoto()"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 @error('foto') border-red-500 @enderror">
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Informasi User --}}
                    <div class="md:col-span-2 space-y-4">
                        {{-- Hak Akses --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hak Akses</label>
                            <select name="role"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('role') border-red-500 @enderror">
                                <option value="" @selected(old('role') == '')>- Pilih Hak Akses -</option>
                                <option value="1" @selected(old('role') == '1')>Super Admin</option>
                                <option value="0" @selected(old('role') == '0')>Admin</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('nama') border-red-500 @enderror"
                                placeholder="Masukkan Nama">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror"
                                placeholder="Masukkan Email">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="text" name="hp" value="{{ old('hp') }}" onkeypress="return hanyaAngka(event)"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('hp') border-red-500 @enderror"
                                placeholder="Masukkan Nomor HP">
                            @error('hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('password') border-red-500 @enderror"
                                placeholder="Masukkan Password">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"
                                placeholder="Konfirmasi Password">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition">
                    Simpan
                </button>
                <a href="{{ route('backend.user.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-400 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<!-- contentAkhir -->
@endsection

@push('scripts')
<script>
    function previewFoto() {
        const input = document.querySelector('input[name="foto"]');
        const preview = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
