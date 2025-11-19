<footer class="py-5">
    <div class="container-lg">
        <div class="row">

            <!-- Logo & Social Media -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <img src="{{ asset('user/images/logo.svg') }}" width="240" height="70" alt="Manfaatin Logo">
                    <div class="social-links mt-3">
                        <ul class="d-flex list-unstyled gap-2">
                            <li>
                                <a href="{{ config('social.facebook') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16"><use xlink:href="#facebook"></use></svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('social.twitter') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16"><use xlink:href="#twitter"></use></svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('social.youtube') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16"><use xlink:href="#youtube"></use></svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ config('social.instagram') }}" class="btn btn-outline-light" target="_blank">
                                    <svg width="16" height="16"><use xlink:href="#instagram"></use></svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Company Links -->
            <div class="col-md-2 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Company</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="{{ route('user.about') }}" class="nav-link">About us</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.terms') }}" class="nav-link">Terms & Conditions</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.blog') }}" class="nav-link">Our Blog</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.careers') }}" class="nav-link">Careers</a>
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
                            <a href="{{ route('user.offers') }}" class="nav-link">Offers</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.coupons') }}" class="nav-link">Discount Coupons</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.stores') }}" class="nav-link">Stores</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.track-order') }}" class="nav-link">Track Order</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.shop') }}" class="nav-link">Shop</a>
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
                            <a href="{{ route('user.faq') }}" class="nav-link">FAQ</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.contact') }}" class="nav-link">Contact</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.privacy') }}" class="nav-link">Privacy Policy</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.returns') }}" class="nav-link">Returns & Refunds</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('user.delivery') }}" class="nav-link">Delivery Information</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Subscribe Us</h5>
                    <p>Subscribe to our newsletter to get updates about our grand offers.</p>
                    <form class="d-flex mt-3 gap-0" action="{{ route('user.newsletter.subscribe') }}" method="POST" id="newsletterForm">
                        @csrf
                        <input class="form-control rounded-start rounded-0 bg-light" type="email" name="email" placeholder="Email Address" aria-label="Email Address" required>
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
                <p>© {{ date('Y') }} Manfaatin. All rights reserved.</p>
            </div>
            <div class="col-md-6 credit-link text-start text-md-end">
                <p>Developed with ❤️ by <a href="https://manfaatin.com/">Manfaatin Team</a></p>
            </div>
        </div>
    </div>
</div>