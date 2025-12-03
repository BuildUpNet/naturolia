@extends('layout.main')

@section('content')
<section class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card shadow-lg p-4 p-md-5 rounded-4" style="max-width: 480px; width: 100%;">
        <div class="text-center mb-4">
            <i class="fas fa-user-check fa-3x text-success mb-2"></i>
            <h2 class="fw-bold">Reactivate Your Account</h2>
            <p class="text-muted">Enter your password to reactivate your account. The link is valid for 10 minutes.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('account.reactivate.token.submit', ['token' => $token]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-success w-100 py-2">
                <i class="fas fa-user-check me-2"></i> Reactivate Account
            </button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none text-muted">&larr; Back to Login</a>
        </div>
    </div>
</section>
@endsection
