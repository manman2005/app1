<?php
// views/bookings/index.php

require_once __DIR__ . '/../partials/header.php';
?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold my-4">My Bookings</h1>

    <?php if (!empty($bookings)): ?>
        <ul>
            <?php foreach ($bookings as $booking): ?>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2">Booking #<?php echo htmlspecialchars($booking['id']); ?></h2>
                    <p class="text-gray-600">Room Number: <?php echo htmlspecialchars($booking['room_number']); ?></p>
                    <p class="text-gray-600">Check-in Date: <?php echo htmlspecialchars($booking['check_in_date']); ?></p>
                    <p class="text-gray-600">Check-out Date: <?php echo htmlspecialchars($booking['check_out_date']); ?></p>
                    <p class="text-gray-600">Total Price: $<?php echo htmlspecialchars(number_format($booking['total_price'], 2)); ?></p>
                    <p class="text-gray-700 font-semibold mt-2">Status: <span class="capitalize <?php echo $booking['status'] === 'confirmed' ? 'text-green-600' : 'text-yellow-600'; ?>"><?php echo htmlspecialchars($booking['status']); ?></span></p>
                </div>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You have no bookings.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
