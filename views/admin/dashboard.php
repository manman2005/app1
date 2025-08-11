<?php include_once __DIR__ . '/../partials/header.php'; ?>
<?php include_once __DIR__ . '/../partials/admin_navbar.php'; ?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-text-main mb-8 text-center">Admin Dashboard</h1>

    <?php if (isset($_SESSION['message']) || isset($_SESSION['error'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: '<?= addslashes(htmlspecialchars($_SESSION['message'])); ?>',
            confirmButtonText: 'ตกลง'
        });
        <?php unset($_SESSION['message']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: '<?= addslashes(htmlspecialchars($_SESSION['error'])); ?>',
            confirmButtonText: 'ตกลง'
        });
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
    </script>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
            <h3 class="text-lg font-semibold text-text-main">Total Users</h3>
            <p class="text-4xl font-bold text-accent mt-2"><?= $user_total_rows; ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
            <h3 class="text-lg font-semibold text-text-main">Total Rooms</h3>
            <p class="text-4xl font-bold text-accent mt-2"><?= $room_total_rows; ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-center">
            <h3 class="text-lg font-semibold text-text-main">New Bookings</h3>
            <p class="text-4xl font-bold text-accent mt-2"><?= $booking_total_rows; ?></p>
        </div>
    </div>

    <div class="mb-8">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button type="button" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-accent text-accent-dark" data-tab="user-management-tab">User Management</button>
                <button type="button" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="booking-management-tab">Recent Bookings</button>
                <button type="button" class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="room-management-tab">Room Management</button>
            </nav>
        </div>

        <div id="user-management-tab" class="tab-content mt-4">
            <div id="user-management" class="bg-accent-light p-6 rounded-lg shadow-md mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-text-main">User Management</h2>
                    <a href="/app1/public/admin/addUser" class="bg-accent hover:bg-opacity-80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New User</a>
                </div>

                <form method="GET" action="/app1/public/admin/dashboard" class="mb-4">
                    <input type="hidden" name="tab" value="user-management-tab">
                    <div class="flex space-x-4">
                        <input type="text" name="user_search" placeholder="Search users..." class="flex-grow p-2 border border-gray-300 rounded-md" value="<?= htmlspecialchars($user_search_term); ?>">
                        <select name="user_role" class="p-2 border border-gray-300 rounded-md">
                            <option value="">All Roles</option>
                            <option value="user" <?= $user_role_filter == 'user' ? 'selected' : ''; ?>>User</option>
                            <option value="admin" <?= $user_role_filter == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="black"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></button>
                    </div>
                </form>

            <?php if (!empty($users)):
            ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">ID</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Username</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Email</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Phone Number</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Role</th>
                                <th class="py-3 px-6"></th>
                            </tr>
                        </thead>
                <tbody>
                    <?php foreach ($users as $user):
                    ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($user['phone_number'] ?? 'N/A'); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($user['role']); ?></td>
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
                <div class="mt-4 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <?php if ($user_current_page > 1):
                        ?>
                            <a href="?tab=user-management-tab&user_page=<?= $user_current_page - 1; ?>&user_search=<?= htmlspecialchars($user_search_term); ?>&user_role=<?= htmlspecialchars($user_role_filter); ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <!-- Heroicon name: solid/chevron-left -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $user_total_pages; $i++):
                        ?>
                            <a href="?tab=user-management-tab&user_page=<?= $i; ?>&user_search=<?= htmlspecialchars($user_search_term); ?>&user_role=<?= htmlspecialchars($user_role_filter); ?>" class="<?= $i == $user_current_page ? 'z-10 bg-accent-light border-accent text-accent-dark' : 'bg-white border-gray-300 text-gray-700'; ?> relative inline-flex items-center px-4 py-2 border text-sm font-medium hover:bg-gray-50">
                                <?= $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($user_current_page < $user_total_pages):
                        ?>
                            <a href="?tab=user-management-tab&user_page=<?= $user_current_page + 1; ?>&user_search=<?= htmlspecialchars($user_search_term); ?>&user_role=<?= htmlspecialchars($user_role_filter); ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </nav>
                </div>
            <?php else:
            ?>
                <p>No users found.</p>
            <?php endif; ?>
            </div>
        </div>

        <div id="booking-management-tab" class="tab-content mt-4 hidden">
            <!-- Bookings Table -->
            <div id="booking-management" class="bg-accent-light p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-2xl font-semibold text-text-main mb-4">Recent Bookings</h2>

                <form method="GET" action="/app1/public/admin/dashboard" class="mb-4">
                    <input type="hidden" name="tab" value="booking-management-tab">
                    <div class="flex space-x-4">
                        <input type="text" name="booking_search" placeholder="Search bookings..." class="flex-grow p-2 border border-gray-300 rounded-md" value="<?= htmlspecialchars($booking_search_term); ?>">
                        <select name="booking_status" class="p-2 border border-gray-300 rounded-md">
                            <option value="">All Statuses</option>
                            <option value="confirmed" <?= $booking_status_filter == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                            <option value="pending" <?= $booking_status_filter == 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="cancelled" <?= $booking_status_filter == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="black"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></button>
                    </div>
                </form>

            <?php if (!empty($bookings)):
                $thai_months = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
            ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">ID</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">User</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Room</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Check-in</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Check-out</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Total Price</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Date</th>
                                <th class="py-3 px-6"></th>
                            </tr>
                        </thead>
                <tbody>
                    <?php foreach ($bookings as $booking):
                    ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?= htmlspecialchars($booking['id']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?= htmlspecialchars($booking['username']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?= htmlspecialchars($booking['room_number']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?= date('d', strtotime($booking['check_in_date'])) . ' ' . $thai_months[date('m', strtotime($booking['check_in_date'])) - 1] . ' ' . (date('Y', strtotime($booking['check_in_date'])) + 543); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?= date('d', strtotime($booking['check_out_date'])) . ' ' . $thai_months[date('m', strtotime($booking['check_out_date'])) - 1] . ' ' . (date('Y', strtotime($booking['check_out_date'])) + 543); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main">฿<?= number_format($booking['total_price'], 2); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $booking['status'] == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?= htmlspecialchars($booking['status']); ?>
                                </span>
                            </td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?= date('d', strtotime($booking['created_at'])) . ' ' . $thai_months[date('m', strtotime($booking['created_at'])) - 1] . ' ' . (date('Y', strtotime($booking['created_at'])) + 543) . ', ' . date('H:i', strtotime($booking['created_at'])); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-right">
                                    <?php if ($booking['status'] == 'pending'): ?>
                                        <form action="/app1/public/admin/approveBooking" method="POST" class="inline-block mr-2">
                                            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']); ?>">
                                            <button type="submit" class="bg-accent hover:bg-opacity-80 text-white text-sm py-1 px-3 rounded-md transition duration-300">อนุมัติ</button>
                                        </form>
                                        <form action="/app1/public/admin/rejectBooking" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to reject this booking?');">
                                            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']); ?>">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded-md transition duration-300">ปฏิเสธ</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
                <div class="mt-4 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <?php if ($booking_current_page > 1):
                        ?>
                            <a href="?tab=booking-management-tab&booking_page=<?= $booking_current_page - 1; ?>&booking_search=<?= htmlspecialchars($booking_search_term); ?>&booking_status=<?= htmlspecialchars($booking_status_filter); ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <!-- Heroicon name: solid/chevron-left -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $booking_total_pages; $i++):
                        ?>
                            <a href="?tab=booking-management-tab&booking_page=<?= $i; ?>&booking_search=<?= htmlspecialchars($booking_search_term); ?>&booking_status=<?= htmlspecialchars($booking_status_filter); ?>" class="<?= $i == $booking_current_page ? 'z-10 bg-accent-light border-accent text-accent-dark' : 'bg-white border-gray-300 text-gray-700'; ?> relative inline-flex items-center px-4 py-2 border text-sm font-medium hover:bg-gray-50">
                                <?= $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($booking_current_page < $booking_total_pages):
                        ?>
                            <a href="?tab=booking-management-tab&booking_page=<?= $booking_current_page + 1; ?>&booking_search=<?= htmlspecialchars($booking_search_term); ?>&booking_status=<?= htmlspecialchars($booking_status_filter); ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </nav>
                </div>
            <?php else:
            ?>
                <p class="text-center text-text-main">No bookings found.</p>
            <?php endif; ?>
            </div>
        </div>

        <div id="room-management-tab" class="tab-content mt-4 hidden">
            <div id="room-management" class="bg-accent-light p-6 rounded-lg shadow-md mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-text-main">Room Management</h2>
                    <a href="/app1/public/admin/addRoom" class="bg-accent hover:bg-opacity-80 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New Room</a>
                </div>

                <form method="GET" action="/app1/public/admin/dashboard" class="mb-4">
                    <input type="hidden" name="tab" value="room-management-tab">
                    <div class="flex space-x-4">
                        <input type="text" name="room_search" placeholder="Search rooms..." class="flex-grow p-2 border border-gray-300 rounded-md" value="<?= htmlspecialchars($room_search_term); ?>">
                        <select name="room_type" class="p-2 border border-gray-300 rounded-md">
                            <option value="">All Types</option>
                            <option value="Standard" <?= $room_type_filter == 'Standard' ? 'selected' : ''; ?>>Standard</option>
                            <option value="Deluxe" <?= $room_type_filter == 'Deluxe' ? 'selected' : ''; ?>>Deluxe</option>
                            <option value="Suite" <?= $room_type_filter == 'Suite' ? 'selected' : ''; ?>>Suite</option>
                        </select>
                        <select name="room_availability" class="p-2 border border-gray-300 rounded-md">
                            <option value="">All Statuses</option>
                            <option value="1" <?= $room_availability_filter == '1' ? 'selected' : ''; ?>>Available</option>
                            <option value="0" <?= $room_availability_filter == '0' ? 'selected' : ''; ?>>Not Available</option>
                        </select>
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="black"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></button>
                    </div>
                </form>

            <?php if (!empty($rooms)):
            ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">ID</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Room Number</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Description</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Price/Night</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Available</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Room Type</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-text-main uppercase tracking-wider">Image URL</th>
                                <th class="py-3 px-6"></th>
                            </tr>
                        </thead>
                <tbody>
                    <?php foreach ($rooms as $room):
                    ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($room['id']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($room['room_number']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($room['description']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($room['price_per_night']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($room['is_available'] ? 'Yes' : 'No'); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main"><?php echo htmlspecialchars($room['room_type']); ?></td>
                            <td class="py-3 px-6 whitespace-nowrap text-text-main">
                                <?php 
                                    if (!empty($room['image_url']) && is_array($room['image_url'])) {
                                        echo '<img src="' . htmlspecialchars($room['image_url'][0]) . '" alt="Room Image" class="w-16 h-16 object-cover rounded-md">';
                                    } else {
                                        echo 'No Image';
                                    }
                                ?>
                            </td>
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
                <div class="mt-4 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <?php if ($room_current_page > 1):
                        ?>
                            <a href="?tab=room-management-tab&room_page=<?= $room_current_page - 1; ?>&room_search=<?= htmlspecialchars($room_search_term); ?>&room_type=<?= htmlspecialchars($room_type_filter); ?>&room_availability=<?= htmlspecialchars($room_availability_filter); ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <!-- Heroicon name: solid/chevron-left -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $room_total_pages; $i++):
                        ?>
                            <a href="?tab=room-management-tab&room_page=<?= $i; ?>&room_search=<?= htmlspecialchars($room_search_term); ?>&room_type=<?= htmlspecialchars($room_type_filter); ?>&room_availability=<?= htmlspecialchars($room_availability_filter); ?>" class="<?= $i == $room_current_page ? 'z-10 bg-accent-light border-accent text-accent-dark' : 'bg-white border-gray-300 text-gray-700'; ?> relative inline-flex items-center px-4 py-2 border text-sm font-medium hover:bg-gray-50">
                                <?= $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($room_current_page < $room_total_pages):
                        ?>
                            <a href="?tab=room-management-tab&room_page=<?= $room_current_page + 1; ?>&room_search=<?= htmlspecialchars($room_search_term); ?>&room_type=<?= htmlspecialchars($room_type_filter); ?>&room_availability=<?= htmlspecialchars($room_availability_filter); ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <!-- Heroicon name: solid/chevron-right -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </nav>
                </div>
            <?php else:
            ?>
                <p>No rooms found.</p>
            <?php endif; ?>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            function showTab(tabId) {
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                tabButtons.forEach(button => {
                    button.classList.remove('border-accent', 'text-accent-dark');
                    button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                });

                document.getElementById(tabId).classList.remove('hidden');
                document.querySelector(`[data-tab="${tabId}"]`).classList.add('border-accent', 'text-accent-dark');
                document.querySelector(`[data-tab="${tabId}"]`).classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            }

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    showTab(this.dataset.tab);
                });
            });

            // Show the correct tab based on URL parameter or default to user-management-tab
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab') || 'user-management-tab';
            showTab(activeTab);
        });
    </script>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>