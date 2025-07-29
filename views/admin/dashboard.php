<?php include_once __DIR__ . '/../partials/header.php'; ?>

<h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">User Management</h2>
    <?php if (!empty($users)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
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
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($user['id']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="py-2 px-4 border-b border-gray-200 text-right">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
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