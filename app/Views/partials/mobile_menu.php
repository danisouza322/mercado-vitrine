<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="<?= base_url() ?>"><img src="<?= base_url('assets/imgs/theme/logo.svg') ?>" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="<?= base_url('search') ?>">
                    <input type="text" name="q" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="<?= base_url() ?>">Home</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= base_url('shop') ?>">Shop</a>
                            <ul class="dropdown">
                                <li><a href="<?= base_url('shop') ?>">Shop Grid – Right Sidebar</a></li>
                                <li><a href="<?= base_url('shop/grid-left') ?>">Shop Grid – Left Sidebar</a></li>
                                <li><a href="<?= base_url('shop/list-right') ?>">Shop List – Right Sidebar</a></li>
                                <li><a href="<?= base_url('shop/list-left') ?>">Shop List – Left Sidebar</a></li>
                                <li><a href="<?= base_url('shop/fullwidth') ?>">Shop - Wide</a></li>
                                <li class="menu-item-has-children">
                                    <a href="#">Single Product</a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url('product/view/right') ?>">Product – Right Sidebar</a></li>
                                        <li><a href="<?= base_url('product/view/left') ?>">Product – Left Sidebar</a></li>
                                        <li><a href="<?= base_url('product/view/full') ?>">Product – No sidebar</a></li>
                                        <li><a href="<?= base_url('product/view/vendor') ?>">Product – Vendor Info</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url('shop/filter') ?>">Shop – Filter</a></li>
                                <li><a href="<?= base_url('wishlist') ?>">Shop – Wishlist</a></li>
                                <li><a href="<?= base_url('cart') ?>">Shop – Cart</a></li>
                                <li><a href="<?= base_url('checkout') ?>">Shop – Checkout</a></li>
                                <li><a href="<?= base_url('compare') ?>">Shop – Compare</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= base_url('vendors') ?>">Vendors</a>
                            <ul class="dropdown">
                                <li><a href="<?= base_url('vendors/grid') ?>">Vendors Grid</a></li>
                                <li><a href="<?= base_url('vendors/list') ?>">Vendors List</a></li>
                                <li><a href="<?= base_url('vendor/details/1') ?>">Vendor Details 01</a></li>
                                <li><a href="<?= base_url('vendor/details/2') ?>">Vendor Details 02</a></li>
                                <li><a href="<?= base_url('vendor/dashboard') ?>">Vendor Dashboard</a></li>
                                <li><a href="<?= base_url('vendor/guide') ?>">Vendor Guide</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="<?= base_url('blog') ?>">Blog</a>
                            <ul class="dropdown">
                                <li><a href="<?= base_url('blog/category/grid') ?>">Blog Category Grid</a></li>
                                <li><a href="<?= base_url('blog/category/list') ?>">Blog Category List</a></li>
                                <li><a href="<?= base_url('blog/category/big') ?>">Blog Category Big</a></li>
                                <li><a href="<?= base_url('blog/category/fullwidth') ?>">Blog Category Wide</a></li>
                                <li class="menu-item-has-children">
                                    <a href="#">Single Post</a>
                                    <ul class="dropdown">
                                        <li><a href="<?= base_url('blog/post/left') ?>">Left Sidebar</a></li>
                                        <li><a href="<?= base_url('blog/post/right') ?>">Right Sidebar</a></li>
                                        <li><a href="<?= base_url('blog/post/fullwidth') ?>">No Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="<?= base_url('about') ?>">About Us</a></li>
                                <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                                <li><a href="<?= base_url('account') ?>">My Account</a></li>
                                <li><a href="<?= base_url('login') ?>">Login</a></li>
                                <li><a href="<?= base_url('register') ?>">Register</a></li>
                                <li><a href="<?= base_url('forgot-password') ?>">Forgot password</a></li>
                                <li><a href="<?= base_url('reset-password') ?>">Reset password</a></li>
                                <li><a href="<?= base_url('purchase-guide') ?>">Purchase Guide</a></li>
                                <li><a href="<?= base_url('privacy-policy') ?>">Privacy Policy</a></li>
                                <li><a href="<?= base_url('terms') ?>">Terms of Service</a></li>
                                <li><a href="<?= base_url('404') ?>">404 Page</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Language</a>
                            <ul class="dropdown">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="<?= base_url('contact') ?>"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="<?= base_url('login') ?>"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="tel:+01234567890"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="<?= base_url('assets/imgs/theme/icons/icon-facebook-white.svg') ?>" alt="" /></a>
                <a href="#"><img src="<?= base_url('assets/imgs/theme/icons/icon-twitter-white.svg') ?>" alt="" /></a>
                <a href="#"><img src="<?= base_url('assets/imgs/theme/icons/icon-instagram-white.svg') ?>" alt="" /></a>
                <a href="#"><img src="<?= base_url('assets/imgs/theme/icons/icon-pinterest-white.svg') ?>" alt="" /></a>
                <a href="#"><img src="<?= base_url('assets/imgs/theme/icons/icon-youtube-white.svg') ?>" alt="" /></a>
            </div>
            <div class="site-copyright">Copyright <?= date('Y') ?> © Nest. All rights reserved. Powered by AliThemes.</div>
        </div>
    </div>
</div> 