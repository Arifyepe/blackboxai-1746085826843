<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    }

    // If no validation errors, proceed with login
    if (empty($errors)) {
        try {
            // Get user from database
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Verify password and user exists
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_address'] = $user['address'];
                $_SESSION['role'] = $user['role'];

                // Regenerate session ID for security
                session_regenerate_id(true);

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: admin/admin_dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                $errors[] = "Email atau password salah";
            }
        } catch (PDOException $e) {
            $errors[] = "Terjadi kesalahan. Silakan coba lagi.";
            error_log($e->getMessage());
        }
    }

    // If there are errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        $_SESSION['login_email'] = $email; // Remember email for form
        header("Location: login.php");
        exit();
    }
} else {
    // If accessed directly without POST
    header("Location: login.php");
    exit();
}
?>
