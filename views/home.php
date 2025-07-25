<?php include_once __DIR__ . '/partials/header.php'; ?>

<div class="text-center">
    <h1 class="text-4xl font-bold mb-4">Welcome to HotelSys</h1>
    <p class="text-lg text-gray-600">Your one-stop solution for booking the best rooms.</p>
    
    <?php if (isset($_SESSION['username'])): ?>
        <p class="mt-4 text-xl">Hello, <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</p>
    <?php endif; ?>

    <div class="mt-8">
        <a href="#" class="bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">Browse Rooms</a>
    </div>
</div>

<?php include_once __DIR__ . '/partials/footer.php'; ?>