<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - Toko Online</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icon_univ_bsi.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="text-white min-h-screen flex flex-col relative bg-gradient-to-br from-gray-700 via-gray-800 to-gray-900 overflow-hidden">


    <!-- Atas -->
    <div class="flex-1 flex items-center justify-center px-4 relative z-10">

     <div class="w-full max-w-md p-6 rounded-2xl shadow-[inset_4px_4px_10px_#3f3f46,inset_-4px_-4px_10px_#52525b] bg-zinc-800 border border-zinc-700 space-y-6 transition-all duration-300">


            {{-- Error Alert --}}
            @if(session()->has('error'))
                <div class="bg-red-600 text-white px-4 py-3 rounded" role="alert">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

            {{-- Login Form --}}
            <div id="loginform">
                <h2 class="text-2xl font-bold text-center mb-4">Selamat Datang</h2>
                <p class="text-sm text-center text-gray-300 mb-4">Silakan login terlebih dahulu untuk melanjutkan.</p>
                <form action="{{ route('backend.login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan Email"
                            class="w-full mt-1 px-4 py-2 rounded border @error('email') border-red-500 @else border-gray-300 @enderror text-black"
                        />
                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan Password"
                            class="w-full mt-1 px-4 py-2 rounded border @error('password') border-red-500 @else border-gray-300 @enderror text-black"
                        />
                        @error('password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-600">
                        <button type="button" id="to-recover" class="text-sm text-blue-400 hover:underline">
                            <i class="fa fa-lock mr-1"></i>Lupa password?
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Login
                        </button>
                    </div>
                </form>
            </div>

            {{-- Recover Form --}}
            <div id="recoverform" class="hidden">
                <h2 class="text-xl font-semibold text-center mb-2">Reset Password</h2>
                <p class="text-sm text-gray-300 text-center mb-4">
                    Masukkan alamat email Anda untuk menerima instruksi reset password.
                </p>
                <form class="space-y-5">
                    <input
                        type="email"
                        placeholder="Email Anda"
                        class="w-full px-4 py-2 rounded border border-gray-300 text-black"
                    />
                    <div class="flex items-center justify-between pt-4 border-t border-gray-600">
                        <a href="#" id="to-login" class="text-sm text-green-400 hover:underline">Kembali ke Login</a>
                        <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Gelombang Putih di Bawah -->
<div class="absolute bottom-0 left-0 w-full z-0">
  <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
    <path fill="#ffffff" fill-opacity="1"
      d="M0,288L40,272C80,256,160,224,240,218.7C320,213,400,235,480,224C560,213,640,171,720,149.3C800,128,880,128,960,149.3C1040,171,1120,213,1200,229.3C1280,245,1360,235,1400,229.3L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
    </path>
  </svg>
</div>


    <!-- Script Toggle -->
    <script>
        document.getElementById('to-recover').addEventListener('click', () => {
            document.getElementById('loginform').classList.add('hidden');
            document.getElementById('recoverform').classList.remove('hidden');
        });

        document.getElementById('to-login').addEventListener('click', () => {
            document.getElementById('recoverform').classList.add('hidden');
            document.getElementById('loginform').classList.remove('hidden');
        });
    </script>

</body>
</html>
