<?php include __DIR__ . '/../partials/header.php'; ?>


<div class="py-2 sm:py-4">
    <h1 class="text-2xl sm:text-4xl font-bold text-text-main mb-6 sm:mb-8 text-center">แก้ไขผู้ใช้</h1>

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

    <form action="<?= BASE_PATH ?>/admin/editUser" method="POST" class="bg-white shadow-2xl rounded-2xl px-4 sm:px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
        <input type="hidden" name="id" value="<?= htmlspecialchars($userData['id']); ?>">
        
        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="username">
                ชื่อผู้ใช้:
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="username" type="text" name="username" value="<?= htmlspecialchars($userData['username']); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="email">
                อีเมล:
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="email" type="email" name="email" value="<?= htmlspecialchars($userData['email']); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="password">
                รหัสผ่านใหม่ (เว้นว่างเพื่อใช้รหัสผ่านเดิม):
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="password" type="password" name="password">
        </div>

        <div class="mb-6">
            <label class="block text-text-main text-sm font-bold mb-2" for="role">
                บทบาท:
            </label>
            <select class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="role" name="role" required>
                <option value="user" <?= ($userData['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?= ($userData['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-3">
            <a href="<?= BASE_PATH ?>/admin/dashboard" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 rounded-lg text-center">
                ยกเลิก
            </a>
            <button class="bg-accent hover:bg-opacity-80 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg w-full sm:w-auto" type="submit">
                บันทึกการเปลี่ยนแปลง
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>