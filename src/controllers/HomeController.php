<?php
class HomeController {
    public function index() {
        // This will be the main landing page
        include_once __DIR__ . '/../../views/home.php';
    }
}
?>