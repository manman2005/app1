<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="/app1/public/css/style.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/app1/public/" class="text-xl font-bold text-gray-800">HotelSys</a>
            <div>
                <a href="/app1/public/" class="px-4">Home</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <a href="/app1/public/admin/dashboard" class="px-4">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="/app1/public/auth/logout" class="px-4">Logout</a>
                <?php else: ?>
                    <a href="/app1/public/auth/login" class="px-4">Login</a>
                    <a href="/app1/public/auth/register" class="px-4 bg-blue-500 text-white rounded py-2">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-6 py-8">