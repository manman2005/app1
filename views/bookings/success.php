<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-4 py-16 text-center">
    <div class="bg-white dark:bg-gray-800 max-w-lg mx-auto p-8 md:p-12 rounded-2xl shadow-2xl animate-fade-in-down">
        <svg class="h-20 w-20 mx-auto text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">Booking Submitted!</h1>
        
        <p class="text-gray-600 dark:text-gray-400 mb-8">
            Thank you for your booking. Your reservation is pending approval.
        </p>

        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 text-left space-y-4 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b border-gray-200 dark:border-gray-600 pb-2">Reservation Details</h3>
            <div>
                <span class="font-semibold text-gray-700 dark:text-gray-300">Room:</span>
                <span class="float-right text-gray-900 dark:text-white"><?= htmlspecialchars($room->room_number) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700 dark:text-gray-300">Check-in:</span>
                <span class="float-right text-gray-900 dark:text-white"><?= htmlspecialchars(date("F j, Y", strtotime($start_date))) ?></span>
            </div>
            <div>
                <span class="font-semibold text-gray-700 dark:text-gray-300">Check-out:</span>
                <span class="float-right text-gray-900 dark:text-white"><?= htmlspecialchars(date("F j, Y", strtotime($end_date))) ?></span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/app1/public/my-bookings" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                View My Bookings
            </a>
            <a href="/app1/public/home" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                Back to Home
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>