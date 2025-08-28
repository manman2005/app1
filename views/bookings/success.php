<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="bg-cream-100 font-sans">
    <div class="container mx-auto px-4 py-12 md:py-16 text-center">
        <div class="max-w-2xl mx-auto bg-white p-8 md:p-12 rounded-2xl shadow-xl animate-fade-in-down">
            <svg class="h-20 w-20 mx-auto text-accent mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            
            <h1 class="text-3xl md:text-4xl font-bold text-text-main font-display mb-4">การจองของคุณสำเร็จ!</h1>
            
            <p class="text-gray-600 mb-8">
                ขอบคุณสำหรับการจองห้องพักกับเรา ขณะนี้การจองของคุณอยู่ในสถานะ <span class="font-semibold text-yellow-600">"รอดำเนินการ"</span><br>
                เราจะแจ้งให้คุณทราบเมื่อการจองได้รับการยืนยันเรียบร้อยแล้ว
            </p>

            <div class="bg-gray-50 rounded-lg p-6 text-left space-y-4 mb-8 border border-gray-200">
                <h3 class="text-lg font-semibold text-text-main border-b border-gray-200 pb-3 mb-4">รายละเอียดการจอง</h3>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">ห้อง:</span>
                    <span class="text-text-main font-medium"><?= htmlspecialchars($room->room_number) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">เช็คอิน:</span>
                    <span class="text-text-main font-medium"><?= htmlspecialchars(date("d F Y", strtotime($start_date))) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">เช็คเอาท์:</span>
                    <span class="text-text-main font-medium"><?= htmlspecialchars(date("d F Y", strtotime($end_date))) ?></span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                <a href="/app1/user/bookings" class="w-full bg-accent hover:bg-highlight text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                    ดูประวัติการจอง
                </a>
                <a href="/app1/" class="w-full bg-gray-200 hover:bg-gray-300 text-text-main font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                    กลับสู่หน้าหลัก
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>