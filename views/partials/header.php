<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="/app1/public/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100">
    <nav class="bg-gray-800 shadow-md">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/app1/public/" class="text-xl font-bold text-white">HotelSys</a>
            <div>
                <a href="/app1/public/" class="px-4 text-gray-300 hover:text-white">Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <a href="/app1/public/admin/dashboard" class="px-4 text-gray-300 hover:text-white">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="/app1/public/auth/logout" class="px-4 text-gray-300 hover:text-white">Logout</a>
                <?php else: ?>
                    <a href="/app1/public/auth/login" class="px-4 text-gray-300 hover:text-white">Login</a>
                    <a href="/app1/public/auth/register" class="px-4 bg-blue-600 text-white rounded py-2 hover:bg-blue-700">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-6 py-8">