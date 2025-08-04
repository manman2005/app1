<?php include_once __DIR__ . '/../../views/partials/header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-accent-light py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-center text-3xl font-extrabold text-text-main">Register</h1>
        
        <!-- Display errors if any -->
        <?php if (isset($_SESSION['error_message'])):
        ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></span>
            </div>
        <?php endif; ?>

        <form action="/app1/public/auth/register_process" method="POST" class="mt-8 space-y-6">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="username" class="sr-only">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-text-main bg-white rounded-t-md focus:outline-none focus:ring-accent focus:border-accent focus:z-10 sm:text-sm" placeholder="Username">
                </div>
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-text-main bg-white focus:outline-none focus:ring-accent focus:border-accent focus:z-10 sm:text-sm" placeholder="Email address">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-text-main bg-white rounded-b-md focus:outline-none focus:ring-accent focus:border-accent focus:z-10 sm:text-sm" placeholder="Password">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-accent hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                    Register
                </button>
            </div>
        </form>
        <p class="text-center text-text-main mt-2">
            Already have an account? <a href="/app1/public/auth/login" class="font-medium text-accent hover:text-opacity-80">Login here</a>
        </p>
    </div>
</div>

<?php include_once __DIR__ . '/../../views/partials/footer.php'; ?>