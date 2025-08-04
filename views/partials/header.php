<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="/app1/public/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-primary text-text-main font-body">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="/app1/public/" class="text-2xl font-bold text-text-main font-display"> Srinaman Camping&Resort <br> ศรีนาม่าน แคมป์ปิ้งแอนด์รีสอร์ท</a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/app1/public/" class="flex items-center space-x-2 px-4 py-2 text-text-main hover:text-accent transition-colors duration-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Home</span>
                    </a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="relative group focus:outline-none">
                                <svg class="h-8 w-8 text-text-main group-hover:text-accent transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-full mb-2 w-auto px-2 py-1 bg-gray-700 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20" x-transition>
                                <a href="/app1/public/user/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-light hover:text-text-main">โปรไฟล์</a>
                                <a href="/app1/public/user/bookings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-light hover:text-text-main">ประวัติการจอง</a>
                                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="/app1/public/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-light hover:text-text-main">Admin Dashboard</a>
                                <?php endif; ?>
                                <a href="/app1/public/auth/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-light hover:text-text-main">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/app1/public/auth/login" class="relative group">
                             <svg class="h-8 w-8 text-text-main group-hover:text-accent transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                             <span class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-full mb-2 w-auto px-2 py-1 bg-gray-700 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Login</span>
                        </a>
                        <a href="/app1/public/auth/register" class="relative group">
                            <svg class="h-8 w-8 text-text-main group-hover:text-accent transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-full mb-2 w-auto px-2 py-1 bg-gray-700 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Register</span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4">
                <a href="/app1/public/" class="block py-2 px-4 text-sm text-gray-600 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-700 rounded">Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <a href="/app1/public/admin/dashboard" class="block py-2 px-4 text-sm text-gray-600 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-700 rounded">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="/app1/public/auth/logout" class="block py-2 px-4 text-sm text-gray-600 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-700 rounded">Logout</a>
                <?php else: ?>
                    <a href="/app1/public/auth/login" class="block py-2 px-4 text-sm text-gray-600 dark:text-gray-300 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-700 rounded">Login</a>
                    <a href="/app1/public/auth/register" class="block py-2 px-4 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-6 py-8">