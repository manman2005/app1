<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/admin_navbar.php'; ?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-text-main mb-8 text-center">เพิ่มห้องพักใหม่</h1>

    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden p-8 max-w-3xl mx-auto">
        <form action="/app1/admin/addRoom" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-text-main text-sm font-bold mb-2" for="room_number">
                        หมายเลขห้อง:
                    </label>
                    <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="room_number" type="text" name="room_number" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-text-main text-sm font-bold mb-2" for="description">
                        คำอธิบาย:
                    </label>
                    <textarea class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="description" name="description" rows="4"></textarea>
                </div>

                <div>
                    <label class="block text-text-main text-sm font-bold mb-2" for="price_per_night">
                        ราคาต่อคืน:
                    </label>
                    <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="price_per_night" type="number" step="100" name="price_per_night" required>
                </div>

                <div>
                    <label class="block text-text-main text-sm font-bold mb-2" for="room_type">
                        ประเภทห้อง:
                    </label>
                    <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="room_type" type="text" name="room_type" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-text-main text-sm font-bold mb-2" for="image">
                        รูปภาพห้องพัก (เลือกได้หลายรูป):
                    </label>
                    <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-light file:text-accent hover:file:bg-accent" id="image" type="file" name="image[]" accept="image/*" multiple>
                </div>

                <div class="md:col-span-2 flex items-center">
                    <input type="checkbox" id="is_available" name="is_available" value="1" checked class="h-4 w-4 text-accent focus:ring-accent border-gray-300 rounded">
                    <label for="is_available" class="ml-2 block text-sm text-text-main">
                        ห้องพักพร้อมใช้งาน
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-8">
                <a href="/app1/admin/dashboard" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 rounded-lg mr-4">
                    ยกเลิก
                </a>
                <button class="bg-accent hover:bg-opacity-80 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg" type="submit">
                    บันทึกห้องพัก
                </button>
            </div>
        </form>
    </div>
</div>

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

<?php include __DIR__ . '/../partials/footer.php'; ?>