<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="/app1/public/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="/app1/public/" class="text-2xl font-bold text-blue-600 dark:text-white">HotelSys</a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/app1/public/" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition-colors duration-300">Home</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition-colors duration-300 focus:outline-none">
                                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-xl z-20" x-transition>
                                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="/app1/public/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-700">Admin Dashboard</a>
                                <?php endif; ?>
                                <a href="/app1/public/auth/logout" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-blue-500 hover:text-white dark:hover:bg-gray-700">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/app1/public/auth/login" class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-white transition-colors duration-300">Login</a>
                        <a href="/app1/public/auth/register" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300">Register</a>
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