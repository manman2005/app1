<?php require_once __DIR__ . '/../partials/header.php'; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'error',
        title: 'การจองไม่สำเร็จ',
        text: 'ห้องพักไม่ว่างสำหรับวันที่คุณเลือก',
        confirmButtonColor: '#F44336',
        confirmButtonText: 'ตกลง'
    });
});
</script>
<?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<div class="container mx-auto px-4 py-12">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
        <div class="md:flex">
            <!-- Room Image Gallery -->
            <div class="md:w-1/2 p-4">
                <?php 
                    $images = [];
                    if (isset($room) && !empty($room->image_url) && is_array($room->image_url)) {
                        $images = $room->image_url;
                    } else {
                        // Placeholder image if no image is available
                        $images[] = 'https://via.placeholder.com/600x400?text=No+Image';
                    }
                    $main_image = htmlspecialchars($images[0]);
                ?>
                <div class="mb-4">
                    <img id="main-room-image" src="<?= $main_image; ?>" alt="Room <?= htmlspecialchars($room->room_number); ?>" class="w-full h-96 object-cover rounded-lg shadow-md">
                </div>
                <div class="flex space-x-2 overflow-x-auto pb-2">
                    <?php foreach ($images as $index => $image_url): ?>
                        <img 
                            src="<?= htmlspecialchars($image_url); ?>" 
                            alt="Room Thumbnail <?= $index + 1; ?>" 
                            class="w-24 h-24 object-cover rounded-md cursor-pointer border-2 border-transparent hover:border-accent transition-all duration-200"
                            onclick="changeMainImage(this)"
                        >
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="p-8 md:p-12 md:w-1/2">
                <?php if (isset($room)) : ?>
                    <h1 class="text-3xl md:text-4xl font-bold text-text-main mb-2">จองห้องพักของคุณ</h1>
                    <p class="text-text-main mb-6">คุณกำลังจะจองห้อง <?= htmlspecialchars($room->room_number); ?></p>

                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <p class="text-lg text-text-main"><?= htmlspecialchars($room->description); ?></p>
                        <div class="mt-4">
                            <span class="text-3xl font-bold text-accent">฿<?= number_format($room->price_per_night); ?></span>
                            <span class="text-sm text-text-main">/ คืน</span>
                        </div>
                    </div>

                    <form action="/app1/public/book" method="POST">
                        <input type="hidden" name="room_id" value="<?= $room->id; ?>">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-text-main mb-2">วันที่เช็คอิน</label>
                                <input type="date" id="start_date" name="start_date" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-text-main mb-2">วันที่เช็คเอาท์</label>
                                <input type="date" id="end_date" name="end_date" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-text-main focus:ring-accent focus:border-accent transition">
                            </div>
                        </div>

                        <!-- Total Price Display -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-text-main">ราคารวม:</span>
                                <span id="total-price" data-price-per-night="<?= htmlspecialchars($room->price_per_night); ?>" class="text-2xl font-bold text-accent">เลือกวันที่</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full mt-8 bg-accent hover:bg-opacity-80 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                            ยืนยันการจอง
                        </button>
                    </form>
                <?php else : ?>
                    <div class="text-center py-20">
                        <h2 class="text-2xl font-semibold text-text-main">ไม่พบห้องพัก</h2>
                        <p class="text-text-main mt-2">เราไม่พบห้องพักที่คุณกำลังมองหา</p>
                        <a href="/app1/public/home" class="mt-6 inline-block bg-accent text-white px-6 py-2 rounded-lg hover:bg-opacity-80 transition">กลับสู่หน้าหลัก</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const totalPriceElement = document.getElementById('total-price');
    const pricePerNight = parseFloat(totalPriceElement.dataset.pricePerNight);
    const bookingForm = document.querySelector('form');

    bookingForm.addEventListener('submit', function(e) {
        if (!startDateInput.value || !endDateInput.value) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'ข้อมูลไม่ครบถ้วน',
                text: 'กรุณาเลือกวันที่เช็คอินและเช็คเอาท์ก่อนดำเนินการต่อ',
                confirmButtonColor: '#4F46E5',
                confirmButtonText: 'รับทราบ'
            });
        }
    });

    function calculateTotal() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDateInput.value && endDateInput.value && endDate > startDate) {
            const timeDiff = endDate.getTime() - startDate.getTime();
            const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            if (dayDiff > 0) {
                const total = dayDiff * pricePerNight;
                totalPriceElement.textContent = `฿${total.toLocaleString('en-US')}`;
            } else {
                totalPriceElement.textContent = 'ช่วงวันที่ไม่ถูกต้อง';
            }
        } else {
            totalPriceElement.textContent = 'เลือกวันที่';
        }
    }

    startDateInput.addEventListener('change', calculateTotal);
    endDateInput.addEventListener('change', calculateTotal);

    window.changeMainImage = function(element) {
        document.getElementById('main-room-image').src = element.src;
    };
});
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
