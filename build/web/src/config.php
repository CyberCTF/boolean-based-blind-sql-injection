<?php
// Database configuration
$db_host = getenv('DB_HOST') ?: 'database';
$db_port = getenv('DB_PORT') ?: '3207';
$db_name = getenv('DB_NAME') ?: 'app_repo41';
$db_user = getenv('DB_USER') ?: 'app_user';
$db_pass = getenv('DB_PASS') ?: 'app_password_secure_2024';

// Disable mysqli exceptions to prevent fatal errors
mysqli_report(MYSQLI_REPORT_OFF);

// Database connection function
function getDBConnection() {
    global $db_host, $db_port, $db_name, $db_user, $db_pass;
    
    $conn = @new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
    
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        return null;
    }
    
    $conn->set_charset("utf8mb4");
    return $conn;
}
