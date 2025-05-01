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
                    <a href="admin_dashboard.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="admin_confirm.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-check-circle me-2"></i> Konfirmasi Pembayaran
                    </a>
                    <a href="admin_restocks.php" class="list-group-item list-group-item-action active">
                        <i class="fas fa-box me-2"></i> Restock Barang
                    </a>
                    <a href="admin_invoice_export.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-file-export me-2"></i> Export Invoice
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Inventory Management Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Restock Barang</h5>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: 150px;">
                            <option value="all">Semua Kategori</option>
                            <option value="soccer">Sepakbola</option>
                            <option value="futsal">Futsal</option>
                            <option value="running">Running</option>
                            <option value="badminton">Bulutangkis</option>
                        </select>
                        <input type="text" class="form-control form-control-sm" placeholder="Search Product..." style="width: 200px;">
                    </div>
                </div>
                <div class="card-body">
                    <!-- Category: Soccer -->
                    <div class="category-section mb-4">
                        <h6 class="category-title mb-3">Sepakbola</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Current Stock</th>
                                        <th>Add Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#SCR001</td>
                                        <td>Nike Pro Soccer Shoes</td>
                                        <td>42</td>
                                        <td>
                                            <span class="badge bg-danger">2</span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" style="width: 80px;" min="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Update</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#SCR002</td>
                                        <td>Manchester United Jersey</td>
                                        <td>L</td>
                                        <td>
                                            <span class="badge bg-warning">5</span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" style="width: 80px;" min="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Update</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Category: Futsal -->
                    <div class="category-section mb-4">
                        <h6 class="category-title mb-3">Futsal</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Current Stock</th>
                                        <th>Add Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#FTS001</td>
                                        <td>Adidas Futsal Shoes</td>
                                        <td>40</td>
                                        <td>
                                            <span class="badge bg-success">15</span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" style="width: 80px;" min="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Update</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Category: Running -->
                    <div class="category-section mb-4">
                        <h6 class="category-title mb-3">Running</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Current Stock</th>
                                        <th>Add Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#RUN001</td>
                                        <td>Nike Running Shoes</td>
                                        <td>43</td>
                                        <td>
                                            <span class="badge bg-warning">8</span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" style="width: 80px;" min="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Update</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Category: Badminton -->
                    <div class="category-section">
                        <h6 class="category-title mb-3">Bulutangkis</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Current Stock</th>
                                        <th>Add Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#BAD001</td>
                                        <td>Yonex Badminton Shoes</td>
                                        <td>41</td>
                                        <td>
                                            <span class="badge bg-success">20</span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm" style="width: 80px;" min="1">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary">Update</button>
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
</div>

<style>
/* Admin Restock Page Specific Styles */
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

.category-title {
    color: var(--primary-red);
    font-weight: bold;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--light-red);
}

.badge {
    padding: 0.5rem 0.75rem;
}

.table > :not(caption) > * > * {
    padding: 1rem;
}

.btn-primary {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
}

.btn-primary:hover {
    background-color: var(--dark-red);
    border-color: var(--dark-red);
}

/* Stock level indicators */
.badge.bg-danger {
    background-color: #dc3545 !important;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
    color: #000;
}

.badge.bg-success {
    background-color: #198754 !important;
}

/* Form controls */
.form-control:focus {
    border-color: var(--primary-red);
    box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
}
</style>

<?php include '../includes/footer.php'; ?>
