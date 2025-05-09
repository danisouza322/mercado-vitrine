<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?? 'Nest Dashboard' ?></title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="<?= $description ?? '' ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="<?= $title ?? 'Nest Dashboard' ?>" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/admin/imgs/theme/favicon.svg') ?>" />
        <!-- Template CSS -->
        <script src="<?= base_url('assets/admin/js/vendors/color-modes.js') ?>"></script>
        <link href="<?= base_url('assets/admin/css/main.css?v=6.0') ?>" rel="stylesheet" type="text/css" />
        
        <?= $this->renderSection('styles') ?>
    </head>

    <body>
        <div class="screen-overlay"></div>
        
        <!-- Sidebar -->
        <?= $this->include('admin/partials/sidebar') ?>
        
        <main class="main-wrap">
            <!-- Header -->
            <?= $this->include('admin/partials/header') ?>
            
            <!-- Main Content -->
            <section class="content-main">
                <?= $this->renderSection('content') ?>
            </section>
            
            <!-- Footer -->
            <?= $this->include('admin/partials/footer') ?>
        </main>
        
        <!-- External JS Files -->
        <script src="<?= base_url('assets/admin/js/vendors/jquery-3.6.0.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/js/vendors/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/js/vendors/jquery.fullscreen.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/js/vendors/chart.js') ?>"></script>
        <!-- Main Script -->
        <script src="<?= base_url('assets/admin/js/main.js?v=6.0') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/admin/js/custom-chart.js') ?>" type="text/javascript"></script>
        
        <?= $this->renderSection('scripts') ?>
    </body>
</html> 