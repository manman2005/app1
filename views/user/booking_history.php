<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-text-main mb-8 text-center font-display">ประวัติการจองของฉัน</h1>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <?php if (!empty($bookings)): ?>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-accent-light">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-main uppercase tracking-wider">เคบิน/เต็นท์</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-main uppercase tracking-wider">วันที่เช็คอิน</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-main uppercase tracking-wider">วันที่เช็คเอาท์</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-main uppercase tracking-wider">ราคารวม</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-main uppercase tracking-wider">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($booking['room_details']->room_number ?? 'N/A'); ?></div>
                                            <div class="text-sm text-gray-500"><?= htmlspecialchars($booking['room_details']->room_type ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars(date("d/m/Y", strtotime($booking['check_in_date']))); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= htmlspecialchars(date("d/m/Y", strtotime($booking['check_out_date']))); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    ฿<?= number_format($booking['total_price']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                     <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $booking['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                        <?= htmlspecialchars($booking['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center py-12 text-gray-500">คุณยังไม่มีประวัติการจอง</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>