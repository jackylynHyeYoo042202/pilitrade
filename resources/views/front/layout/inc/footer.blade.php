<footer class="section-t-space">
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                        <a href="/">
                                <img src="/images/site/{{ get_settings()->site_logo }}" class="blur-up lazyload" alt style="max-width: 300px; height: auto;">
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                                <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
    <div class="d-flex justify-content-end pt-3">
        <!-- Twitter -->
        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="{{ get_social_network()->twitter_url }}" target="_blank" title="Follow us on Twitter">
            <i class="fab fa-twitter"></i>
        </a>

        <!-- Facebook -->
        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="{{ get_social_network()->facebook_url }}" target="_blank" title="Like us on Facebook">
            <i class="fab fa-facebook-f"></i>
        </a>

        <!-- YouTube -->
        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="{{ get_social_network()->youtube_url }}" target="_blank" title="Subscribe to our YouTube channel">
            <i class="fab fa-youtube"></i>
        </a>

        <!-- LinkedIn -->
        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="{{ get_social_network()->linkedin_url }}" target="_blank" title="Connect with us on LinkedIn">
            <i class="fab fa-linkedin-in"></i>
        </a>

        <!-- Instagram -->
        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="{{ get_social_network()->instagram_url }}" target="_blank" title="Follow us on Instagram">
            <i class="fab fa-instagram"></i>
        </a>

        <!-- GitHub -->
        <a class="btn btn-outline-secondary btn-md-square rounded-circle" href="{{ get_social_network()->github_url }}" target="_blank" title="Check out our GitHub">
            <i class="fab fa-github"></i>
        </a>
    </div>
</div>

                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <p class="mb-4">{{ get_settings()->site_meta_description }}</p>

                        <ul class="address">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="http://maps.google.com/maps?q={{ urlencode(get_settings()->site_address) }}" target="_blank">{{ get_settings()->site_address }}</a>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ get_settings()->site_email }}">{{ get_settings()->site_email }}</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Quick Links</h4>
                            <a class="btn-link" href="">Shops</a>
                            <a class="btn-link" href="">About Us</a>
                            <a class="btn-link" href="">Blog</a>
                            <a class="btn-link" href="{{ route('contact') }}">Contact Us</a>
                            <a class="btn-link" href="{{ route('privacy.policy') }}">Privacy Policy</a>
                            <a class="btn-link" href="">Our Sitemap</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Help Center</h4>
                            <a class="btn-link" href="">Your Order</a>
                            <a class="btn-link" href="">Your Account</a>
                            <a class="btn-link" href="">Your Wishlist</a>
                            <a class="btn-link" href="">Search</a>
                            <a class="btn-link" href="">FAQ</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact Us</h4>
                    </div>
                    <div class="footer-contact">
                        <p>Do you have any questions or suggestions?</p>

                        <p><i class="fas fa-map-marker-alt"></i> Address: {{ get_settings()->site_address }}</p>
                        <p><i class="fas fa-envelope"></i> Email: {{ get_settings()->site_email }}</p>
                        <p><i class="fas fa-phone"></i> Phone: {{ get_settings()->site_phone }}</p>
                    </div>
                 </div>
            </div>
         </div>
     </div>
 </footer>