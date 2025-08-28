<?php include __DIR__ . '/../partials/header.php'; ?>
<?php include __DIR__ . '/../partials/admin_navbar.php'; ?>

<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-text-main mb-8 text-center">แก้ไขข้อมูลห้องพัก</h1>

    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden p-8 max-w-3xl mx-auto">
        <form action="<?= BASE_PATH ?>/admin/editRoom" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($roomData->id); ?>">
        
        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="room_number">
                หมายเลขห้อง:
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="room_number" type="text" name="room_number" value="<?= htmlspecialchars($roomData->room_number); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="description">
                คำอธิบาย:
            </label>
            <textarea class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="description" name="description" rows="4"><?= htmlspecialchars($roomData->description); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="price_per_night">
                ราคาต่อคืน:
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="price_per_night" type="number" step="0.01" name="price_per_night" value="<?= htmlspecialchars($roomData->price_per_night); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="room_type">
                ประเภทห้อง:
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition" id="room_type" type="text" name="room_type" value="<?= htmlspecialchars($roomData->room_type); ?>" required>
        </div>

        <div class="mb-4">
            <label class="block text-text-main text-sm font-bold mb-2" for="image">
                รูปภาพห้องพัก (เลือกได้หลายรูป):
            </label>
            <input class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent-light file:text-accent hover:file:bg-accent" id="image" type="file" name="image[]" accept="image/*" multiple>
            <?php if (!empty($roomData->image_url)):
 ?>
                <p class="text-sm text-text-main mt-2">รูปภาพปัจจุบัน:</p>
                <div class="flex flex-wrap gap-2 mt-1">
                    <?php foreach ($roomData->image_url as $index => $img_url):
 ?>
                        <div class="relative w-24 h-24 group">
                            <img src="<?= htmlspecialchars($img_url); ?>" alt="Room Image" class="w-full h-full object-cover rounded-md border border-gray-300">
                            <button type="button" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-md" onclick="deleteImage('<?= htmlspecialchars($roomData->id); ?>', '<?= $index; ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-6">
            <label class="block text-text-main text-sm font-bold mb-2">
                สถานะห้องว่าง:
            </label>
            <input type="checkbox" id="is_available" name="is_available" value="1" <?= ($roomData->is_available == 1) ? 'checked' : ''; ?> class="h-4 w-4 text-accent focus:ring-accent border-gray-300 rounded">
            <label for="is_available" class="ml-2 text-text-main">ห้องพักพร้อมใช้งาน</label>
        </div>

        <div class="flex items-center justify-end mt-8">
            <a href="<?= BASE_PATH ?>/admin/dashboard" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 rounded-lg mr-4">
                ยกเลิก
            </a>
            <button class="bg-accent hover:bg-opacity-80 text-white font-bold py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg" type="submit">
                บันทึกการเปลี่ยนแปลง
            </button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
function deleteImage(roomId, imageIndex) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "คุณต้องการลบรูปภาพนี้ใช่หรือไม่?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('<?= BASE_PATH ?>/admin/deleteRoomImage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ room_id: roomId, image_index: imageIndex })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire(
                        'ลบแล้ว!',
                        'รูปภาพถูกลบเรียบร้อยแล้ว.',
                        'success'
                    ).then(() => {
                        location.reload(); // Reload the page to reflect changes
                    });
                } else {
                    Swal.fire(
                        'เกิดข้อผิดพลาด!',
                        'ไม่สามารถลบรูปภาพได้: ' + data.message,
                        'error'
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'เกิดข้อผิดพลาด!',
                    'เกิดข้อผิดพลาดขณะลบรูปภาพ.',
                    'error'
                );
            });
        }
    });
}
</script>