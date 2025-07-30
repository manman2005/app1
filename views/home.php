<?php include_once __DIR__ . '/partials/header.php'; ?>

<!-- Hero Section with Image Slider -->
<section x-data="{ activeSlide: 1, totalSlides: 3 }" x-init="setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)" class="relative h-[600px] flex items-center justify-center text-white overflow-hidden">
    <!-- Background Images -->
    <div class="absolute inset-0 w-full h-full">
        <!-- Sea Image -->
        <div x-show.transition.opacity.duration.2000ms="activeSlide === 1" class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1473496169904-658ba7c44d8a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
        <!-- Mountain Image -->
        <div x-show.transition.opacity.duration.2000ms="activeSlide === 2" class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
        <!-- Hotel Lobby Image -->
        <div x-show.transition.opacity.duration.2000ms="activeSlide === 3" class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbb5eb?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>

    <!-- Text Content -->
    <div class="relative z-20 text-center px-4 animate-fade-in-down">
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4">สัมผัสประสบการณ์การพักผ่อนสุดพิเศษ</h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">ค้นพบความหรูหราและความสะดวกสบายที่ผสมผสานอย่างลงตัว ณ ใจกลางเมือง</p>
        <a href="#rooms" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">สำรวจห้องพัก</a>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms" class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white">ห้องพักและห้องสวีท</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">เลือกห้องพักที่เหมาะกับสไตล์การพักผ่อนของคุณ</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $room): ?>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl animate-fade-in-up">
                        <?php 
                            $display_image = '';
                            if (!empty($room['image_url']) && is_array($room['image_url'])) {
                                $display_image = htmlspecialchars($room['image_url'][0]);
                            } else {
                                // Placeholder image if no image is available
                                $display_image = 'https://via.placeholder.com/600x400?text=No+Image';
                            }
                        ?>
                        <img src="<?= $display_image; ?>" alt="<?= htmlspecialchars($room['room_number']); ?>" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mb-2"><?= htmlspecialchars($room['room_number']); ?></h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4"><?php echo htmlspecialchars($room['description']); ?></p>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                <span>Wi-Fi, TV, เครื่องปรับอากาศ</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">฿<?= number_format($room['price_per_night']); ?> <span class="text-sm font-normal text-gray-500 dark:text-gray-400">/ คืน</span></span>
                                <a href="/app1/public/book?room_id=<?= htmlspecialchars($room['id']); ?>" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-300">จองเลย</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-600 dark:text-gray-400">ไม่พบข้อมูลห้องพัก</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in-right">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?q=80&w=1949&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="About HotelSys" class="rounded-lg shadow-xl w-full">
            </div>
            <div class="animate-fade-in-left">
                <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">เรื่องราวของเรา</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">HotelSys ก่อตั้งขึ้นด้วยความมุ่งมั่นที่จะมอบประสบการณ์การพักผ่อนที่น่าจดจำ เราผสมผสานการออกแบบที่ทันสมัยเข้ากับการบริการที่เป็นเลิศเพื่อสร้างสรรค์ช่วงเวลาที่พิเศษสำหรับแขกทุกท่าน</p>
                <p class="text-gray-600 dark:text-gray-400">เราเชื่อว่าทุกการเดินทางคือโอกาสในการสร้างความทรงจำใหม่ๆ และเราพร้อมที่จะเป็นส่วนหนึ่งของการเดินทางของคุณ</p>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white">สิ่งอำนวยความสะดวกของเรา</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">เรามีบริการครบครันเพื่อตอบสนองทุกความต้องการของคุณ</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md transform transition duration-300 hover:scale-110">
                <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">สระว่ายน้ำ</h3>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md transform transition duration-300 hover:scale-110">
                <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">ฟิตเนส 24 ชม.</h3>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md transform transition duration-300 hover:scale-110">
                <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.29 1.29.904 3.43.028 4.305-1.164 1.164-3.337 1.164-4.501 0-1.164-1.164-1.164-3.337 0-4.501l5-5A2 2 0 0017 8.828V5l-1-1z"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">สปาและซาวน่า</h3>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md transform transition duration-300 hover:scale-110">
                <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v.01M12 12v.01M12 16v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">ห้องอาหาร</h3>
            </div>
        </div>
    </div>
</section>

<?php include_once __DIR__ . '/partials/footer.php'; ?>