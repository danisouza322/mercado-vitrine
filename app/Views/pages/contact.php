<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Contact Us
        </div>
    </div>
</div>
<div class="page-content pt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <div class="row mb-60">
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h4 class="mb-15 text-brand">Office</h4>
                            205 North Michigan Avenue, Suite 810<br />
                            Chicago, 60601, USA<br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Email">Email: </abbr><a href="mailto:contact@Nest.com">contact@Nest.com</a>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <h4 class="mb-15 text-brand">Studio</h4>
                            205 North Michigan Avenue, Suite 810<br />
                            Chicago, 60601, USA<br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Email">Email: </abbr><a href="mailto:studio@Nest.com">studio@Nest.com</a>
                        </div>
                        <div class="col-md-4">
                            <h4 class="mb-15 text-brand">Shop</h4>
                            205 North Michigan Avenue, Suite 810<br />
                            Chicago, 60601, USA<br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Email">Email: </abbr><a href="mailto:shop@Nest.com">shop@Nest.com</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="contact-from-area padding-20-row-col">
                                <h5 class="text-brand mb-10">Contact form</h5>
                                <h2 class="mb-10">Drop Us a Line</h2>
                                <p class="text-muted mb-30 font-sm">Your email address will not be published. Required fields are marked *</p>
                                <form class="contact-form-style mt-30" id="contact-form" action="#" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="name" placeholder="First Name" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="email" placeholder="Your Email" type="email" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="telephone" placeholder="Your Phone" type="tel" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="subject" placeholder="Subject" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="textarea-style mb-30">
                                                <textarea name="message" placeholder="Message"></textarea>
                                            </div>
                                            <button class="submit submit-auto-width" type="submit">Send message</button>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                        <div class="col-lg-4 pl-50 d-lg-block d-none">
                            <img class="border-radius-15 mt-50" src="<?= base_url('assets/imgs/page/contact-2.png') ?>" alt="" />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 