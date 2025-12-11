<footer class="py-5">
    <div class="container-lg">
        <div class="row">
            <!-- Logo & Social -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <img src="{{ asset('user/images/logom.png') }}" width="200" height="100" alt="logo">
                    <div class="social-links mt-3">
                        <ul class="d-flex list-unstyled gap-2">
                            <li>
                                <a href="{{ config('app.social.facebook') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16">
                                        <use xlink:href="#facebook"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('app.social.twitter') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16">
                                        <use xlink:href="#twitter"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('app.social.youtube') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16">
                                        <use xlink:href="#youtube"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('app.social.instagram') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16">
                                        <use xlink:href="#instagram"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('app.social.amazon') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16">
                                        <use xlink:href="#amazon"></use>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Organic Menu -->
            <div class="col-md-2 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Organic</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="{{ route('about') }}" class="nav-link">About us</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('conditions') }}" class="nav-link">Conditions</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('journals') }}" class="nav-link">Our Journals</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('careers') }}" class="nav-link">Careers</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('affiliate') }}" class="nav-link">Affiliate Programme</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('press') }}" class="nav-link">Ultras Press</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Quick Links</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="{{ route('offers') }}" class="nav-link">Offers</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('coupons') }}" class="nav-link">Discount Coupons</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('stores') }}" class="nav-link">Stores</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('track-order') }}" class="nav-link">Track Order</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('shop') }}" class="nav-link">Shop</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('info') }}" class="nav-link">Info</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Customer Service -->
            <div class="col-md-2 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Customer Service</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="{{ route('faq') }}" class="nav-link">FAQ</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('privacy') }}" class="nav-link">Privacy Policy</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('refunds') }}" class="nav-link">Returns & Refunds</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('cookies') }}" class="nav-link">Cookie Guidelines</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('delivery') }}" class="nav-link">Delivery Information</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Subscribe Us</h5>
                    <p>Subscribe to our newsletter to get updates about our grand offers.</p>
                    <form class="d-flex mt-3 gap-0" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input class="form-control rounded-start rounded-0 bg-light" type="email" name="email"
                            placeholder="Email Address" aria-label="Email Address" required>
                        <button class="btn btn-dark rounded-end rounded-0" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Footer Bottom -->
<div id="footer-bottom">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>&copy; {{ date('Y') }} Manfaatin. All rights reserved.</p>
            </div>
            <div class="col-md-6 credit-link text-start text-md-end">
                <!-- Add credit links if needed -->
            </div>
        </div>
    </div>
</div>