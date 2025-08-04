<?php include_once __DIR__ . '/partials/header.php'; ?>

<!-- Hero Section with Image Slider -->
<section x-data="{ activeSlide: 1, totalSlides: 3 }" x-init="setInterval(() => { activeSlide = (activeSlide % totalSlides) + 1 }, 5000)" class="relative h-[600px] flex items-center justify-center text-white overflow-hidden">
    <!-- Background Images -->
    <div class="absolute inset-0 w-full h-full">
        <!-- Sea Image -->
        <div x-show.transition.opacity.duration.2000ms="activeSlide === 1" class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('/app1/public/img/man.jpg');"></div>
        <!-- Mountain Image -->
        <div x-show.transition.opacity.duration.2000ms="activeSlide === 2" class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('/app1/public/img/man1.jpg');"></div>
        <!-- Hotel Lobby Image -->
        <div x-show.transition.opacity.duration.2000ms="activeSlide === 3" class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('/app1/public/img/man2.jpg');"></div>
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>

    <!-- Text Content -->
    <div class="relative z-20 text-center px-4 animate-fade-in-down">
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4">สัมผัสประสบการณ์การพักผ่อนสุดพิเศษ</h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">สัมผัสความสงบ ท่ามกลางขุนเขาและสายหมอก ปล่อยใจให้ธรรมชาติบำบัดทุกความเหนื่อยล้า</p>
        <a href="#rooms" class="bg-accent hover:brightness-95 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">สำรวจห้องพัก</a>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms" class="py-20 bg-accent-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-accent">ห้องพักและห้องสวีท</h2>
            <p class="text-text-main mt-2">เลือกห้องพักที่เหมาะกับสไตล์การพักผ่อนของคุณ</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php if (!empty($rooms)) { ?>
                <?php foreach ($rooms as $room) { ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl animate-fade-in-up card">
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
                            <h3 class="text-2xl font-semibold text-text-main mb-2"><?= htmlspecialchars($room['room_number']); ?></h3>
                            <p class="text-text-main mb-4"><?php echo htmlspecialchars($room['description']); ?></p>
                            <div class="flex items-center text-sm text-text-main mb-4">
                                <svg class="h-5 w-5 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                <span>
                                    <?= htmlspecialchars($room['room_type']); ?>
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-accent">฿<?= number_format($room['price_per_night']); ?> <span class="text-sm font-normal text-text-main">/ คืน</span></span>
                                <a href="/app1/public/book?room_id=<?= htmlspecialchars($room['id']); ?>" class="btn bg-accent text-white px-5 py-2 rounded-lg transition duration-300">จองเลย</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="text-center text-dark-brown">ไม่พบข้อมูลห้องพัก</p>
            <?php } ?>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section class="py-20 bg-primary">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in-right">
                <img src="/app1/public/img/486826403_683375754211544_5369952372350186305_n.jpg" alt="About HotelSys" class="rounded-lg shadow-xl w-full">
            </div>
            <div class="animate-fade-in-left">
                <h2 class="text-4xl font-bold text-accent mb-4">เรื่องราวของเรา</h2>
                <p class="text-text-main mb-6">HotelSys ก่อตั้งขึ้นด้วยความมุ่งมั่นที่จะมอบประสบการณ์การพักผ่อนที่น่าจดจำ เราผสมผสานการออกแบบที่ทันสมัยเข้ากับการบริการที่เป็นเลิศเพื่อสร้างสรรค์ช่วงเวลาที่พิเศษสำหรับแขกทุกท่าน</p>
                <p class="text-text-main">เราเชื่อว่าทุกการเดินทางคือโอกาสในการสร้างความทรงจำใหม่ๆ และเราพร้อมที่จะเป็นส่วนหนึ่งของการเดินทางของคุณ</p>
            </div>
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="py-20 bg-accent-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-accent">สิ่งอำนวยความสะดวกของเรา</h2>
            <p class="text-text-main mt-2">เรามีบริการครบครันเพื่อตอบสนองทุกความต้องการของคุณ</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="p-6 bg-white rounded-lg shadow-md transform transition duration-300 hover:scale-110 card">
                <svg class="h-12 w-12 mx-auto text-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <h3 class="text-xl font-semibold text-text-main">สระว่ายน้ำ</h3>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md transform transition duration-300 hover:scale-110 card">
                <svg class="h-12 w-12 mx-auto text-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <h3 class="text-xl font-semibold text-text-main">ฟิตเนส 24 ชม.</h3>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md transform transition duration-300 hover:scale-110 card">
                <svg class="h-12 w-12 mx-auto text-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.29 1.29.904 3.43.028 4.305-1.164 1.164-3.337 1.164-4.501 0-1.164-1.164-1.164-3.337 0-4.501l5-5A2 2 0 0017 8.828V5l-1-1z"></path></svg>
                <h3 class="text-xl font-semibold text-text-main">สปาและซาวน่า</h3>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md transform transition duration-300 hover:scale-110 card">
                <svg class="h-12 w-12 mx-auto text-accent mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v.01M12 12v.01M12 16v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-xl font-semibold text-text-main">ห้องอาหาร</h3>
            </div>
        </div>
    </div>
</section>

<?php include_once __DIR__ . '/partials/footer.php'; ?>