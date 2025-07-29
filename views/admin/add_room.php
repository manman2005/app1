<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-6 py-20">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8 text-center">Add New Room</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= $_SESSION['message']; ?></span>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?= $_SESSION['error']; ?></span>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 mb-8">
    <form action="/app1/public/admin/addRoom" method="POST" enctype="multipart/form-data" class="">
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="room_number">
                Room Number:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600" id="room_number" type="text" name="room_number" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="description">
                Description:
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600" id="description" name="description" rows="4"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="price_per_night">
                Price Per Night:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600" id="price_per_night" type="number" step="0.01" name="price_per_night" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="room_type">
                Room Type:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600" id="room_type" type="text" name="room_type" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="image">
                Room Image:
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600" id="image" type="file" name="image" accept="image/*">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">
                Availability:
            </label>
            <input type="checkbox" id="is_available" name="is_available" value="1" checked>
            <label for="is_available" class="ml-2 text-gray-700 dark:text-gray-200">Available</label>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-300" type="submit">
                Save Room
            </button>
            <a href="/app1/public/admin/dashboard" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessageDiv = document.querySelector('.bg-green-100.border-green-400');
        if (successMessageDiv) {
            const message = successMessageDiv.querySelector('span').innerText;
            alert(message);
        }
    });
</script>

<?php include __DIR__ . '/../partials/footer.php'; ?>