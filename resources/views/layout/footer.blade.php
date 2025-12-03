<style>
.whatsapp-float {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background-color: #25D366;
    color: #000;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px; /* Adjust icon size */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    z-index: 9999;
    transition: all 0.3s ease;
    text-decoration: none;
}

.whatsapp-float i {
    margin-top: 2px;
}

.whatsapp-float:hover {
    transform: scale(1.1);
    background-color: #1EBE5C;
}

</style>

<footer id="main-footer" class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <a class="navbar-brand mb-3 d-inline-block" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Naturolia Logo" class="footer-logo" style="height: 40px;" />
                </a>
                <p class="text-white-50 small">
                    Harnessing the power of nature for your health and well-being.
                </p>
                <div class="social-icons mt-3">
                    <a href="https://www.facebook.com/profile.php?id=61578373094242" class="footer-social-icon me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <!--<a href="#" class="footer-social-icon me-3"><i class="fab fa-twitter fa-lg"></i></a> -->
                    <a href="https://www.instagram.com/naturolia.official?igsh=MXRrZ3h2OTUwaW04Zw==" class="footer-social-icon"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h5 class="fw-bold mb-3 footer-heading">Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li>
                        <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-white-50 text-decoration-none">About Us</a>
                    </li>
                    <li>
                        <a href="{{ route('product') }}" class="text-white-50 text-decoration-none">Our Products</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">Contact Us</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h5 class="fw-bold mb-3 footer-heading">Legal & Help</h5>
                <ul class="list-unstyled footer-links">
                    <li>
                        <a href="{{ route('policy.cancellation') }}" class="text-white-50 text-decoration-none">
                            Cancellation Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('policy.returns') }}" class="text-white-50 text-decoration-none">
                            Returns & Replacement
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('policy.refunds') }}" class="text-white-50 text-decoration-none">
                            Refund Policy
                        </a>
                    </li>
                       <li>
                        <a href="{{ route('policy.shipping') }}" class="text-white-50 text-decoration-none">
                            Shipping Policy
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('policy.privacy') }}" class="text-white-50 text-decoration-none">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ route('policy.terms-condition') }}" class="text-white-50 text-decoration-none">Terms & Conditions</a>
                    </li>
                   
                    <li>
                        <a href="{{ route('policy.faq') }}" class="text-white-50 text-decoration-none">FAQ</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <h5 class="fw-bold mb-3 footer-heading">Get In Touch</h5>
                <p class="text-white-50 small mb-2">
                    <i class="fa-solid fa-location-dot me-2 text-success"></i>406, 4th Floor, San Plaza Building, Feroze Gandhi Market , Ludhiana. 141001
                </p>
                <p class="text-white-50 small mb-2">
                    <i class="fa-solid fa-phone me-2 text-success"></i>+91 97804-11123
                </p>
                <p class="text-white-50 small mb-2">
                    <i class="fa-solid fa-envelope me-2 text-success"></i>Naturoliapharma@gmail.com
                </p>
                <!--<a href="{{ route('contact') }}" class="btn custom-btn-secondary mt-3 btn-sm">Message Us</a>-->
            </div>
        </div>

        <div class="text-center pt-4 border-top border-secondary mt-4">
            <p class="mb-0 text-white-50 small">
                &copy; 2025 Naturolia. All Rights Reserved. Crafted with Nature. | 
                Designed by <a href="https://buildupnet.com/" target="_blank" class="text-white text-decoration-none small">Buildupnet</a>
            </p>
        </div>
    </div>
</footer>
<a href="https://wa.me/919780411123" 
   class="whatsapp-float" 
   target="_blank" 
   aria-label="Chat on WhatsApp">
   <i class="fab fa-whatsapp"></i>
</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

 <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>

    <!--<script src="{{ asset('js/main.js') }}"></script>-->

</body>

</html>
