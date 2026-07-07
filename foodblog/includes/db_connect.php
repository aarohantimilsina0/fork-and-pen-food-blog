<?php
// ============================================================
// db_connect.php – Database connection (include on all PHP pages)
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Change to your MySQL username
define('DB_PASS', '');            // Change to your MySQL password
define('DB_NAME', 'foodblog_db');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">
            <strong>Database Connection Failed:</strong> ' . htmlspecialchars($conn->connect_error) . '
         </div>');
}

$conn->set_charset('utf8mb4');
?>
