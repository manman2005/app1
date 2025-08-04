    </main>
    <footer class="bg-light-wood shadow-md mt-8">
        <div class="container mx-auto px-6 py-4 text-center text-dark-brown">
            <p>&copy; <?php echo date('Y'); ?> HotelSys. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>