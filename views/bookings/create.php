<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden">
        <div class="md:flex">
            <!-- Room Image -->
            <div class="md:w-1/2">
                <?php if (isset($room) && !empty($room->image_url)) : ?>
                    <img src="<?= htmlspecialchars($room->image_url); ?>" alt="Room <?= htmlspecialchars($room->room_number); ?>" class="w-full h-full object-cover">
                <?php else : ?>
                    <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Booking Form -->
            <div class="p-8 md:p-12 md:w-1/2">
                <?php if (isset($room)) : ?>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Book Your Stay</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">You are booking Room <?= htmlspecialchars($room->room_number); ?></p>

                    <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <p class="text-lg text-gray-700 dark:text-gray-300"><?= htmlspecialchars($room->description); ?></p>
                        <div class="mt-4">
                            <span class="text-3xl font-bold text-blue-600 dark:text-blue-400">฿<?= number_format($room->price_per_night); ?></span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">/ night</span>
                        </div>
                    </div>

                    <form action="/app1/public/book" method="POST">
                        <input type="hidden" name="room_id" value="<?= $room->id; ?>">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Check-in Date</label>
                                <input type="date" id="start_date" name="start_date" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Check-out Date</label>
                                <input type="date" id="end_date" name="end_date" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                        </div>

                        <!-- Total Price Display -->
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-800 dark:text-white">Total Price:</span>
                                <span id="total-price" data-price-per-night="<?= htmlspecialchars($room->price_per_night); ?>" class="text-2xl font-bold text-blue-600 dark:text-blue-400">Select dates</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                            Confirm Booking
                        </button>
                    </form>
                <?php else : ?>
                    <div class="text-center py-20">
                        <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Room Not Found</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">We couldn't find the room you were looking for.</p>
                        <a href="/app1/public/home" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Back to Home</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const totalPriceElement = document.getElementById('total-price');
    const pricePerNight = parseFloat(totalPriceElement.dataset.pricePerNight);

    function calculateTotal() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDateInput.value && endDateInput.value && endDate > startDate) {
            const timeDiff = endDate.getTime() - startDate.getTime();
            const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            if (dayDiff > 0) {
                const total = dayDiff * pricePerNight;
                totalPriceElement.textContent = `฿${total.toLocaleString('en-US')}`;
            } else {
                totalPriceElement.textContent = 'Invalid date range';
            }
        } else {
            totalPriceElement.textContent = 'Select dates';
        }
    }

    startDateInput.addEventListener('change', calculateTotal);
    endDateInput.addEventListener('change', calculateTotal);
});
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
