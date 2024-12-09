<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans">
    <!-- Container -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gradient-to-b from-blue-800 to-blue-600 text-white flex flex-col transition-all duration-300">
            <div class="p-6 text-center text-xl font-bold border-b border-blue-500">Admin Dashboard</div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="p-4">
                    <li class="mb-3">
                        <a href="#" class="block py-3 px-4 hover:bg-blue-700 rounded transition-all duration-300">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block py-3 px-4 hover:bg-blue-700 rounded transition-all duration-300">
                            <i class="fas fa-users mr-2"></i>Users
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block py-3 px-4 hover:bg-blue-700 rounded transition-all duration-300">
                            <i class="fas fa-flag mr-2"></i>Reports
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="block py-3 px-4 hover:bg-blue-700 rounded transition-all duration-300">
                            <i class="fas fa-cogs mr-2"></i>Settings
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-6 border-t border-blue-500">
                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition-all duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <!-- Header -->
            <header class="flex justify-between items-center mb-6">
                <button id="toggleSidebar" class="text-blue-800 text-xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-3xl font-bold text-gray-700">Welcome, Admin</h1>
                <div class="text-right">
                    <p id="server-time" class="text-gray-500 text-sm">Loading time...</p>
                    <span id="active-users" class="text-gray-500 text-lg">Active users: Loading...</span>
                </div>
            </header>

            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition-all duration-300">
                    <h2 class="text-xl font-bold mb-2">Total Users</h2>
                    <p class="text-4xl">1,234</p>
                </div>
                <div class="bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition-all duration-300">
                    <h2 class="text-xl font-bold mb-2">New Signups</h2>
                    <p class="text-4xl">56</p>
                </div>
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white shadow-lg p-6 rounded-lg transform hover:scale-105 transition-all duration-300">
                    <h2 class="text-xl font-bold mb-2">Revenue</h2>
                    <p class="text-4xl">$12,345</p>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Monthly Revenue</h2>
                    <canvas id="revenueChart"></canvas>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">User Growth</h2>
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </main>

        <!-- Notification Toast -->
        <div id="toast" class="fixed bottom-4 right-4 bg-blue-600 text-white p-4 rounded-lg shadow-lg opacity-0 transition-opacity duration-300">
            Real-time update: <span id="toast-message"></span>
        </div>
    </div>

    @vite('resources/js/app.js')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar toggle
            const sidebar = document.getElementById('sidebar');
            const toggleSidebar = document.getElementById('toggleSidebar');
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('-ml-64');
            });

            // Server time
            const serverTimeElement = document.getElementById('server-time');
            setInterval(() => {
                const now = new Date();
                serverTimeElement.textContent = `Server Time: ${now.toLocaleTimeString()}`;
            }, 1000);

            // Active users (simulated real-time data)
            const activeUsersElement = document.getElementById('active-users');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');

            setInterval(() => {
                const activeUsers = Math.floor(Math.random() * 100) + 1; // Simulated active users
                activeUsersElement.textContent = `Active users: ${activeUsers}`;

                // Show toast notification
                toastMessage.textContent = `${activeUsers} users online`;
                toast.classList.remove('opacity-0');
                setTimeout(() => toast.classList.add('opacity-0'), 3000);
            }, 3000);

            // Charts (using Chart.js)
            const revenueChartCtx = document.getElementById('revenueChart').getContext('2d');
            const userChartCtx = document.getElementById('userChart').getContext('2d');

            new Chart(revenueChartCtx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Revenue',
                        data: [5000, 8000, 6000, 9000, 12000, 15000],
                        borderColor: '#4F46E5',
                        backgroundColor: 'rgba(79, 70, 229, 0.3)',
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                }
            });

            new Chart(userChartCtx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'User Growth',
                        data: [50, 80, 60, 90, 120, 150],
                        backgroundColor: '#34D399',
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
