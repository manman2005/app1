<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-6 py-20">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-8 text-center">Admin Dashboard</h1>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Users</h3>
            <p class="text-4xl font-bold text-blue-600 dark:text-blue-400 mt-2">123</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Rooms</h3>
            <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">45</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">New Bookings</h3>
            <p class="text-4xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">7</p>
        </div>
    </div>

    <div class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">User Management</h2>
    <h2 class="text-2xl font-semibold mb-4">User Management</h2>
    <?php if (!empty($users)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-50 dark:bg-gray-900">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="py-2 px-4 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-white"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-right">
                                <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white text-sm py-1 px-3 rounded-md transition duration-300 mr-2">Edit</a>
                                <a href="#" class="bg-red-500 hover:bg-red-600 text-white text-sm py-1 px-3 rounded-md transition duration-300">Delete</a>
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

<?php include_once __DIR__ . '/../partials/footer.php'; ?>