<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?? 'Nest - eCommerce' ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="<?= $description ?? '' ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="<?= $title ?? 'Nest - eCommerce' ?>" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/imgs/theme/favicon.svg') ?>" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/plugins/animate.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css?v=6.0') ?>" />
    
    <?= $this->renderSection('styles') ?>
</head>

<body>
    <!-- Modals -->
    <?= $this->include('partials/modals') ?>
    
    <!-- Header -->
    <?= $this->include('partials/header') ?>
    
    <!-- Mobile Menu -->
    <?= $this->include('partials/mobile_menu') ?>
    
    <!-- Main Content -->
    <main class="main">
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Footer -->
    <?= $this->include('partials/footer') ?>
    
    <!-- Preloader -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="<?= base_url('assets/imgs/theme/loading.gif') ?>" alt="" />
                </div>
            </div>
        </div>
    </div> -->
    
    <!-- Vendor JS -->
    <script src="<?= base_url('assets/js/vendor/modernizr-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/jquery-migrate-3.3.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/slick.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.syotimer.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/waypoints.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/wow.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/magnific-popup.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/counterup.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.countdown.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/images-loaded.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/isotope.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/scrollup.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.vticker-min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.theia.sticky.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.elevatezoom.js') ?>"></script>
    
    <!-- Template JS -->
    <script src="<?= base_url('assets/js/main.js?v=6.0') ?>"></script>
    <script src="<?= base_url('assets/js/shop.js?v=6.0') ?>"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>

</html> 