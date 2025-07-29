<?php
// views/bookings/create.php

require_once __DIR__ . '/../partials/header.php';
?>

<div class="container mx-auto">
    <h1 class="text-2xl font-bold my-4">Book a Room</h1>
    
    <?php if (isset($room)): ?>
        <h2 class="text-xl">Room <?php echo htmlspecialchars($room->room_number); ?></h2>
        <p><?php echo htmlspecialchars($room->description); ?></p>
        <p>Price: $<?php echo htmlspecialchars($room->price_per_night); ?> per night</p>

        <form action="/book" method="POST" class="mt-4">
            <input type="hidden" name="room_id" value="<?php echo $room->id; ?>">
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Book Now</button>
        </form>
    <?php else: ?>
        <p>Room not found.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
