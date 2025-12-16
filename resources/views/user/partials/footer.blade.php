<!-- Footer with Dark Theme -->
<style>
/* Footer Dark Theme Styling */
footer.footer-dark {
    background-color: #2d2d2d !important;
    color: #ffffff !important;
    padding: 60px 0 30px !important;
}

footer.footer-dark .widget-title {
    color: #ffffff !important;
    font-size: 18px !important;
    font-weight: 600 !important;
    margin-bottom: 20px !important;
}

footer.footer-dark .text-secondary,
footer.footer-dark p {
    color: #b0b0b0 !important;
    font-size: 14px !important;
    line-height: 1.6;
}

footer.footer-dark .nav-link {
    color: #b0b0b0 !important;
    padding: 0 !important;
    font-size: 14px !important;
    transition: color 0.3s ease;
    text-decoration: none;
}

footer.footer-dark .nav-link:hover {
    color: #ffffff !important;
}

footer.footer-dark .menu-item {
    margin-bottom: 12px !important;
}

footer.footer-dark .form-control {
    background-color: #ffffff !important;
    border: none !important;
    padding: 12px 16px !important;
    border-radius: 6px 0 0 6px !important;
    color: #2d2d2d !important;
}

footer.footer-dark .form-control::placeholder {
    color: #999999 !important;
}

footer.footer-dark .btn-primary {
    background-color: #007bff !important;
    border: none !important;
    padding: 12px 28px !important;
    border-radius: 0 6px 6px 0 !important;
    font-weight: 500 !important;
}

footer.footer-dark .btn-primary:hover {
    background-color: #0056b3 !important;
}

/* Social Media Icons - Hidden for now */
.social-icons {
    display: none;
}

#footer-bottom {
    background-color: #222 !important;
    border-top: 1px solid #404040 !important;
    padding: 20px 0 !important;
}

#footer-bottom p {
    color: #b0b0b0 !important;
    font-size: 13px !important;
    margin: 0 !important;
}
</style>

<footer class="footer-dark py-5">
    <div class="container-lg">
        <div class="row g-4">
            <!-- Column 1: Logo & Tagline -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-menu">
                    <img src="{{ asset('user/images/logom.png') }}" width="150" alt="logo" class="mb-3">
                    <p class="text-secondary">Sustainable solutions for a greener future</p>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Quick Links</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="{{ url('/about') }}" class="nav-link">Tentang Kami</a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('shop.index') }}" class="nav-link">Produk & Kategori</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Kontak Kami</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Column 3: Customer Service -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Customer Service</h5>
                    <ul class="menu-list list-unstyled">
                        <li class="menu-item">
                            <a href="#" class="nav-link">FAQ</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Informasi Pengiriman</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Kebijakan Pengembalian</a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="nav-link">Kebijakan Privasi</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Column 4: Newsletter -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-menu">
                    <h5 class="widget-title">Newsletter</h5>
                    <p class="text-secondary mb-3">Subscribe to get updates</p>
                    <form class="d-flex gap-0" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan!');">
                        <input class="form-control" type="email" name="email" placeholder="Your email" aria-label="Email Address" required>
                        <button class="btn btn-primary" type="submit">Subscribe</button>
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
            <div class="col-12 text-center">
                <p>&copy; 2024 ManfaatinOnline. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>