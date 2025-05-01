<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'includes/header.php';
?>

<div class="container my-5">
    <h2 class="mb-4">Riwayat Pembelian</h2>

    <div class="row">
        <div class="col-12">
            <!-- Example orders - In real implementation, these would be pulled from database -->
            <div class="purchase-history-item mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <p class="text-muted mb-0">Invoice #INV001</p>
                                <small class="text-muted">20 Mar 2024</small>
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-1">Nike Pro Soccer Shoes</h5>
                                <p class="mb-0">Ukuran: 42</p>
                            </div>
                            <div class="col-md-2">
                                <p class="mb-0">Rp 1.500.000</p>
                            </div>
                            <div class="col-md-2">
                                <span class="badge bg-success">Confirmed</span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-outline-primary" onclick="window.open('invoice.php?id=INV001', '_blank')">
                                    <i class="fas fa-file-invoice"></i> Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="purchase-history-item mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <p class="text-muted mb-0">Invoice #INV002</p>
                                <small class="text-muted">19 Mar 2024</small>
                            </div>
                            <div class="col-md-4">
                                <h5 class="mb-1">Manchester United Jersey</h5>
                                <p class="mb-0">Ukuran: L</p>
                            </div>
                            <div class="col-md-2">
                                <p class="mb-0">Rp 750.000</p>
                            </div>
                            <div class="col-md-2">
                                <span class="badge bg-warning text-dark">Pending</span>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-outline-primary" onclick="window.open('invoice.php?id=INV002', '_blank')">
                                    <i class="fas fa-file-invoice"></i> Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- No orders message -->
            <?php if (false): // This would be a check if no orders exist ?>
            <div class="text-center py-5">
                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                <h4>Belum ada pembelian</h4>
                <p class="text-muted">Mulai belanja sekarang!</p>
                <a href="index.php" class="btn btn-primary">Mulai Belanja</a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

<style>
.purchase-history-item .card {
    transition: transform 0.2s ease;
    border-left: 4px solid var(--primary-red);
}

.purchase-history-item .card:hover {
    transform: translateX(5px);
}

.badge {
    padding: 8px 12px;
    font-weight: 500;
}

.btn-outline-primary {
    color: var(--primary-red);
    border-color: var(--primary-red);
}

.btn-outline-primary:hover {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
    color: white;
}

.pagination .page-link {
    color: var(--primary-red);
}

.pagination .page-item.active .page-link {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
    color: white;
}
</style>

<?php include 'includes/footer.php'; ?>
