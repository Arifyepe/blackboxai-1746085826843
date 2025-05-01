<?php
session_start();
include 'includes/header.php';
include 'includes/catalog_modal.php';
?>

<div class="category-header">
    <div class="container">
        <h1>Futsal</h1>
    </div>
</div>

<div class="container">
    <!-- Futsal Jerseys Section -->
    <section class="mb-5">
        <h2 class="section-title">Jersey Futsal</h2>
        <div class="row">
            <?php
            $teams = [
                'Timnas Indonesia',
                'Bintang Timur Surabaya',
                'Blacksteel Manokwari',
                'Vamos Mataram',
                'Pendekar United'
            ];
            
            foreach($teams as $team): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="https://images.pexels.com/photos/3621104/pexels-photo-3621104.jpeg" class="card-img-top" alt="<?= $team ?> Jersey">
                    <div class="card-body">
                        <h5 class="card-title"><?= $team ?></h5>
                        <p class="card-text">Jersey Futsal 2024</p>
                        <p class="card-text">
                            <small>Ukuran: S, M, L, XL</small>
                        </p>
                        <p class="card-text"><strong>Rp 450.000</strong></p>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="purchase.php?id=1" class="btn btn-primary w-100">Beli</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary w-100">Login untuk Membeli</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Futsal Shoes Section -->
    <section class="mb-5">
        <h2 class="section-title">Sepatu Futsal</h2>
        <div class="row">
            <?php
            $brands = ['Nike', 'Adidas', 'Puma', 'Specs', 'Ortusheight'];
            $sizes = range(32, 45);
            
            foreach($brands as $brand): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="https://images.pexels.com/photos/1032110/pexels-photo-1032110.jpeg" class="card-img-top" alt="<?= $brand ?> Futsal Shoes">
                    <div class="card-body">
                        <h5 class="card-title"><?= $brand ?> Futsal Pro</h5>
                        <p class="card-text">Sepatu Futsal Professional</p>
                        <p class="card-text">
                            <small>Ukuran: <?= implode(', ', $sizes) ?></small>
                        </p>
                        <p class="card-text"><strong>Rp 1.200.000</strong></p>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="purchase.php?id=1" class="btn btn-primary w-100">Beli</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary w-100">Login untuk Membeli</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Futsal Socks Section -->
    <section class="mb-5">
        <h2 class="section-title">Kaos Kaki Futsal</h2>
        <div class="row">
            <?php for($i = 1; $i <= 10; $i++): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="https://images.pexels.com/photos/6823462/pexels-photo-6823462.jpeg" class="card-img-top" alt="Futsal Socks">
                    <div class="card-body">
                        <h5 class="card-title">Pro Futsal Socks <?= $i ?></h5>
                        <p class="card-text">Kaos Kaki Futsal Professional</p>
                        <p class="card-text"><strong>Rp 120.000</strong></p>
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

    <!-- Finger Tape Section -->
    <section class="mb-5">
        <h2 class="section-title">Finger Tape</h2>
        <div class="row">
            <?php for($i = 1; $i <= 10; $i++): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="https://images.pexels.com/photos/4397833/pexels-photo-4397833.jpeg" class="card-img-top" alt="Finger Tape">
                    <div class="card-body">
                        <h5 class="card-title">Sports Finger Tape <?= $i ?></h5>
                        <p class="card-text">Finger Tape untuk Perlindungan</p>
                        <p class="card-text"><strong>Rp 50.000</strong></p>
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

    <!-- Knee Pad Section -->
    <section class="mb-5">
        <h2 class="section-title">Knee Pad</h2>
        <div class="row">
            <?php for($i = 1; $i <= 5; $i++): ?>
            <div class="col-md-3 mb-4">
                <div class="card product-card">
                    <img src="https://images.pexels.com/photos/6823736/pexels-photo-6823736.jpeg" class="card-img-top" alt="Knee Pad">
                    <div class="card-body">
                        <h5 class="card-title">Pro Knee Pad <?= $i ?></h5>
                        <p class="card-text">Pelindung Lutut Professional</p>
                        <p class="card-text"><strong>Rp 180.000</strong></p>
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
</div>

<?php include 'includes/footer.php'; ?>
