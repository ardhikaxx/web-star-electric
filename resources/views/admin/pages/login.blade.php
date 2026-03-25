@extends('admin.layouts.master')

@section('title', 'Login Admin')

@push('styles')
<style>
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .login-bg {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        z-index: -1;
    }

    .login-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(230, 32, 38, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(230, 32, 38, 0.05) 0%, transparent 50%);
    }
</style>
@endpush

@section('content')
<div class="login-bg"></div>

<div class="login-page">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h2>ADMIN</h2>
            <p>Masukkan PIN 4 digit untuk masuk</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center mb-3">
                <i class="fa-solid fa-circle-exclamation me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" id="pinForm">
            @csrf
            <div class="pin-input">
                <input type="password" name="pin1" maxlength="1" class="pin-digit" autocomplete="off">
                <input type="password" name="pin2" maxlength="1" class="pin-digit" autocomplete="off">
                <input type="password" name="pin3" maxlength="1" class="pin-digit" autocomplete="off">
                <input type="password" name="pin4" maxlength="1" class="pin-digit" autocomplete="off">
            </div>
            <input type="hidden" name="pin" id="fullPin">
            
            <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold">
                <i class="fa-solid fa-sign-in-alt me-2"></i>
                Masuk
            </button>
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
                if (e.target.value.length === 1) {
                    if (index < pinInputs.length - 1) {
                        pinInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && e.target.value.length === 0) {
                    if (index > 0) {
                        pinInputs[index - 1].focus();
                    }
                }
            });

            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text');
                const digits = pasteData.replace(/\D/g, '').split('').slice(0, 4);
                
                digits.forEach((digit, i) => {
                    if (pinInputs[i]) {
                        pinInputs[i].value = digit;
                    }
                });

                if (digits.length === 4) {
                    pinInputs[3].focus();
                } else if (digits.length > 0) {
                    pinInputs[digits.length].focus();
                }
            });
        });

        pinForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let pin = '';
            pinInputs.forEach(input => {
                pin += input.value;
            });

            if (pin.length !== 4) {
                pinInputs.forEach(input => {
                    input.classList.add('error');
                    setTimeout(() => input.classList.remove('error'), 500);
                });
                return;
            }

            fullPin.value = pin;
            this.submit();
        });
    });
</script>
@endpush
@endsection