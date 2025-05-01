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
                    <a href="admin_confirm.php" class="list-group-item list-group-item-action active">
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
            <!-- Pending Orders Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Konfirmasi Pembayaran</h5>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" style="width: 150px;">
                            <option value="all">Semua Status</option>
                            <option value="pending" selected>Pending</option>
                            <option value="confirmed">Confirmed</option>
                        </select>
                        <input type="text" class="form-control form-control-sm" placeholder="Search Order ID..." style="width: 200px;">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example Order 1 -->
                                <tr>
                                    <td>#ORD001</td>
                                    <td>2024-03-20</td>
                                    <td>
                                        <div>John Doe</div>
                                        <small class="text-muted">john@example.com</small>
                                    </td>
                                    <td>
                                        <div>Nike Pro Soccer Shoes</div>
                                        <small class="text-muted">Size: 42</small>
                                    </td>
                                    <td>Rp 1.500.000</td>
                                    <td>Transfer BCA</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal1">
                                            Confirm
                                        </button>
                                    </td>
                                </tr>

                                <!-- Example Order 2 -->
                                <tr>
                                    <td>#ORD002</td>
                                    <td>2024-03-20</td>
                                    <td>
                                        <div>Jane Smith</div>
                                        <small class="text-muted">jane@example.com</small>
                                    </td>
                                    <td>
                                        <div>Adidas Running Shoes</div>
                                        <small class="text-muted">Size: 39</small>
                                    </td>
                                    <td>Rp 1.800.000</td>
                                    <td>DANA</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal2">
                                            Confirm
                                        </button>
                                    </td>
                                </tr>

                                <!-- Example Confirmed Order -->
                                <tr class="table-light">
                                    <td>#ORD003</td>
                                    <td>2024-03-19</td>
                                    <td>
                                        <div>Mike Johnson</div>
                                        <small class="text-muted">mike@example.com</small>
                                    </td>
                                    <td>
                                        <div>Manchester United Jersey</div>
                                        <small class="text-muted">Size: L</small>
                                    </td>
                                    <td>Rp 750.000</td>
                                    <td>Transfer BRI</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary" disabled>Confirmed</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
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
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal1" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <h6>Order Details</h6>
                    <p class="mb-1">Order ID: #ORD001</p>
                    <p class="mb-1">Customer: John Doe</p>
                    <p class="mb-1">Product: Nike Pro Soccer Shoes</p>
                    <p class="mb-1">Amount: Rp 1.500.000</p>
                    <p class="mb-0">Payment Method: Transfer BCA</p>
                </div>
                <div class="alert alert-warning">
                    Are you sure you want to confirm this payment?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Admin Confirmation Page Specific Styles */
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

.modal-header {
    background-color: var(--primary-red);
    color: white;
}

.modal-header .btn-close {
    color: white;
}

/* Pagination styling */
.pagination .page-link {
    color: var(--primary-red);
}

.pagination .page-item.active .page-link {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
    color: white;
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
