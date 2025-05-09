<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> System Test
        </div>
    </div>
</div>
<div class="page-content pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <h1 class="mb-4">System Testing</h1>
                    <div class="card">
                        <div class="card-header">
                            <h5>Available Test Routes</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <a href="<?= base_url('test/layout') ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Layout Test</h5>
                                    </div>
                                    <p class="mb-1">Test the template system and layout components</p>
                                </a>
                                <a href="<?= base_url('test/database') ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Database Test</h5>
                                    </div>
                                    <p class="mb-1">Test database connection and configuration</p>
                                </a>
                                <a href="<?= base_url('test/session') ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Session Test</h5>
                                    </div>
                                    <p class="mb-1">Test session functionality</p>
                                </a>
                                <a href="<?= base_url('test/info') ?>" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">System Info</h5>
                                    </div>
                                    <p class="mb-1">Display system information</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Frontend Routes Test</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <a href="<?= base_url() ?>" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">Home Page</h5>
                                </a>
                                <a href="<?= base_url('about') ?>" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">About Page</h5>
                                </a>
                                <a href="<?= base_url('contact') ?>" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">Contact Page</h5>
                                </a>
                                <a href="<?= base_url('shop') ?>" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">Shop Page</h5>
                                </a>
                                <a href="<?= base_url('cart') ?>" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">Cart Page</h5>
                                </a>
                                <a href="<?= base_url('account') ?>" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">Account Page</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 