<footer class="py-5">
    <div class="container-lg">
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <img src="{{ asset('user/images/logom.png') }}" width="120" alt="logo">
                    <div class="social-links mt-3">
                        <ul class="d-flex list-unstyled gap-2">
                            <li><a href="#" class="btn btn-outline-light">
                                <svg width="16" height="16"><use xlink:href="#facebook"></use></svg>
                            </a></li>
                            <li><a href="#" class="btn btn-outline-light">
                                <svg width="16" height="16"><use xlink:href="#twitter"></use></svg>
                            </a></li>
                            <li><a href="#" class="btn btn-outline-light">
                                <svg width="16" height="16"><use xlink:href="#instagram"></use></svg>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Quick Links</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item"><a href="{{ route('about') }}" class="nav-link">About us</a></li>
                        <li class="menu-item"><a href="{{ route('shop') }}" class="nav-link">Shop</a></li>
                        <li class="menu-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                        <li class="menu-item"><a href="{{ route('faq') }}" class="nav-link">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Subscribe Us</h5>
                    <p>Subscribe to our newsletter</p>
                    <form action="{{ route('subscribe') }}" method="POST" class="d-flex mt-3 gap-0">
                        @csrf
                        <input class="form-control rounded-start rounded-0 bg-light" type="email" name="email" placeholder="Email" required>
                        <button class="btn btn-dark rounded-end rounded-0" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</footer>

<div id="footer-bottom">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>© {{ date('Y') }} Manfaatin. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>