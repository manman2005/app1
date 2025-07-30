<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-6 py-20">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8 text-center">Admin Dashboard</h1>

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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Users</h3>
            <p class="text-4xl font-bold text-blue-600 dark:text-blue-400 mt-2">123</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Rooms</h3>
            <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">45</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">New Bookings</h3>
            <p class="text-4xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">7</p>
        </div>
    </div>

    <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">User Management</h2>
            <a href="/app1/public/admin/addUser" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New User</a>
        </div>
    <?php if (!empty($users)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Username</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Role</th>
                        <th class="py-3 px-6"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-right">
                                <a href="/app1/public/admin/editUser?id=<?= htmlspecialchars($user['id']); ?>" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded-md transition duration-300 mr-2">Edit</a>
                                <form action="/app1/public/admin/deleteUser" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded-md transition duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<!-- Bookings Table -->
<div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Recent Bookings</h2>
    <?php if (!empty($bookings)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">User</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Room</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Check-in</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Check-out</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Total Price</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?= htmlspecialchars($booking['id']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?= htmlspecialchars($booking['username']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?= htmlspecialchars($booking['room_number']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?= htmlspecialchars(date('d M Y', strtotime($booking['check_in_date']))); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?= htmlspecialchars(date('d M Y', strtotime($booking['check_out_date']))); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white">฿<?= number_format($booking['total_price'], 2); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $booking['status'] == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?= htmlspecialchars($booking['status']); ?>
                                </span>
                            </td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?= htmlspecialchars(date('d M Y, H:i', strtotime($booking['created_at']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 dark:text-gray-400">No bookings found.</p>
    <?php endif; ?>
</div>

<div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md mt-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Room Management</h2>
        <a href="/app1/public/admin/addRoom" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New Room</a>
    </div>
    <?php 
        $room = new Room();
        $stmt_rooms = $room->getAllRooms();
        $rooms = $stmt_rooms->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php if (!empty($rooms)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Room Number</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Description</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Price/Night</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Available</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Room Type</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Image URL</th>
                        <th class="py-3 px-6"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $room): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['id']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['room_number']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['description']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['price_per_night']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['is_available'] ? 'Yes' : 'No'); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['room_type']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-gray-800 dark:text-white"><?php echo htmlspecialchars($room['image_url']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-right">
                                <a href="/app1/public/admin/editRoom?id=<?= htmlspecialchars($room['id']); ?>" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded-md transition duration-300 mr-2">Edit</a>
                                <form action="/app1/public/admin/deleteRoom" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($room['id']); ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded-md transition duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No rooms found.</p>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>