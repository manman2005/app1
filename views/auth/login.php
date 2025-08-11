<?php include_once __DIR__ . '/../../views/partials/header.php'; ?>

<div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
    <div class="sm:mx-auto sm:w-full sm:max-w-5xl">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden md:flex">
            
            <!-- Form Column -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2 class="mt-6 text-center text-4xl font-extrabold text-gray-900">
                        เข้าสู่ระบบ
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        ยังไม่มีบัญชี? <a href="/app1/public/auth/register" class="font-medium text-accent hover:text-highlight">
                            สมัครสมาชิกที่นี่
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    <!-- Display messages -->
                    <?php if (isset($_SESSION['success_message'])):
                    ?>
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                            <p><?= htmlspecialchars($_SESSION['success_message']); ?></p>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error_message'])):
                    ?>
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                            <p><?= htmlspecialchars($_SESSION['error_message']); ?></p>
                        </div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>

                    <form action="/app1/public/auth/login_process" method="POST" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">
                                ชื่อผู้ใช้
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="username" name="username" type="text" autocomplete="username" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="yourusername">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                รหัสผ่าน
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-accent focus:border-accent sm:text-sm" placeholder="********">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-accent focus:ring-accent-dark border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                    จดจำฉันไว้ในระบบ
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-accent hover:text-highlight">
                                    ลืมรหัสผ่าน?
                                </a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-accent hover:bg-highlight focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-dark transition-all duration-300 transform hover:scale-105">
                                เข้าสู่ระบบ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Image Column -->
            <div class="hidden md:block md:w-1/2">
                <img class="object-cover h-full w-full" src="/app1/public/img/man2.jpg" alt="Login page background image">
            </div>

        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../views/partials/footer.php'; ?>
