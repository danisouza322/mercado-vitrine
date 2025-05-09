<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Vitrine Online - Painel Administrativo</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="Vitrine Online com WhatsApp - Painel Administrativo" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="Vitrine Online - Painel Administrativo" />
        <meta property="og:type" content="website" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/admin/imgs/theme/favicon.svg') ?>" />
        <!-- Template CSS -->
        <script src="<?= base_url('assets/admin/js/vendors/color-modes.js') ?>"></script>
        <link href="<?= base_url('assets/admin/css/main.css?v=6.0') ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <main>
            <section class="content-main mt-80 mb-80">
                <?= $this->renderSection('content') ?>
            </section>
            <footer class="main-footer text-center">
                <p class="font-xs">
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; Vitrine Online com WhatsApp
                </p>
                <p class="font-xs mb-30">Todos os direitos reservados</p>
            </footer>
        </main>
        <script src="<?= base_url('assets/admin/js/vendors/jquery-3.6.0.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/js/vendors/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/js/vendors/jquery.fullscreen.min.js') ?>"></script>
        <!-- Main Script -->
        <script src="<?= base_url('assets/admin/js/main.js?v=6.0') ?>" type="text/javascript"></script>
    </body>
</html> 