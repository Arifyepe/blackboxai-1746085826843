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
                    <a href="admin_restocks.php" class="list-group-item list-group-item-action">
                        <i class="fas fa-box me-2"></i> Restock Barang
                    </a>
                    <a href="admin_invoice_export.php" class="list-group-item list-group-item-action active">
                        <i class="fas fa-file-export me-2"></i> Export Invoice
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Invoice Export Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Export Invoice</h5>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Date Range</label>
                            <select class="form-select">
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="last7days">Last 7 Days</option>
                                <option value="last30days">Last 30 Days</option>
                                <option value="thismonth">This Month</option>
                                <option value="lastmonth">Last Month</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="all">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option value="all">All Categories</option>
                                <option value="soccer">Sepakbola</option>
                                <option value="futsal">Futsal</option>
                                <option value="running">Running</option>
                                <option value="badminton">Bulutangkis</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Export Format</label>
                            <select class="form-select">
                                <option value="excel">Excel (.xlsx)</option>
                                <option value="csv">CSV</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                    </div>

                    <!-- Custom Date Range (initially hidden) -->
                    <div class="row mb-4 d-none" id="customDateRange">
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <!-- Invoice Preview Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="form-check-input" id="selectAll">
                                    </th>
                                    <th>Invoice ID</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Products</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input">
                                    </td>
                                    <td>#INV001</td>
                                    <td>2024-03-20</td>
                                    <td>John Doe</td>
                                    <td>Nike Pro Soccer Shoes</td>
                                    <td>Rp 1.500.000</td>
                                    <td><span class="badge bg-success">Confirmed</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input">
                                    </td>
                                    <td>#INV002</td>
                                    <td>2024-03-20</td>
                                    <td>Jane Smith</td>
                                    <td>Adidas Running Shoes</td>
                                    <td>Rp 1.800.000</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Export Buttons -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted">Selected: <span id="selectedCount">0</span> invoices</span>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary" id="previewBtn">
                                <i class="fas fa-eye me-2"></i> Preview
                            </button>
                            <button class="btn btn-primary" id="exportBtn">
                                <i class="fas fa-file-export me-2"></i> Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="invoice-preview">
                    <!-- Sample Invoice Preview -->
                    <div class="text-center mb-4">
                        <h4>Sports Store</h4>
                        <p class="mb-0">Invoice #INV001</p>
                        <p>Date: 2024-03-20</p>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <h6>Bill To:</h6>
                            <p>John Doe<br>
                            john@example.com<br>
                            123 Street Name<br>
                            City, Country</p>
                        </div>
                        <div class="col-6 text-end">
                            <h6>Payment Method:</h6>
                            <p>Transfer BCA</p>
                        </div>
                    </div>
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nike Pro Soccer Shoes</td>
                                <td>1</td>
                                <td>Rp 1.500.000</td>
                                <td>Rp 1.500.000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp 1.500.000</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Export This Invoice</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Admin Invoice Export Page Specific Styles */
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

.btn-outline-primary {
    color: var(--primary-red);
    border-color: var(--primary-red);
}

.btn-outline-primary:hover {
    background-color: var(--primary-red);
    border-color: var(--primary-red);
    color: white;
}

/* Invoice Preview Styles */
.invoice-preview {
    padding: 2rem;
    background-color: white;
}

/* Form controls */
.form-control:focus, .form-select:focus {
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

<script>
// Toggle custom date range visibility
document.querySelector('select').addEventListener('change', function(e) {
    const customDateRange = document.getElementById('customDateRange');
    if (e.target.value === 'custom') {
        customDateRange.classList.remove('d-none');
    } else {
        customDateRange.classList.add('d-none');
    }
});

// Select all checkboxes
document.getElementById('selectAll').addEventListener('change', function(e) {
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    updateSelectedCount();
});

// Update selected count
function updateSelectedCount() {
    const selectedCount = document.querySelectorAll('tbody input[type="checkbox"]:checked').length;
    document.getElementById('selectedCount').textContent = selectedCount;
}

// Individual checkbox change
document.querySelectorAll('tbody input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

// Preview button click
document.getElementById('previewBtn').addEventListener('click', function() {
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
});
</script>

<?php include '../includes/footer.php'; ?>
