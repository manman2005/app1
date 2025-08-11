<?php include_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-text-main mb-8 text-center font-display">ประวัติการจองของฉัน</h1>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <?php if (!empty($bookings)): ?>
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ห้องพัก</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">เช็คอิน</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">เช็คเอาท์</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ราคารวม</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">สถานะ</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        $thai_days = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
                        $thai_months = array(
                            1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน",
                            5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม",
                            9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"
                        );
                        foreach ($bookings as $booking):
                            $check_in_ts = strtotime($booking['check_in_date']);
                            $check_out_ts = strtotime($booking['check_out_date']);

                            $check_in_formatted = "วัน" . $thai_days[date('w', $check_in_ts)] . "ที่ " . date('j', $check_in_ts) . " " . $thai_months[date('n', $check_in_ts)] . " " . (date('Y', $check_in_ts) + 543);
                            $check_out_formatted = "วัน" . $thai_days[date('w', $check_out_ts)] . "ที่ " . date('j', $check_out_ts) . " " . $thai_months[date('n', $check_out_ts)] . " " . (date('Y', $check_out_ts) + 543);
                            
                            $image_url = (!empty($booking['room_details']->image_url) && is_array($booking['room_details']->image_url))
                                ? htmlspecialchars($booking['room_details']->image_url[0])
                                : 'https://via.placeholder.com/150?text=No+Image';
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            <img class="h-16 w-16 rounded-lg object-cover" src="<?= $image_url; ?>" alt="Room Image">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($booking['room_details']->room_number ?? 'N/A'); ?></div>
                                            <div class="text-sm text-gray-500"><?= htmlspecialchars($booking['room_details']->room_type ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 align-middle">
                                    <?= $check_in_formatted; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 align-middle">
                                    <?= $check_out_formatted; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-middle">
                                    ฿<?= number_format($booking['total_price'], 2); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">
                                    <?php 
                                        $status_bg_color = 'bg-yellow-100 text-yellow-800';
                                        $status_icon = '<svg class="h-4 w-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 10.586V6z" clip-rule="evenodd"></path></svg>';
                                        if ($booking['status'] === 'confirmed') {
                                            $status_bg_color = 'bg-green-100 text-green-800';
                                            $status_icon = '<svg class="h-4 w-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>';
                                        } elseif ($booking['status'] === 'cancelled') {
                                            $status_bg_color = 'bg-red-100 text-red-800';
                                            $status_icon = '<svg class="h-4 w-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';
                                        }
                                    ?>
                                     <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_bg_color ?> items-center">
                                        <?= $status_icon ?>
                                        <?= htmlspecialchars(ucfirst($booking['status'])); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-middle">
                                    <a href="/app1/public/book?room_id=<?= $booking['room_id'] ?>" class="text-accent hover:text-highlight transition-colors duration-200">ดูรายละเอียด</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center py-20 px-6">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">ไม่มีประวัติการจอง</h3>
                    <p class="mt-1 text-sm text-gray-500">ดูเหมือนว่าคุณยังไม่เคยทำการจองใดๆ</p>
                    <div class="mt-6">
                        <a href="/app1/public/" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-accent hover:bg-highlight focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-dark">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            เริ่มการจองครั้งแรก
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>