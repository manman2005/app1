<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="/app1/public/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-primary text-text-main">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="/app1/public/" class="text-2xl font-bold text-text-main"> Srinaman Camping&Resort <br> ศรีนาม่าน แคมป์ปิ้งแอนด์รีสอร์ท</a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/app1/public/" class="px-4 py-2 text-text-main hover:text-accent transition-colors duration-300">Home</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 px-4 py-2 text-text-main hover:text-accent transition-colors duration-300 focus:outline-none">
                                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-20" x-transition>
                                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                    <a href="/app1/public/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent hover:text-white">Admin Dashboard</a>
                                <?php endif; ?>
                                <a href="/app1/public/auth/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent hover:text-white">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/app1/public/auth/login" class="px-4 py-2 text-text-main hover:text-accent transition-colors duration-300">Login</a>
                        <a href="/app1/public/auth/register" class="px-4 py-2 bg-accent text-white rounded-md hover:bg-opacity-80 transition-colors duration-300">Register</a>
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