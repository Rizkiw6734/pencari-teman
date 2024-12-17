<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AroundYou - Temukan Teman Baru</title>
  @vite('resources/css/app.css')
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            fadeIn: 'fadeIn 1.5s ease-in-out',
            slideIn: 'slideIn 1s ease-out',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideIn: {
              '0%': { transform: 'translateX(-50%)', opacity: '0' },
              '100%': { transform: 'translateX(0)', opacity: '1' },
            },
          },
        },
      },
    };
  </script>
</head>
<body class="bg-gray-50">
  <!-- Hero Section -->
  <header class="bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto py-20 px-8 text-center">
      <h1 class="text-5xl md:text-7xl font-bold animate-fadeIn">Selamat Datang di AroundYou</h1>
      <p class="mt-4 text-xl md:text-2xl">Temukan teman baru di sekitar Anda dengan mudah dan aman!</p>
      <div class="mt-8 flex justify-center space-x-4">
        <a href="#features" class="bg-white text-indigo-600 px-6 py-3 rounded-full font-semibold hover:bg-indigo-50 transition">Jelajahi</a>
        <a href="#daftar" class="bg-indigo-700 px-6 py-3 rounded-full hover:bg-indigo-600 transition">Daftar Sekarang</a>
      </div>
    </div>
  </header>

  <!-- Features Section -->
  <section id="features" class="py-16 px-8 bg-white text-gray-800">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Kenapa Memilih AroundYou?</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center p-8 shadow-lg rounded-lg hover:shadow-xl transition-all">
          <div class="text-5xl text-indigo-600 mb-4">🔍</div>
          <h3 class="text-2xl font-bold">Pencarian Teman</h3>
          <p class="mt-4">Cari teman berdasarkan lokasi, minat, dan usia dengan mudah.</p>
        </div>
        <div class="text-center p-8 shadow-lg rounded-lg hover:shadow-xl transition-all">
          <div class="text-5xl text-indigo-600 mb-4">💬</div>
          <h3 class="text-2xl font-bold">Chat Langsung</h3>
          <p class="mt-4">Mulai percakapan langsung dengan teman baru Anda.</p>
        </div>
        <div class="text-center p-8 shadow-lg rounded-lg hover:shadow-xl transition-all">
          <div class="text-5xl text-indigo-600 mb-4">🛡️</div>
          <h3 class="text-2xl font-bold">Keamanan & Laporan</h3>
          <p class="mt-4">Laporkan aktivitas tidak pantas dengan cepat dan mudah.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonial Section -->
  <section class="py-16 px-8 bg-gradient-to-r from-purple-600 to-blue-500 text-white">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Apa Kata Pengguna?</h2>
      <div class="relative">
        <div class="flex space-x-8 overflow-hidden">
          <div class="bg-white text-gray-800 p-8 rounded-lg shadow-lg w-1/3 animate-slideIn">
            <p class="italic">"Layanan ini sangat membantu saya menemukan teman baru di sekitar."</p>
            <h4 class="mt-4 font-bold">- Aulia</h4>
          </div>
          <div class="bg-white text-gray-800 p-8 rounded-lg shadow-lg w-1/3 animate-slideIn">
            <p class="italic">"Sangat aman, saya merasa nyaman menggunakannya!"</p>
            <h4 class="mt-4 font-bold">- Bayu</h4>
          </div>
          <div class="bg-white text-gray-800 p-8 rounded-lg shadow-lg w-1/3 animate-slideIn">
            <p class="italic">"Fitur-fiturnya memudahkan saya untuk berkomunikasi dengan pengguna lain."</p>
            <h4 class="mt-4 font-bold">- Citra</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section id="daftar" class="py-20 bg-indigo-50 text-center">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-gray-800">Bergabung Sekarang!</h2>
      <p class="mt-4 text-xl text-gray-600">Jadilah bagian dari komunitas yang terus berkembang.</p>
      <a href="/register" class="mt-6 inline-block bg-indigo-600 text-white px-8 py-4 rounded-full font-bold hover:bg-indigo-700 transition">Daftar Gratis</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-400 py-8">
    <div class="max-w-7xl mx-auto text-center">
      <p>&copy; 2024 AroundYou. Semua Hak Dilindungi.</p>
      <div class="flex justify-center space-x-6 mt-4">
        <a href="#" class="hover:text-white">Tentang Kami</a>
        <a href="#" class="hover:text-white">Kebijakan Privasi</a>
        <a href="#" class="hover:text-white">Hubungi Kami</a>
      </div>
    </div>
  </footer>
</body>
</html>
