<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$username = '';
$email = '';
$phone_number = '';

if (isset($_SESSION['form_data'])) {
    $username = htmlspecialchars($_SESSION['form_data']['username'] ?? '');
    $email = htmlspecialchars($_SESSION['form_data']['email'] ?? '');
    $phone_number = htmlspecialchars($_SESSION['form_data']['phone_number'] ?? '');
    unset($_SESSION['form_data']);
}

include_once __DIR__ . '/../../views/partials/header.php';
?>

<div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
    <div class="sm:mx-auto sm:w-full sm:max-w-5xl">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden md:flex">
            
            <!-- Image Column -->
            <div class="hidden md:block md:w-1/2">
                <img class="object-cover h-full w-full" src="/app1/img/man1.jpg" alt="Registration page background image">
            </div>

            <!-- Form Column -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2 class="mt-6 text-center text-4xl font-extrabold text-gray-900">
                        สร้างบัญชีใหม่
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        หรือ <a href="/app1/auth/login" class="font-medium text-accent hover:text-highlight">
                            เข้าสู่ระบบที่นี่
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    <!-- Display errors if any -->
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                            <p><?= htmlspecialchars($_SESSION['error_message']); ?></p>
                        </div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>

                    <form action="/app1/auth/register_process" method="POST" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">
                                ชื่อผู้ใช้
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="username" name="username" type="text" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="yourusername" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                อีเมล
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="you@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                เบอร์โทรศัพท์
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="phone_number" name="phone_number" type="text" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="081-234-5678" value="<?= htmlspecialchars($_POST['phone_number'] ?? '') ?>">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                รหัสผ่าน
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="********">
                            </div>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                                ยืนยันรหัสผ่าน
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="********">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-accent hover:bg-highlight focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-dark transition-all duration-300 transform hover:scale-105">
                                สมัครสมาชิก
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../views/partials/footer.php'; ?>
