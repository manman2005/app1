<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-text-main mb-8 text-center">เพิ่มผู้ใช้ใหม่</h1>

    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden p-8 max-w-lg mx-auto">
        <form action="/app1/public/admin/addUser" method="POST">
            <div class="mb-6">
                <label class="block text-text-main text-sm font-bold mb-2" for="username">
                    ชื่อผู้ใช้:
                </label>
                <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="username" type="text" name="username" required>
            </div>

            <div class="mb-6">
                <label class="block text-text-main text-sm font-bold mb-2" for="email">
                    อีเมล:
                </label>
                <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="email" type="email" name="email" required>
            </div>

            <div class="mb-6">
                <label class="block text-text-main text-sm font-bold mb-2" for="password">
                    รหัสผ่าน:
                </label>
                <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="password" type="password" name="password" required>
            </div>

            <div class="mb-6">
                <label class="block text-text-main text-sm font-bold mb-2" for="role">
                    บทบาท:
                </label>
                <select class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-8">
                 <a href="/app1/public/admin/dashboard" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 rounded-lg mr-4">
                    ยกเลิก
                </a>
                <button class="bg-accent hover:bg-opacity-80 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg" type="submit">
                    เพิ่มผู้ใช้
                </button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_SESSION['message']) || isset($_SESSION['error'])): ?>
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

<?php include __DIR__ . '/../partials/footer.php'; ?>