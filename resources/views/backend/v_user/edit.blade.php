@extends('backend.v_layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <form action="{{ route('backend.user.update', $edit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('put')

            {{-- Header --}}
            <div class="px-6 pt-6">
                <h2 class="text-xl font-semibold text-gray-700">{{ $judul }}</h2>
            </div>

            {{-- Form Body --}}
            <div class="px-6 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- Foto --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto</label>
                        <img 
                            src="{{ $edit->foto ? asset('storage/img-user/' . $edit->foto) : asset('storage/img-user/img-default.jpg') }}"
                            id="preview-img"
                            class="rounded-md mt-2 w-full h-auto object-cover max-h-60"
                        >
                        <input type="file" name="foto" onchange="previewFoto()"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 @error('foto') border-red-500 @enderror">
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Informasi User --}}
                    <div class="md:col-span-2 space-y-4">

                        {{-- Role --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Hak Akses</label>
                            <select name="role"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('role') border-red-500 @enderror">
                                <option value="" {{ old('role', $edit->role) === '' ? 'selected' : '' }}>- Pilih Hak Akses -</option>
                                <option value="1" {{ old('role', $edit->role) == '1' ? 'selected' : '' }}>Super Admin</option>
                                <option value="0" {{ old('role', $edit->role) == '0' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror">
                                <option value="" {{ old('status', $edit->status) === '' ? 'selected' : '' }}>- Pilih Status -</option>
                                <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>NonAktif</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" value="{{ old('nama', $edit->nama) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('nama') border-red-500 @enderror"
                                placeholder="Masukkan Nama">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $edit->email) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror"
                                placeholder="Masukkan Email">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nomor HP --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="text" name="hp" value="{{ old('hp', $edit->hp) }}" onkeypress="return hanyaAngka(event)"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm @error('hp') border-red-500 @enderror"
                                placeholder="Masukkan Nomor HP">
                            @error('hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                    Perbaharui
                </button>
                <a href="{{ route('backend.user.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
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
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
