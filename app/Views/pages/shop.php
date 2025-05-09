<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url() ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Shop
        </div>
    </div>
</div>
<div class="container mb-30 mt-30">
    <div class="row">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">688</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="<?= base_url('product/product-1') ?>">
                                    <img class="default-img" src="<?= base_url('assets/imgs/shop/product-1-1.jpg') ?>" alt="" />
                                    <img class="hover-img" src="<?= base_url('assets/imgs/shop/product-1-2.jpg') ?>" alt="" />
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Add To Wishlist" class="action-btn" href="<?= base_url('wishlist') ?>"><i class="fi-rs-heart"></i></a>
                                <a aria-label="Compare" class="action-btn" href="<?= base_url('compare') ?>"><i class="fi-rs-shuffle"></i></a>
                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="hot">Hot</span>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="<?= base_url('shop') ?>">Snack</a>
                            </div>
                            <h2><a href="<?= base_url('product/seeds-of-change-organic') ?>">Seeds of Change Organic Quinoa, Brown, & Red Rice</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="<?= base_url('vendor/details/1') ?>">NestFood</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$28.85</span>
                                    <span class="old-price">$32.8</span>
                                </div>
                                <div class="add-cart">
                                    <a class="add" href="<?= base_url('cart') ?>"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end product card-->
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="<?= base_url('product/product-2') ?>">
                                    <img class="default-img" src="<?= base_url('assets/imgs/shop/product-2-1.jpg') ?>" alt="" />
                                    <img class="hover-img" src="<?= base_url('assets/imgs/shop/product-2-2.jpg') ?>" alt="" />
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Add To Wishlist" class="action-btn" href="<?= base_url('wishlist') ?>"><i class="fi-rs-heart"></i></a>
                                <a aria-label="Compare" class="action-btn" href="<?= base_url('compare') ?>"><i class="fi-rs-shuffle"></i></a>
                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="sale">Sale</span>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="<?= base_url('shop') ?>">Hodo Foods</a>
                            </div>
                            <h2><a href="<?= base_url('product/all-natural-italian-style') ?>">All Natural Italian-Style Chicken Meatballs</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 80%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (3.5)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="<?= base_url('vendor/details/1') ?>">Stouffer</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$52.85</span>
                                    <span class="old-price">$55.8</span>
                                </div>
                                <div class="add-cart">
                                    <a class="add" href="<?= base_url('cart') ?>"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end product card-->
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="<?= base_url('product/product-3') ?>">
                                    <img class="default-img" src="<?= base_url('assets/imgs/shop/product-3-1.jpg') ?>" alt="" />
                                    <img class="hover-img" src="<?= base_url('assets/imgs/shop/product-3-2.jpg') ?>" alt="" />
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Add To Wishlist" class="action-btn" href="<?= base_url('wishlist') ?>"><i class="fi-rs-heart"></i></a>
                                <a aria-label="Compare" class="action-btn" href="<?= base_url('compare') ?>"><i class="fi-rs-shuffle"></i></a>
                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="new">New</span>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="<?= base_url('shop') ?>">Snack</a>
                            </div>
                            <h2><a href="<?= base_url('product/angie-boomchickapop') ?>">Angie's Boomchickapop Sweet & Salty Kettle Corn</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 85%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="<?= base_url('vendor/details/1') ?>">StarKist</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$48.85</span>
                                    <span class="old-price">$52.8</span>
                                </div>
                                <div class="add-cart">
                                    <a class="add" href="<?= base_url('cart') ?>"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end product card-->
            </div>
            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>
                    <li>
                        <a href="<?= base_url('shop') ?>"> <img src="<?= base_url('assets/imgs/theme/icons/category-1.svg') ?>" alt="" />Milks & Dairies</a><span class="count">30</span>
                    </li>
                    <li>
                        <a href="<?= base_url('shop') ?>"> <img src="<?= base_url('assets/imgs/theme/icons/category-2.svg') ?>" alt="" />Clothing</a><span class="count">35</span>
                    </li>
                    <li>
                        <a href="<?= base_url('shop') ?>"> <img src="<?= base_url('assets/imgs/theme/icons/category-3.svg') ?>" alt="" />Pet Foods </a><span class="count">42</span>
                    </li>
                    <li>
                        <a href="<?= base_url('shop') ?>"> <img src="<?= base_url('assets/imgs/theme/icons/category-4.svg') ?>" alt="" />Baking material</a><span class="count">68</span>
                    </li>
                    <li>
                        <a href="<?= base_url('shop') ?>"> <img src="<?= base_url('assets/imgs/theme/icons/category-5.svg') ?>" alt="" />Fresh Fruit</a><span class="count">87</span>
                    </li>
                </ul>
            </div>
            <!-- Filter By Price -->
            <div class="sidebar-widget price_range range mb-30">
                <h5 class="section-title style-1 mb-30">Fill by price</h5>
                <div class="price-filter">
                    <div class="price-filter-inner">
                        <div id="slider-range" class="mb-20"></div>
                        <div class="d-flex justify-content-between">
                            <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                            <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('shop') ?>" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Filter</a>
            </div>
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="<?= base_url('assets/imgs/shop/thumbnail-3.jpg') ?>" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h5><a href="<?= base_url('product/product-1') ?>">Chen Cardigan</a></h5>
                        <p class="price mb-0 mt-5">$99.50</p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="<?= base_url('assets/imgs/shop/thumbnail-4.jpg') ?>" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h6><a href="<?= base_url('product/product-2') ?>">Chen Sweater</a></h6>
                        <p class="price mb-0 mt-5">$89.50</p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="<?= base_url('assets/imgs/shop/thumbnail-5.jpg') ?>" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h6><a href="<?= base_url('product/product-3') ?>">Colorful Jacket</a></h6>
                        <p class="price mb-0 mt-5">$25</p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
</rewritten_file>