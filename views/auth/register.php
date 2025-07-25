<?php include_once __DIR__ . '/../../views/partials/header.php'; ?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
    
    <!-- Display errors if any -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></span>
        </div>
    <?php endif; ?>

    <form action="/app1/public/auth/register_process" method="POST">
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
            <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Register</button>
    </form>
    <p class="text-center mt-4">
        Already have an account? <a href="/app1/public/auth/login" class="text-blue-500 hover:underline">Login here</a>
    </p>
</div>

<?php include_once __DIR__ . '/../../views/partials/footer.php'; ?>