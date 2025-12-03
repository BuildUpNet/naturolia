 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
     <meta http-equiv="Pragma" content="no-cache" />
     <meta http-equiv="Expires" content="0" />
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Naturolia - Organic Wellness</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
     <!--<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
     <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<style>.toggle-password {
  cursor: pointer;
  user-select: none;
  font-size: 1.1rem;
}
</style>
 </head>

 <body data-bs-spy="scroll" data-bs-target="#main-navbar" data-bs-offset="50">
     <header class="fixed-top" id="main-header">
         <nav class="navbar navbar-expand-lg py-3" id="main-navbar">
             <div class="container">
                 <a class="navbar-brand" href="{{ route('home') }}">
                     <img src="{{ asset('assets/images/logo.png') }}" alt="Naturolia Logo" class="header-logo" />
                 </a>

                 <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas"
                     data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                     <i class="fa-solid fa-bars text-white"></i>
                 </button>

                 <div class="d-none d-lg-flex w-100 justify-content-between align-items-center">
                     <ul class="navbar-nav mx-auto">
                         <li class="nav-item">
                             <a class="nav-link custom-hover-line" href="{{ route('home') }}">Home</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link custom-hover-line" href="{{ route('about') }}">About</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link custom-hover-line" href="{{ route('product') }}">Product</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link custom-hover-line" href="{{ route('contact') }}">Contact Us</a>
                         </li>
                     </ul>

                     <div class="d-flex ms-auto align-items-center">
                         @php
                             use Illuminate\Support\Facades\Auth;
                         @endphp

                         @auth
                             @if (Auth::user()->role == 'user')
                                 <!-- Cart Button -->
                                 <a href="{{ route('cart.view') }}" class="nav-link text-white me-3" title="View Cart">
                                     <i class="bi bi-cart3 fs-5"></i>
                                 </a>

                                 <!-- Profile / Dashboard -->
                                 <a href="{{ route('profile.show') }}" class="nav-link text-white me-3"
                                     title="My Account / Dashboard">
                                     <i class="bi bi-person-circle fs-5"></i>
                                 </a>
                             @endif

                             <!-- Logout -->
                             <form action="{{ route('logout') }}" method="POST" class="d-inline me-3">
                                 @csrf
                                 <button type="submit" class="btn text-white" title="Logout">
                                     <i class="bi bi-box-arrow-right fs-5"></i>
                                 </button>
                             </form>
                         @else
                             <a href="{{ route('cart.view') }}" class="nav-link text-white me-3" title="View Cart">
                                 <i class="bi bi-cart3 fs-5"></i>
                             </a>
                             <a href="#" class="nav-link text-white me-3" data-bs-toggle="modal"
                                 data-bs-target="#loginModal" title="Login/Register">
                                 <i class="bi bi-person-circle fs-5"></i>
                             </a>
                         @endauth
                     </div>

                 </div>
             </div>
             </div>
         </nav>


         <div class="offcanvas offcanvas-end custom-offcanvas" tabindex="-1" id="offcanvasRight"
             aria-labelledby="offcanvasRightLabel">
             <div class="offcanvas-header justify-content-center pt-4 pb-0">
                 <a class="navbar-brand" href="#home">
                     <img src="{{ asset('assets/images/logo.png') }}" alt="Naturolia Logo" class="header-logo"
                         style="height: 45px" />
                 </a>
             </div>
             <div class="offcanvas-body d-flex flex-column">
                 <ul class="navbar-nav offcanvas-nav mx-auto text-center w-100">
                     <li class="nav-item">
                         <a class="nav-link custom-hover-line" href="{{ route('home') }}">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link custom-hover-line" href="{{ route('about') }}">About</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link custom-hover-line" href="{{ route('product') }}">Product</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link custom-hover-line" href="{{ route('contact') }}">Contact Us</a>
                     </li>
                 </ul>

                 <div class="d-flex justify-content-center py-3">

                     <!--<a href="#" class="nav-link text-dark mx-3" title="Add to Cart"><i-->
                     <!--        class="bi bi-cart3 fs-4"></i></a>-->


                     <!--<a href="#" class="nav-link text-dark mx-3" data-bs-toggle="modal" data-bs-target="#loginModal" title="Login"><i-->
                     <!--        class="bi bi-person-circle fs-4"></i></a>-->

                     @auth
                         @if (Auth::user()->role == 'user')
                             <a href="{{ route('cart.view') }}" class="nav-link text-dark mx-3" title="View Cart">
                                 <i class="bi bi-cart3 fs-4"></i>
                             </a>

                             <a href="{{ route('profile.show') }}" class="nav-link text-white me-3"
                                 title="My Account/Dashboard">
                                 <i class="bi bi-person-circle fs-4"></i>
                             </a>
                         @endif

                         <form action="{{ route('logout') }}" method="POST" class="d-inline me-3">
                             @csrf
                             <button type="submit" class="btn text-white" title="Logout">
                                 <i class="bi bi-box-arrow-right fs-4"></i>
                             </button>
                         </form>
                     @else
                         <a href="{{ route('cart.view') }}" class="nav-link text-white me-3" data-bs-toggle="modal"
                             data-bs-target="#loginModal" title="View Cart">
                             <i class="bi bi-cart3 fs-4"></i>
                         </a>

                         <a href="#" class="nav-link text-white me-3" data-bs-toggle="modal"
                             data-bs-target="#loginModal" title="Login/Register">
                             <i class="bi bi-person-circle fs-4"></i>
                         </a>
                     @endauth
                 </div>

                 <div class="mt-auto text-center border-top pt-4">
                     <p class="mb-2">Follow Us:</p>
                     <div class="social-icons mb-3">
                         <a href="#" class="text-dark mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                         <a href="#" class="text-dark mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                         <a href="#" class="text-dark mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                     </div>

                     <p class="small text-muted mb-1">Email: Naturoliapharma@gmail.com</p>
                     <p class="small text-muted mb-3">
                         Cabin no 406, 4th floor, San plaza building, Feroze Gandhi market , ludhiana. 141001
                     </p>

                     <button type="button" class="btn-close text-reset mt-2" data-bs-dismiss="offcanvas"
                         aria-label="Close"></button>
                 </div>
             </div>
         </div>
     </header>


     <!-- Hero Start -->{{-- Login Modal --}}


     <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <form method="POST" action="{{ route('login') }}" class="modal-content custom-modal-content">
                 @csrf
                 <div class="modal-header custom-modal-header">
                     <h5 class="modal-title text-green fw-bold" id="loginModalLabel">Welcome To NATUROLIA!</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body">
                     @if ($errors->has('email'))
                         <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                     @endif

                     <div class="mb-3">
                         <label for="loginEmail" class="form-label">Email address</label>
                         <input type="email" name="email" class="form-control" id="loginEmail"
                             autocomplete="off" required>
                     </div>
                   <div class="mb-2 position-relative">
    <label for="loginPassword" class="form-label">Password</label>
    <input type="password" name="password" class="form-control pe-5" id="loginPassword" required>
    <i class="bi bi-eye-slash toggle-password position-absolute end-0 top-50 translate-middle-y me-3 text-secondary"
       data-target="#loginPassword" style="cursor: pointer;"></i>
</div>


                     <div class="d-flex justify-content-end mb-3">

                         <a href="#" class="small text-green text-decoration-none fw-bold"
                             data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                             Forgot Password?
                         </a>

                     </div>
                     <button type="submit" class="btn custom-btn-primary w-100 mb-3">Login</button>

                     <div class="text-center mt-3">
                         <p class="mb-0 small text-muted">Don't have an account?
                             <a href="#" class="fw-bold text-green text-decoration-none" data-bs-toggle="modal"
                                 data-bs-target="#registerModal" data-bs-dismiss="modal">
                                 Register now
                             </a>
                         </p>
                     </div>
                 </div>
             </form>
         </div>
     </div>


     {{-- Register Modal --}}
     <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <form method="POST" action="{{ route('register') }}" class="modal-content custom-modal-content">
                 @csrf
                 <div class="modal-header custom-modal-header">
                     <h5 class="modal-title text-green fw-bold" id="registerModalLabel">Join NATUROLIA!</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body">
                     @if ($errors->any())
                         <div class="alert alert-danger">
                             <ul class="mb-0">
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
                         </div>
                     @endif

                     <div class="mb-3">
                         <label for="registerName" class="form-label">Full Name</label>
                         <input type="text" name="name" class="form-control" autocomplete="off"
                             id="registerName" required>
                     </div>
                     <div class="mb-3">
                         <label for="registerEmail" class="form-label">Email address</label>
                         <input type="email" name="email" class="form-control" autocomplete="off"
                             id="registerEmail" required>
                     </div>
                        <!-- Password Field -->
                <div class="mb-3 position-relative">
                    <label for="registerPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control pe-5" autocomplete="off"
                        id="registerPassword" required>
                    <i class="bi bi-eye-slash toggle-password position-absolute end-0 top-50 translate-middle-y me-3 text-secondary"
                        data-target="#registerPassword" style="cursor: pointer;"></i>
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-3 position-relative">
                    <label for="registerPasswordConfirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" autocomplete="off"
                        class="form-control pe-5" id="registerPasswordConfirmation" required>
                    <i class="bi bi-eye-slash toggle-password position-absolute end-0 top-50 translate-middle-y me-3 text-secondary"
                        data-target="#registerPasswordConfirmation" style="cursor: pointer;"></i>
                </div>
                     <button type="submit" class="btn custom-btn-primary w-100 mb-3 mt-2">Register</button>

                     <div class="text-center mt-3">
                         <p class="mb-0 small text-muted">Already have an account?
                             <a href="#" class="fw-bold text-green text-decoration-none" data-bs-toggle="modal"
                                 data-bs-target="#loginModal" data-bs-dismiss="modal">
                                 Login here
                             </a>
                         </p>
                     </div>
                 </div>
             </form>
         </div>
     </div>


     <!-- Forgot Password Modal -->
     <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <form method="POST" action="{{ route('password.send.otp') }}"
                 class="modal-content custom-modal-content" id="forgotPasswordForm">
                 @csrf
                 <div class="modal-header custom-modal-header">
                     <h5 class="modal-title text-green fw-bold" id="forgotPasswordModalLabel">Reset Your Password</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body">
                     <!-- OTP Step (Email Input) -->
                     <p class="small text-muted mb-3" id="emailStepText">Enter your email address below, and we will
                         send you a link to reset your password.</p>
                     <div class="mb-3" id="emailInput">
                         <label for="forgotEmail" class="form-label">Email address</label>
                         <input type="email" name="email" class="form-control" id="forgotEmail" required>
                     </div>
                     <button type="submit" class="btn custom-btn-primary w-100 mb-3 mt-3" id="sendOtpButton">Send
                         OTP</button>
                     <!-- Loader -->
                     <div id="otpLoader" class="d-none text-center my-2">
                         <div class="spinner-border text-green" role="status">
                             <span class="visually-hidden">Loading...</span>
                         </div>
                         <p class="small text-muted mt-2">Sending OTP, please wait...</p>
                     </div>
                     <div id="otpInput" class="d-none">
                         <p class="small text-muted mb-3">Enter the OTP sent to your email address.</p>
                         <div class="mb-3">
                             <label for="otp" class="form-label">OTP</label>
                             <input type="text" name="otp" class="form-control" id="otp" required>
                         </div>
                         <button type="submit" class="btn custom-btn-primary w-100 mb-3 mt-3"
                             id="verifyOtpButton">Verify OTP</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             @if (session('success'))
                 Swal.fire({
                     icon: 'success',
                     title: 'Success!',
                     text: "{{ session('success') }}",
                     timer: 3000,
                     timerProgressBar: true,
                     showConfirmButton: false
                 });
             @endif

             @if (session('error'))
                 Swal.fire({
                     icon: 'error',
                     title: 'Oops!',
                     text: "{{ session('error') }}",
                     timer: 4000,
                     timerProgressBar: true,
                     showConfirmButton: false
                 });
             @endif

             @if ($errors->any())
                 let errorMessages = '';
                 @foreach ($errors->all() as $error)
                     errorMessages += `{{ $error }}<br>`;
                 @endforeach

                 Swal.fire({
                     icon: 'error',
                     title: 'Validation Error',
                     html: errorMessages,
                     timer: 5000,
                     timerProgressBar: true,
                     showConfirmButton: false
                 });
             @endif
         });
     </script>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const forgotPasswordForm = document.getElementById('forgotPasswordForm');
             const sendOtpButton = document.getElementById('sendOtpButton');
             const verifyOtpButton = document.getElementById('verifyOtpButton');
             const emailStepText = document.getElementById('emailStepText');
             const emailInput = document.getElementById('emailInput');
             const otpInput = document.getElementById('otpInput');
             const otpField = document.getElementById('otp');
             const otpLoader = document.getElementById('otpLoader');
             // --- SEND OTP ---
             sendOtpButton.addEventListener('click', function(e) {
                 e.preventDefault();


                 otpField.removeAttribute('required');

                 const formData = new FormData(forgotPasswordForm);
                 otpLoader.classList.remove('d-none');
                 fetch("{{ route('password.send.otp') }}", {
                         method: 'POST',
                         headers: {
                             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                 .getAttribute('content')
                         },
                         body: formData
                     })
                     .then(response => response.json())

                     .then(data => {
                         otpLoader.classList.add('d-none');
                         if (data.success) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'OTP Sent!',
                                 text: data.message,
                                 timer: 2000,
                                 showConfirmButton: false
                             });


                             emailInput.classList.add('d-none');
                             emailStepText.classList.add('d-none');
                             otpInput.classList.remove('d-none');
                             sendOtpButton.classList.add('d-none');
                             verifyOtpButton.classList.remove('d-none');
                             otpField.setAttribute('required', 'required'); // enable validation now
                         } else {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Error',
                                 text: data.message || 'Failed to send OTP.'
                             });
                         }
                     })
                     .catch(error => {
                         otpLoader.classList.add('d-none');
                         console.error('Error:', error);
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: 'An unexpected error occurred.'
                         });
                     });
             });

             // --- VERIFY OTP ---
             verifyOtpButton.addEventListener('click', function(e) {
                 e.preventDefault();

                 const formData = new FormData(forgotPasswordForm);

                 fetch("{{ route('password.verify.otp') }}", {
                         method: 'POST',
                         headers: {
                             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                 .getAttribute('content')
                         },
                         body: formData
                     })
                     .then(response => response.json())
                     .then(data => {
                         if (data.success && data.otp_verified) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'OTP Verified!',
                                 text: 'Please enter your new password.',
                                 timer: 1500,
                                 showConfirmButton: false
                             });

                             // Replace form body with reset password inputs
                             const modalBody = forgotPasswordForm.querySelector('.modal-body');
                             modalBody.innerHTML = `
                    <p class="small text-muted mb-3">Enter your new password below.</p>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn custom-btn-primary w-100 mb-3 mt-3" id="resetPasswordButton">Reset Password</button>
                `;

                             // --- Reset password submission ---
                             const resetBtn = document.getElementById('resetPasswordButton');
                             resetBtn.addEventListener('click', function(ev) {
                                 ev.preventDefault();

                                 const resetData = new FormData(forgotPasswordForm);

                                 fetch("{{ route('password.reset') }}", {
                                         method: 'POST',
                                         headers: {
                                             'X-CSRF-TOKEN': document.querySelector(
                                                 'meta[name="csrf-token"]').getAttribute(
                                                 'content')
                                         },
                                         body: resetData
                                     })
                                     .then(response => response.json())
                                     .then(resp => {
                                         if (resp.success) {
                                             Swal.fire({
                                                 icon: 'success',
                                                 title: 'Password Reset Successful!',
                                                 text: 'You can now login with your new password.',
                                                 timer: 2000,
                                                 showConfirmButton: false
                                             });
                                             setTimeout(() => {
                                                 window.location.reload();
                                             }, 2000);
                                         } else {
                                             Swal.fire({
                                                 icon: 'error',
                                                 title: 'Failed',
                                                 text: resp.message ||
                                                     'Could not reset password.'
                                             });
                                         }
                                     });
                             });
                         } else {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Invalid OTP',
                                 text: data.message || 'Please enter the correct OTP.'
                             });
                         }
                     })
                     .catch(error => {
                         console.error('Error:', error);
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: 'An unexpected error occurred while verifying OTP.'
                         });
                     });
             });
         });
     </script>
        <script>
document.addEventListener('DOMContentLoaded', function() {
  
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const input = document.querySelector(this.getAttribute('data-target'));
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    });
});
</script>
