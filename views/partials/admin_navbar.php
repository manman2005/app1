<nav class="bg-stone-800 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="/app1/admin/dashboard" class="flex-shrink-0 flex items-center text-white">
                    <svg class="h-8 w-8 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17.25v-4.5m0 4.5h4.5m-4.5 0l6-6m3 6l-6-6m6 6v-4.5m0 4.5h-4.5m4.5 0l-6-6m-3 6l6-6m-6 6h4.5m0 0v-4.5m0 4.5L15 6.75M9.75 6.75h4.5M9.75 6.75L15 12.25" />
                    </svg>
                    <span class="font-bold text-xl">ระบบจัดการหลังบ้าน</span>
                </a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/app1/admin/dashboard?tab=user-management-tab" class="nav-link text-gray-300 hover:bg-stone-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">จัดการผู้ใช้</a>
                    <a href="/app1/admin/dashboard?tab=booking-management-tab" class="nav-link text-gray-300 hover:bg-stone-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">จัดการการจอง</a>
                    <a href="/app1/admin/dashboard?tab=room-management-tab" class="nav-link text-gray-300 hover:bg-stone-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">จัดการห้องพัก</a>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <span class="text-gray-400">สวัสดี, <?= htmlspecialchars($_SESSION['username']); ?></span>
                <a href="/app1/" class="text-gray-300 hover:bg-stone-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" target="_blank">กลับสู่หน้าหลัก</a>
                <a href="/app1/logout" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium">ออกจากระบบ</a>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button type="button" id="mobile-menu-button-admin" class="bg-stone-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-stone-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-stone-800 focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="md:hidden hidden" id="mobile-menu-admin">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/app1/admin/dashboard?tab=user-management-tab" class="nav-link text-gray-300 hover:bg-stone-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">จัดการผู้ใช้</a>
            <a href="/app1/admin/dashboard?tab=booking-management-tab" class="nav-link text-gray-300 hover:bg-stone-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">จัดการการจอง</a>
            <a href="/app1/admin/dashboard?tab=room-management-tab" class="nav-link text-gray-300 hover:bg-stone-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">จัดการห้องพัก</a>
        </div>
        <div class="pt-4 pb-3 border-t border-stone-700">
            <div class="flex items-center px-5">
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white"><?= htmlspecialchars($_SESSION['username']); ?></div>
                </div>
            </div>
            <div class="mt-3 px-2 space-y-1">
                <a href="/app1/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-stone-700" target="_blank">กลับสู่หน้าหลัก</a>
                <a href="/app1/auth/logout" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-stone-700">ออกจากระบบ</a>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('mobile-menu-button-admin');
    const menu = document.getElementById('mobile-menu-admin');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    const navLinks = document.querySelectorAll('.nav-link');
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || 'user-management-tab'; // Default to user tab

    navLinks.forEach(link => {
        const tabName = new URL(link.href).searchParams.get('tab');
        if (tabName === activeTab) {
            link.classList.add('bg-accent', 'text-white');
            link.classList.remove('text-gray-300', 'hover:bg-stone-700');
        } else {
            link.classList.remove('bg-accent', 'text-white');
            link.classList.add('text-gray-300', 'hover:bg-stone-700');
        }
    });
});
</script>