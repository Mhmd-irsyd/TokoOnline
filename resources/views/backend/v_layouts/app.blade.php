<!DOCTYPE html>
<html lang="en" class="bg-gray-100">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>tokoonline</title>
    <link rel="icon" type="image/png" href="{{ asset('image/icon_univ_bsi.png') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col text-gray-800">

<!-- Navbar -->
<header class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-3 h-16">
        <div class="flex items-center space-x-3">
            <!-- Tombol Sidebar -->
            <button class="sidebar-toggle focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <a href="{{ route('backend.beranda') }}" class="flex items-center space-x-2">
                <img src="{{ asset('image/icon_univ_bsi.png') }}" class="h-8 w-8" />
                <img src="{{ asset('image/logo_text.png') }}" class="h-6 hidden md:block" />
            </a>
        </div>

        <!-- User Dropdown -->
        <div class="relative">
            <button onclick="toggleDropdown()" class="focus:outline-none">
                <img src="{{ Auth::user()->foto ? asset('storage/img-user/' . Auth::user()->foto) : asset('storage/img-user/img-default.jpg') }}"
                     alt="User" class="h-8 w-8 rounded-full" />
            </button>
            <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded shadow-lg hidden z-10">
                <a href="{{ route('backend.user.edit', Auth::user()->id) }}" class="block px-4 py-2 hover:bg-gray-100">Profil Saya</a>
                <form action="{{ route('backend.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Wrapper -->
<div class="flex flex-1 overflow-hidden relative">

    <!-- Sidebar -->
   <aside id="sidebar" class="fixed z-40 top-0 left-0 h-full w-64 bg-white border-r transform transition-transform duration-300 ease-in-out shadow-lg -translate-x-full">

        <div class="flex items-center justify-between px-4 py-3 h-16 bg-gray-800 text-white">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('image/icon_univ_bsi.png') }}" class="h-8 w-8" alt="Logo" />
                <span class="text-base font-semibold">Toko Online</span>
            </div>
           <!-- Tombol Close Sidebar -->
<button class="sidebar-toggle focus:outline-none">
    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>
        </div>

        <!-- Navigasi -->
        <nav class="space-y-2 text-sm p-4 pt-4">
            <a href="{{ route('backend.beranda') }}"
               class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-all
                      {{ request()->routeIs('backend.beranda') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m4-6v6m-4 0h4" />
                </svg>
                <span>Beranda</span>
            </a>

            <a href="{{ route('backend.user.index') }}"
               class="flex items-center space-x-3 px-3 py-2 rounded-lg transition-all
                      {{ request()->routeIs('backend.user.index') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>User</span>
            </a>

            <details class="group">
                <summary
                    class="flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all
                           {{ request()->is('backend/kategori*') || request()->is('backend/produk*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3h18v4H3zM3 9h18v4H3zM3 15h18v6H3z" />
                        </svg>
                        <span>Data Produk</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300 group-open:rotate-90"
                         fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 5l7 7-7 7" />
                    </svg>
                </summary>
                <div class="pl-10 mt-1 space-y-1 text-sm text-gray-600">
                    <a href="{{ route('backend.kategori.index') }}"
                       class="block hover:text-blue-600 {{ request()->routeIs('backend.kategori.index') ? 'text-blue-700 font-semibold' : '' }}">Kategori</a>
                    <a href="{{ route('backend.produk.index') }}"
                       class="block hover:text-blue-600 {{ request()->routeIs('backend.produk.index') ? 'text-blue-700 font-semibold' : '' }}">Produk</a>
                </div>
            </details>

            <details class="group">
                <summary
                    class="flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all
                           {{ request()->is('backend/laporan*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-700' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16v16H4zM8 4v16" />
                        </svg>
                        <span>Laporan</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-300 group-open:rotate-90"
                         fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 5l7 7-7 7" />
                    </svg>
                </summary>
                <div class="pl-10 mt-1 space-y-1 text-sm text-gray-600">
                    <a href="{{ route('backend.laporan.formuser') }}"
                       class="block hover:text-blue-600 {{ request()->routeIs('backend.laporan.formuser') ? 'text-blue-700 font-semibold' : '' }}">User</a>
                    <a href="{{ route('backend.laporan.formproduk') }}"
                       class="block hover:text-blue-600 {{ request()->routeIs('backend.laporan.formproduk') ? 'text-blue-700 font-semibold' : '' }}">Produk</a>
                </div>
            </details>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Tables</h1>
            <nav class="text-sm text-gray-500 space-x-1">
                <a href="#" class="hover:underline">Home</a>
                <span>/</span>
                <span class="text-gray-600">Library</span>
            </nav>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            @yield('content')
        </div>
    </main>
</div>

<!-- Footer -->
<footer class="bg-gray-200 text-center text-sm py-4">
    Web Programming. Studi Kasus Toko Online — <a href="https://bsi.ac.id/" class="text-blue-600 hover:underline">Kuliah..? BSI Aja !!!</a>
</footer>

<!-- Script -->
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggleButtons = document.querySelectorAll(".sidebar-toggle");

    sidebarToggleButtons.forEach(button => {
        button.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
        });
    });

    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('dropdownMenu');
        const isInsideDropdown = dropdown && dropdown.contains(e.target);
        const isDropdownButton = e.target.closest('[onclick="toggleDropdown()"]');
        if (!isInsideDropdown && !isDropdownButton && dropdown) {
            dropdown.classList.add('hidden');
        }

        const isSidebar = sidebar.contains(e.target);
        const isToggleBtn = e.target.closest(".sidebar-toggle");
        const isOpen = !sidebar.classList.contains("-translate-x-full");

        // Tutup sidebar jika klik di luar (semua ukuran layar)
        if (!isSidebar && !isToggleBtn && isOpen) {
            sidebar.classList.add("-translate-x-full");
        }
    });

    window.toggleDropdown = toggleDropdown;
});

</script>

</body>
</html>
