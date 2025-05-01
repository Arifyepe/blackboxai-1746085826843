<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'sports_store');
define('DB_USER', 'root');  // Change this in production
define('DB_PASS', '');      // Change this in production

try {
    // Create PDO connection
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

    // Set timezone
    date_default_timezone_set('Asia/Jakarta');

} catch(PDOException $e) {
    // Log error message
    error_log("Database Connection Error: " . $e->getMessage());
    
    // Show user-friendly message
    die("Maaf, terjadi kesalahan koneksi ke database. Silakan coba beberapa saat lagi.");
}

/**
 * Helper function to safely get POST data
 */
function getPost($key, $default = null) {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

/**
 * Helper function to safely get GET data
 */
function getGet($key, $default = null) {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

/**
 * Helper function to format price
 */
function formatPrice($price) {
    return 'Rp ' . number_format($price, 0, ',', '.');
}

/**
 * Helper function to generate random string
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Helper function to validate file upload
 */
function validateImageUpload($file) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $filename = $file['name'];
    $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // Check file type
    if (!in_array($filetype, $allowed)) {
        return "Format file tidak diizinkan. Gunakan: " . implode(', ', $allowed);
    }
    
    // Check file size (max 5MB)
    if ($file['size'] > 5000000) {
        return "Ukuran file terlalu besar. Maksimal 5MB.";
    }
    
    return true;
}

/**
 * Helper function to upload file
 */
function uploadFile($file, $destination) {
    $validation = validateImageUpload($file);
    if ($validation !== true) {
        return $validation;
    }
    
    $filename = generateRandomString() . '_' . basename($file['name']);
    $target = $destination . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $target)) {
        return $filename;
    }
    
    return "Gagal mengupload file.";
}
?>
