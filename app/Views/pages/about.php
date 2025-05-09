<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> About Us
        </div>
    </div>
</div>
<div class="page-content pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="row align-items-center mb-50">
                    <div class="col-lg-6">
                        <img src="<?= base_url('assets/imgs/page/about-1.png') ?>" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4" />
                    </div>
                    <div class="col-lg-6">
                        <div class="pl-25">
                            <h2 class="mb-30">Welcome to Nest</h2>
                            <p class="mb-25">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate id est laborum.</p>
                            <p class="mb-50">Ius ferri velit sanctus cu, sed at soleat accusata. Dictas prompta et Ut placerat legendos interpre.Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante Etiam sit amet orci eget. Quis commodo odio aenean sed adipiscing. Turpis massa tincidunt dui ut ornare lectus. Auctor elit sed vulputate mi sit amet. Commodo consequat. Duis aute irure dolor in reprehenderit in voluptate id est laborum.</p>
                            <div class="carausel-3-columns-cover position-relative">
                                <div id="carausel-3-columns-arrows"></div>
                                <div class="carausel-3-columns" id="carausel-3-columns">
                                    <img src="<?= base_url('assets/imgs/page/about-2.png') ?>" alt="" />
                                    <img src="<?= base_url('assets/imgs/page/about-3.png') ?>" alt="" />
                                    <img src="<?= base_url('assets/imgs/page/about-4.png') ?>" alt="" />
                                    <img src="<?= base_url('assets/imgs/page/about-2.png') ?>" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="text-center mb-50">
                    <h2 class="title style-3 mb-40">What We Provide?</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-24">
                            <div class="featured-card">
                                <img src="<?= base_url('assets/imgs/theme/icons/icon-1.svg') ?>" alt="" />
                                <h4>Best Prices & Offers</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-24">
                            <div class="featured-card">
                                <img src="<?= base_url('assets/imgs/theme/icons/icon-2.svg') ?>" alt="" />
                                <h4>Wide Assortment</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-24">
                            <div class="featured-card">
                                <img src="<?= base_url('assets/imgs/theme/icons/icon-3.svg') ?>" alt="" />
                                <h4>Free Delivery</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-24">
                            <div class="featured-card">
                                <img src="<?= base_url('assets/imgs/theme/icons/icon-4.svg') ?>" alt="" />
                                <h4>Easy Returns</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-24">
                            <div class="featured-card">
                                <img src="<?= base_url('assets/imgs/theme/icons/icon-5.svg') ?>" alt="" />
                                <h4>100% Satisfaction</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-24">
                            <div class="featured-card">
                                <img src="<?= base_url('assets/imgs/theme/icons/icon-6.svg') ?>" alt="" />
                                <h4>Great Daily Deal</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                                <a href="#">Read more</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 