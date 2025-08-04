<?php include_once __DIR__ . '/partials/header.php'; ?>

<div class="min-h-screen bg-cream text-dark-brown py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12 text-natural-green">ค้นหาห้องพัก</h1>

        <div class="max-w-2xl mx-auto bg-light-green p-8 rounded-lg shadow-lg card">
            <form action="#" method="GET" class="space-y-6">
                <div>
                    <label for="destination" class="block text-dark-brown text-sm font-bold mb-2">จุดหมายปลายทาง:</label>
                    <input type="text" id="destination" name="destination" class="shadow appearance-none border rounded w-full py-3 px-4 text-dark-brown leading-tight focus:outline-none focus:shadow-outline bg-white border-misty-blue placeholder-gray-400" placeholder="เช่น กรุงเทพฯ, เชียงใหม่">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="check_in" class="block text-dark-brown text-sm font-bold mb-2">เช็คอิน:</label>
                        <input type="date" id="check_in" name="check_in" class="shadow appearance-none border rounded w-full py-3 px-4 text-dark-brown leading-tight focus:outline-none focus:shadow-outline bg-white border-misty-blue placeholder-gray-400">
                    </div>
                    <div>
                        <label for="check_out" class="block text-dark-brown text-sm font-bold mb-2">เช็คเอาท์:</label>
                        <input type="date" id="check_out" name="check_out" class="shadow appearance-none border rounded w-full py-3 px-4 text-dark-brown leading-tight focus:outline-none focus:shadow-outline bg-white border-misty-blue placeholder-gray-400">
                    </div>
                </div>
                <div>
                    <label for="guests" class="block text-dark-brown text-sm font-bold mb-2">จำนวนผู้เข้าพัก:</label>
                    <input type="number" id="guests" name="guests" min="1" value="1" class="shadow appearance-none border rounded w-full py-3 px-4 text-dark-brown leading-tight focus:outline-none focus:shadow-outline bg-white border-misty-blue placeholder-gray-400">
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit" class="btn text-white font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                        ค้นหา
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-16 text-center">
            <h2 class="text-3xl font-bold mb-6 text-natural-green">ผลการค้นหา (ตัวอย่าง)</h2>
            <p class="text-dark-brown">ยังไม่มีผลการค้นหา กรุณาลองค้นหาห้องพัก</p>
            <!-- Search results will be displayed here -->
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/partials/footer.php'; ?>