<?php
session_start();
// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
include '../includes/header.php';
?>

<div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-3">
            <!-- Admin Sidebar -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Admin Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="admin_dashboard.php" class="list-group-item list-group-item-action active">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="admin_confirm.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-check-circle me-2"></i> Konfirmasi Pembayaran
                    </a>
                    <a href="admin_restocks.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-box me-2"></i> Restock Barang
                    </a>
                    <a href="admin_invoice_export.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-export me-2"></i> Export Invoice
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <h2 class="mb-0">15</h2>
                            <small>Menunggu Konfirmasi</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <h2 class="mb-0">Rp 25.5M</h2>
                            <small>Bulan Ini</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Low Stock</h5>
                            <h2 class="mb-0">8</h2>
                            <small>Produk</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD001</td>
                                    <td>John Doe</td>
                                    <td>Nike Pro Soccer Shoes</td>
                                    <td>Rp 1.500.000</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Confirm</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD002</td>
                                    <td>Jane Smith</td>
                                    <td>Adidas Running Shoes</td>
                                    <td>Rp 1.800.000</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary" disabled>Confirmed</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Low Stock Products -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Produk Stok Menipis</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Current Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#PRD001</td>
                                    <td>Nike Pro Soccer Shoes</td>
                                    <td>Soccer</td>
                                    <td><span class="text-danger">2</span></td>
                                    <td>
                                        <a href="admin_restocks.php" class="btn btn-sm btn-warning">Restock</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Admin Dashboard Specific Styles */
.card {
    border: none;
    margin-bottom: 1rem;
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.list-group-item.active {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
}

.list-group-item:first-child {
    border-top: none;
}

.card-header {
    border-bottom: none;
    background-color: white;
}

.table > :not(caption) > * > * {
    padding: 1rem;
}

.badge {
    padding: 0.5rem 0.75rem;
}

/* Custom color for primary elements */
.bg-primary {
    background-color: var(--primary-red) !important;
}

.btn-primary {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
}

.btn-primary:hover {
    background-color: var(--dark-red);
    border-color: var(--dark-red);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
