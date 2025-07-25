<?php include_once __DIR__ . '/../../views/partials/header.php'; ?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

    <!-- Display messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></span>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></span>
        </div>
    <?php endif; ?>

    <form action="/app1/public/auth/login_process" method="POST">
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
            <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Login</button>
    </form>
    <p class="text-center mt-4">
        Don't have an account? <a href="/app1/public/auth/register" class="text-blue-500 hover:underline">Register here</a>
    </p>
</div>

<?php include_once __DIR__ . '/../../views/partials/footer.php'; ?>