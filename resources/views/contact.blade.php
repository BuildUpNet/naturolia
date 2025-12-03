@extends('layout.main')

@section('content')
   <section class="contact-hero d-flex align-items-center">
        <div class="container py-5">
            <h1 class="display-2 fw-bold" data-aos="fade-down" data-aos-duration="1000">
                Get In Touch
            </h1>
            <p class="lead mt-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                We'd love to hear from you! Reach out for wellness advice or support.
            </p>
        </div>
    </section>

    <section id="contact-info" class="py-5 bg-light">
        <div class="container">
            <div class="row text-center justify-content-center d-flex align-items-stretch">

                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="info-card h-100">
                        <i class="fa-solid fa-location-dot"></i>
                        <h5>Our Location</h5>
                        <p class="text-muted">406, 4th floor, San plaza building, Feroze Gandhi market , ludhiana. 141001</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                    <div class="info-card h-100">
                        <i class="fa-solid fa-phone"></i>
                        <h5>Call Us</h5>
                        <p class="text-muted">+91 97804-11123</p>
                        <p class="small text-muted">(Mon - Sat: 9am - 6pm IST)</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                    <div class="info-card h-100">
                        <i class="fa-solid fa-envelope"></i>
                        <h5>Email Support</h5>
                        <p class="text-muted">Naturoliapharma@gmail.com</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section id="contact-form-section" class="py-5">
        <div class="container py-5">
            <div class="row d-flex align-items-stretch">

                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                    <h2 class="section-title mb-4">Send Us a Message</h2>

                    <div class="form-map-wrapper">
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="formName" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" id="formName" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="formEmail" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="formEmail" required>
        </div>
    </div>
  <div class="row">
    <div class="col-md-6 mb-3">
        <label for="formMobile" class="form-label">Mobile Number</label>
        <input type="text" name="mobile" class="form-control" id="formMobile" placeholder="+91 98765-43210">
    </div>
    <div class="col-md-6 mb-3">
        <label for="formSubject" class="form-label">Subject</label>
        <input type="text" name="subject" class="form-control" id="formSubject">
    </div>
</div>

    <div class="mb-3">
        <label for="formMessage" class="form-label">Your Message</label>
        <textarea name="message" class="form-control" id="formMessage" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn custom-btn-primary custom-btn-submit">
        Send Message <i class="fa-solid fa-paper-plane ms-2"></i>
    </button>
</form>

                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="section-title mb-4">Find Us Here</h2>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.822839446549!2d77.3797699!3d28.6053303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cf8e815570d1d%3A0x868c68c378e9381c!2sNoida%20Sector%2062!5e0!3m2!1sen!2sin!4v1634288463872!5m2!1sen!2sin"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
