<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="bg-gray-100">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center font-display">จัดการโปรไฟล์</h1>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                <p class="font-bold">สำเร็จ!</p>
                <p><?= $_SESSION['success_message']; ?></p>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                <p class="font-bold">เกิดข้อผิดพลาด!</p>
                <p><?= $_SESSION['error_message']; ?></p>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <?php 
                        $profile_pic_url = !empty($user['profile_picture']) 
                            ? htmlspecialchars($user['profile_picture']) 
                            : 'https://i.pravatar.cc/150?u=' . htmlspecialchars($user['id']);
                    ?>
                    <img class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-accent-light shadow-md object-cover" src="<?= $profile_pic_url; ?>" alt="Profile Picture">
                    <h2 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($user['username']); ?></h2>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($user['email']); ?></p>
                    <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($user['phone_number'] ?? 'ยังไม่ได้เพิ่มเบอร์โทร'); ?></p>
                    <span class="inline-block bg-accent text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider"><?= htmlspecialchars($user['role']); ?></span>
                    
                    <div class="mt-6 text-left text-sm text-gray-600">
                        <?php
                            $thai_months = [
                                1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน",
                                5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม",
                                9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"
                            ];
                            $created_at_ts = strtotime($user['created_at']);
                            $member_since_formatted = date('j', $created_at_ts) . ' ' . $thai_months[date('n', $created_at_ts)] . ' ' . (date('Y', $created_at_ts) + 543);
                        ?>
                        <p><strong class="font-medium">เป็นสมาชิกตั้งแต่:</strong> <?= $member_since_formatted; ?></p>
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                        <form action="/app1/public/user/profile/upload_picture" method="POST" enctype="multipart/form-data" class="space-y-3">
                            <div>
                                <label for="profile_picture_upload" class="block text-sm font-medium text-gray-700 mb-2">เปลี่ยนรูปโปรไฟล์ใหม่</label>
                                <input type="file" name="profile_picture" id="profile_picture_upload" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-light file:text-accent-dark hover:file:bg-accent-dark hover:file:text-white transition duration-300">
                            </div>
                            <button type="submit" class="w-full bg-accent hover:bg-highlight text-white font-bold py-2 px-4 rounded-lg transition duration-300">อัปโหลดรูปภาพ</button>
                        </form>
                        <button class="w-full bg-red-100 hover:bg-red-200 text-red-700 font-bold py-2 px-4 rounded-lg transition duration-300">ลบบัญชีผู้ใช้</button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Edit Profile Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">แก้ไขข้อมูลส่วนตัว</h3>
                    <form action="/app1/public/user/profile/update" method="POST" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">ชื่อผู้ใช้</label>
                            <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']); ?>" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-accent focus:border-accent sm:text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-accent focus:border-accent sm:text-sm">
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
                            <input type="text" name="phone_number" id="phone_number" value="<?= htmlspecialchars($user['phone_number'] ?? ''); ?>" placeholder="กรอกเบอร์โทรศัพท์ของคุณ" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-accent focus:border-accent sm:text-sm">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-lg text-sm font-bold rounded-lg text-white bg-accent hover:bg-highlight focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-dark transition duration-300 transform hover:scale-105">
                                บันทึกการเปลี่ยนแปลง
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">เปลี่ยนรหัสผ่าน</h3>
                    <form action="/app1/public/user/profile/change_password" method="POST" class="space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">รหัสผ่านปัจจุบัน</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-accent focus:border-accent sm:text-sm">
                        </div>
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700">รหัสผ่านใหม่</label>
                            <input type="password" name="new_password" id="new_password" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-accent focus:border-accent sm:text-sm">
                        </div>
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700">ยืนยันรหัสผ่านใหม่</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-accent focus:border-accent sm:text-sm">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-lg text-sm font-bold rounded-lg text-white bg-accent hover:bg-highlight focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-dark transition duration-300 transform hover:scale-105">
                                เปลี่ยนรหัสผ่าน
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>