<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Detail Pembelian</h3>
                </div>
                <div class="card-body">
                    <form action="purchase_process.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $_GET['id'] ?? ''; ?>">
                        
                        <div class="mb-4">
                            <h4>Alamat Pengiriman</h4>
                            <textarea class="form-control" name="shipping_address" rows="3" required><?php echo $_SESSION['user_address'] ?? ''; ?></textarea>
                        </div>

                        <div class="mb-4">
                            <h4>Metode Pembayaran</h4>
                            <select class="form-select" name="payment_method" required>
                                <option value="">Pilih metode pembayaran</option>
                                <option value="bca">Transfer Bank BCA</option>
                                <option value="bri">Transfer Bank BRI</option>
                                <option value="dana">DANA</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Konfirmasi Pembelian</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Ringkasan Pesanan</h3>
                </div>
                <div class="card-body">
                    <!-- This would be populated with actual product data from the database -->
                    <div class="product-summary">
                        <h5>Nama Produk</h5>
                        <p class="text-muted">Ukuran: XL</p>
                        <p class="fw-bold">Rp 750.000</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5>Rp 750.000</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const address = document.querySelector('textarea[name="shipping_address"]').value;
    const payment = document.querySelector('select[name="payment_method"]').value;
    
    if (!address.trim() || !payment) {
        e.preventDefault();
        alert('Mohon lengkapi semua data pembelian!');
    }
});
</script>
