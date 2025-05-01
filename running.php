<?php
session_start();
include 'includes/header.php';
include 'includes/catalog_modal.php';
?>

<div class="category-header">
    <div class="container">
        <h1>Running</h1>
    </div>
</div>

<div class="container">
    <!-- Running Jerseys Section -->
    <section class="mb-5">
        <h2 class="section-title">Jersey Running</h2>
        <div class="row">
            <?php for($i = 1; $i <= 20; $i++): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="https://images.pexels.com/photos/2994951/pexels-photo-2994951.jpeg" class="card-img-top" alt="Running Jersey <?= $i ?>">
                    <div class="card-body">
                        <h5 class="card-title">Pro Running Jersey <?= $i ?></h5>
                        <p class="card-text">Jersey Running Premium dengan Bahan Berkualitas</p>
                        <p class="card-text">
                            <small>Ukuran: S, M, L, XL</small>
                        </p>
                        <p class="card-text">
                            <small>Warna: Multiple Colors Available</small>
                        </p>
                        <p class="card-text"><strong>Rp 350.000</strong></p>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="purchase.php?id=1" class="btn btn-primary w-100">Beli</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary w-100">Login untuk Membeli</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Running Shoes Section -->
    <section class="mb-5">
        <h2 class="section-title">Sepatu Running</h2>
        <div class="row">
            <?php
            $brands = ['Nike', 'Adidas', 'Hoka', 'Ortusheight'];
            $sizes = range(32, 45);
            
            foreach($brands as $brand):
                for($i = 1; $i <= 10; $i++): ?>
                <div class="col-md-3 mb-4">
                    <div class="card product-card">
                        <img src="https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg" class="card-img-top" alt="<?= $brand ?> Running Shoes">
                        <div class="card-body">
                            <h5 class="card-title"><?= $brand ?> Runner Pro <?= $i ?></h5>
                            <p class="card-text">Sepatu Running Professional</p>
                            <p class="card-text">
                                <small>Ukuran: <?= implode(', ', $sizes) ?></small>
                            </p>
                            <p class="card-text">
                                <small>Teknologi: Cushioning System</small><br>
                                <small>Berat: Ultra Light</small>
                            </p>
                            <p class="card-text"><strong>Rp 1.800.000</strong></p>
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <a href="purchase.php?id=1" class="btn btn-primary w-100">Beli</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-primary w-100">Login untuk Membeli</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php 
                endfor;
            endforeach; ?>
        </div>
    </section>
</div>

<style>
/* Additional styles specific to running products */
.product-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.product-card img {
    height: 200px;
    object-fit: cover;
}

.section-title {
    color: var(--primary-red);
    margin-bottom: 2rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-red);
}

.category-header {
    background: linear-gradient(to right, var(--primary-red), var(--dark-red));
    color: white;
    padding: 3rem 0;
    margin-bottom: 3rem;
}

.category-header h1 {
    color: white;
    text-align: center;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

/* Product features badges */
.feature-badge {
    background-color: var(--light-red);
    color: var(--primary-red);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    display: inline-block;
}

/* Price styling */
.card-body .text-price {
    font-size: 1.25rem;
    font-weight: bold;
    color: var(--primary-red);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-md-3 {
        margin-bottom: 2rem;
    }
    
    .category-header {
        padding: 2rem 0;
    }
    
    .category-header h1 {
        font-size: 2rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
