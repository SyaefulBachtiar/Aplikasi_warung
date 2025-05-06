<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung App - Solusi Bisnis Warung Anda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-bold">WarungApp</a>
            <div>
                <a href="#features" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Fitur</a>
                <a href="#contact" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Kontak</a>
                <a href="/register" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Registrasi</a>
                <a href="/login" class="text-white px-4 py-2 hover:bg-blue-700 rounded">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-800 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Solusi Terbaik untuk Bisnis Warung Anda</h1>
            <p class="text-lg mb-6">Kelola warung dengan mudah, mulai dari transaksi hingga inventaris.</p>
            <a href="#features"
                class="bg-yellow-500 text-blue-800 px-6 py-3 text-xl font-semibold rounded-full hover:bg-yellow-400 transition duration-300">Pelajari
                Lebih Lanjut</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Fitur Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Manajemen Stok</h3>
                    <p>Kelola stok barang secara otomatis dan mudah, dengan notifikasi saat stok barang hampir habis.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Transaksi Mudah</h3>
                    <p>Proses transaksi menjadi lebih cepat dan efisien dengan sistem kasir digital yang mudah digunakan.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Laporan Keuangan</h3>
                    <p>Peroleh laporan keuangan lengkap dan real-time untuk memantau kinerja warung Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-gray-100 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Tentang Kami</h2>
            <p class="text-lg max-w-2xl mx-auto mb-8">WarungApp adalah aplikasi yang dirancang khusus untuk membantu pemilik warung dalam mengelola bisnis mereka. Dengan berbagai fitur seperti manajemen stok, transaksi digital, dan laporan keuangan, WarungApp memberikan solusi lengkap untuk meningkatkan efisiensi dan profitabilitas warung Anda.</p>
            <a href="#contact"
                class="bg-blue-600 text-white px-6 py-3 text-xl font-semibold rounded-full hover:bg-blue-500 transition duration-300">Hubungi
                Kami</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Kontak Kami</h2>
            <p class="text-lg mb-6">Jika Anda memiliki pertanyaan atau ingin bergabung, hubungi kami di bawah ini!</p>
            <div class="flex justify-center gap-6">
                <a href="mailto:info@warungapp.com"
                    class="bg-blue-600 text-white px-6 py-3 text-xl font-semibold rounded-full hover:bg-blue-500 transition duration-300">Email
                    Kami</a>
                <a href="tel:+1234567890"
                    class="bg-yellow-500 text-blue-800 px-6 py-3 text-xl font-semibold rounded-full hover:bg-yellow-400 transition duration-300">Telepon</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-4 text-center">
        <p>&copy; 2025 WarungApp. All Rights Reserved.</p>
    </footer>

</body>

</html>
