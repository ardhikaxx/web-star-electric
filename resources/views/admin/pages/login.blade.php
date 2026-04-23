@extends('admin.layouts.auth')

@section('title', 'Login Pengguna')

@section('content')
    <div class="login-bg"></div>

    <div class="login-page">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('assets/logo-auth.png') }}" alt="STAR">
                </div>
                <h2>Login Pengguna</h2>
                <p>Masuk dengan username dan PIN 4 digit. Admin diarahkan ke panel admin, karyawan diarahkan ke panel karyawan.</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST" id="pinForm">
                @csrf

                <div class="mb-4">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-control form-control-lg @error('username') is-invalid @enderror"
                        placeholder="Masukkan username"
                        required
                    >
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <label class="form-label fw-semibold d-block text-center">PIN 4 Digit</label>
                <div class="pin-input">
                    <input type="password" name="pin1" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric">
                    <input type="password" name="pin2" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric">
                    <input type="password" name="pin3" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric">
                    <input type="password" name="pin4" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric">
                </div>
                <input type="hidden" name="pin" id="fullPin">
                @error('pin')
                    <div class="text-danger small text-center mb-3">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold">
                    <i class="fa-solid fa-sign-in-alt me-2"></i>
                    Masuk
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('pin.forgot') }}" class="text-decoration-none" style="color: #6c757d; font-size: 0.85rem;">
                        Lupa PIN?
                    </a>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-decoration-none" style="color: #6c757d; font-size: 0.85rem;">
                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Kembali ke Landing Page
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const pinInputs = document.querySelectorAll('.pin-digit');
                const pinForm = document.getElementById('pinForm');
                const fullPin = document.getElementById('fullPin');

                pinInputs.forEach((input, index) => {
                    input.addEventListener('input', function(e) {
                        e.target.value = e.target.value.replace(/\D/g, '');

                        if (e.target.value.length === 1 && index < pinInputs.length - 1) {
                            pinInputs[index + 1].focus();
                        }
                    });

                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && e.target.value.length === 0 && index > 0) {
                            pinInputs[index - 1].focus();
                        }
                    });

                    input.addEventListener('paste', function(e) {
                        e.preventDefault();
                        const digits = e.clipboardData.getData('text').replace(/\D/g, '').split('').slice(0, 4);

                        digits.forEach((digit, i) => {
                            if (pinInputs[i]) {
                                pinInputs[i].value = digit;
                            }
                        });

                        refreshPin();
                    });
                });

                const refreshPin = function() {
                    fullPin.value = Array.from(pinInputs).map(input => input.value).join('');
                };

                pinForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    refreshPin();

                    if (fullPin.value.length !== 4) {
                        pinInputs.forEach(input => input.classList.add('error'));
                        setTimeout(() => pinInputs.forEach(input => input.classList.remove('error')), 500);
                        return;
                    }

                    this.submit();
                });
            });
        </script>
    @endpush
@endsection
