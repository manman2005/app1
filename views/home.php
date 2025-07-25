<?php include_once __DIR__ . '/partials/header.php'; ?>

<section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 text-white text-center">
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-4 animate-fade-in-up">ยินดีต้อนรับสู่ HotelSys</h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in-up delay-200">ประสบการณ์การพักผ่อนที่เหนือระดับรอคุณอยู่</p>
        <?php if (isset($_SESSION['username'])): ?>
            <p class="mt-4 text-xl animate-fade-in-up delay-400">สวัสดี, <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</p>
        <?php endif; ?>
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 animate-fade-in-up delay-600">จองห้องพักตอนนี้</a>
    </div>
</section>

<section class="py-16 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">ห้องพักของเรา</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Room Card 1 -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://images.unsplash.com/photo-1596394516093-501ba6806ce9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Standard Room" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-white mb-2">ห้องสแตนดาร์ด</h3>
                    <p class="text-gray-200 mb-4">ห้องพักสะดวกสบายพร้อมสิ่งอำนวยความสะดวกครบครัน เหมาะสำหรับการพักผ่อนระยะสั้น</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-400">฿1,500 / คืน</span>
                        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">ดูรายละเอียด</a>
                    </div>
                </div>
            </div>
            <!-- Room Card 2 -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Deluxe Room" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-white mb-2">ห้องดีลักซ์</h3>
                    <p class="text-gray-200 mb-4">ห้องพักกว้างขวางพร้อมวิวสวยงาม และพื้นที่นั่งเล่นแยกต่างหาก</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-400">฿2,500 / คืน</span>
                        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">ดูรายละเอียด</a>
                    </div>
                </div>
            </div>
            <!-- Room Card 3 -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Suite Room" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-white mb-2">ห้องสวีท</h3>
                    <p class="text-gray-200 mb-4">ห้องพักสุดหรูพร้อมห้องนอนแยก ห้องนั่งเล่น และสิ่งอำนวยความสะดวกระดับพรีเมียม</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-blue-400">฿4,000 / คืน</span>
                        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">ดูรายละเอียด</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once __DIR__ . '/partials/footer.php'; ?>