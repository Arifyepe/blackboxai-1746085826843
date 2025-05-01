<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = htmlspecialchars($_POST['address']);
    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $errors[] = "Email sudah terdaftar";
    }

    // Validate password
    if (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    }

    // Check password confirmation
    if ($password !== $confirm_password) {
        $errors[] = "Password dan konfirmasi password tidak sama";
    }

    // Validate address
    if (empty($address)) {
        $errors[] = "Alamat harus diisi";
    }

    // If there are no errors, proceed with registration
    if (empty($errors)) {
        try {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (email, password, address, role) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$email, $hashed_password, $address]);

            // Set success message
            $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
            header("Location: login.php");
            exit();

        } catch (PDOException $e) {
            $errors[] = "Terjadi kesalahan. Silakan coba lagi.";
            error_log($e->getMessage());
        }
    }

    // If there are errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        $_SESSION['register_data'] = [
            'email' => $email,
            'address' => $address
        ];
        header("Location: register.php");
        exit();
    }
} else {
    // If accessed directly without POST
    header("Location: register.php");
    exit();
}
?>
