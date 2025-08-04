<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-6 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md mx-auto">
        <h1 class="text-3xl font-bold text-text-main mb-6 text-center font-display">ข้อมูลส่วนตัว</h1>
        
        <?php if (isset($user)): ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">ชื่อผู้ใช้</label>
                    <p class="mt-1 p-3 bg-gray-100 rounded-md w-full"><?= htmlspecialchars($user['username']); ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">อีเมล</label>
                    <p class="mt-1 p-3 bg-gray-100 rounded-md w-full"><?= htmlspecialchars($user['email']); ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">บทบาท</label>
                    <p class="mt-1 p-3 bg-gray-100 rounded-md w-full"><?= htmlspecialchars($user['role']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-red-500">ไม่สามารถโหลดข้อมูลผู้ใช้ได้</p>
        <?php endif; ?>

        <div class="mt-8 text-center">
             <a href="/app1/public/user/bookings" class="text-accent hover:underline">ดูประวัติการจอง</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>