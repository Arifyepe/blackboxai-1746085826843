<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
    $shipping_address = htmlspecialchars($_POST['shipping_address']);
    $payment_method = $_POST['payment_method'];
    $errors = [];

    // Validate inputs
    if (empty($shipping_address)) {
        $errors[] = "Alamat pengiriman harus diisi";
    }

    if (!in_array($payment_method, ['bca', 'bri', 'dana'])) {
        $errors[] = "Metode pembayaran tidak valid";
    }

    // If no validation errors, proceed with purchase
    if (empty($errors)) {
        try {
            $pdo->beginTransaction();

            // Get product details
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$product_id]);
            $product = $stmt->fetch();

            if (!$product) {
                throw new Exception("Produk tidak ditemukan");
            }

            // Check stock availability
            if ($product['quantity'] < 1) {
                throw new Exception("Stok produk habis");
            }

            // Generate unique invoice number
            $invoice_number = 'INV' . date('YmdHis') . rand(100, 999);

            // Create order
            $stmt = $pdo->prepare("
                INSERT INTO orders (
                    user_id, 
                    product_id, 
                    quantity, 
                    shipping_address, 
                    payment_method, 
                    status, 
                    invoice_number,
                    total_amount
                ) VALUES (?, ?, ?, ?, ?, 'pending', ?, ?)
            ");

            $stmt->execute([
                $user_id,
                $product_id,
                1, // Quantity (default to 1 for now)
                $shipping_address,
                $payment_method,
                $invoice_number,
                $product['price']
            ]);

            $order_id = $pdo->lastInsertId();

            // Update product stock
            $stmt = $pdo->prepare("
                UPDATE products 
                SET quantity = quantity - 1 
                WHERE id = ? AND quantity > 0
            ");
            $stmt->execute([$product_id]);

            // Commit transaction
            $pdo->commit();

            // Store success message and redirect
            $_SESSION['purchase_success'] = true;
            $_SESSION['invoice_number'] = $invoice_number;
            header("Location: purchase_history.php");
            exit();

        } catch (Exception $e) {
            // Rollback transaction on error
            $pdo->rollBack();
            $errors[] = $e->getMessage();
            error_log($e->getMessage());
        }
    }

    // If there are errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['purchase_errors'] = $errors;
        $_SESSION['purchase_data'] = [
            'shipping_address' => $shipping_address,
            'payment_method' => $payment_method
        ];
        header("Location: purchase.php?id=" . $product_id);
        exit();
    }
} else {
    // If accessed directly without POST
    header("Location: index.php");
    exit();
}

// Function to generate payment instructions based on method
function getPaymentInstructions($method, $amount, $invoice_number) {
    switch ($method) {
        case 'bca':
            return [
                'bank' => 'BCA',
                'account_number' => '1234567890',
                'account_name' => 'SPORTS STORE',
                'amount' => $amount,
                'invoice_number' => $invoice_number
            ];
        case 'bri':
            return [
                'bank' => 'BRI',
                'account_number' => '0987654321',
                'account_name' => 'SPORTS STORE',
                'amount' => $amount,
                'invoice_number' => $invoice_number
            ];
        case 'dana':
            return [
                'type' => 'DANA',
                'number' => '081234567890',
                'name' => 'SPORTS STORE',
                'amount' => $amount,
                'invoice_number' => $invoice_number
            ];
        default:
            return null;
    }
}

// Function to send email notification (you would need to implement proper email sending)
function sendOrderConfirmationEmail($user_email, $invoice_number, $payment_instructions) {
    // Implement email sending functionality here
    // You might want to use PHPMailer or other email libraries
    
    $to = $user_email;
    $subject = "Order Confirmation - Invoice #" . $invoice_number;
    
    $message = "Thank you for your order!\n\n";
    $message .= "Invoice Number: " . $invoice_number . "\n\n";
    $message .= "Payment Instructions:\n";
    $message .= "Bank: " . $payment_instructions['bank'] . "\n";
    $message .= "Account Number: " . $payment_instructions['account_number'] . "\n";
    $message .= "Account Name: " . $payment_instructions['account_name'] . "\n";
    $message .= "Amount: Rp " . number_format($payment_instructions['amount'], 0, ',', '.') . "\n\n";
    $message .= "Please complete your payment within 24 hours.\n";
    
    // Use mail() function or preferably a proper email library
    // mail($to, $subject, $message);
}
?>
