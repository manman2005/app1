<?php
// views/bookings/index.php

require_once __DIR__ . '/../partials/header.php';
?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold my-4">My Bookings</h1>

    <?php if (!empty($bookings)): ?>
        <ul>
            <?php foreach ($bookings as $booking): ?>
                <li class="mb-2 p-2 border rounded">
                    <p><strong>Room ID:</strong> <?php echo htmlspecialchars($booking->room_id); ?></p>
                    <p><strong>Start Date:</strong> <?php echo htmlspecialchars($booking->start_date); ?></p>
                    <p><strong>End Date:</strong> <?php echo htmlspecialchars($booking->end_date); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($booking->status); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>You have no bookings.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
