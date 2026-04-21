@extends('admin.layouts.auth')

@section('title', 'Lupa PIN')

@section('content')
    <div class="login-page">
        <div class="login-bg"></div>
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('assets/logo-auth.png') }}" alt="Ar-Rahman E-Bike">
                </div>
                <h2>Lupa PIN</h2>
                <p>Masukkan nomor telepon yang sudah terdaftar pada sistem. Jika cocok, Anda akan diarahkan ke halaman ubah PIN baru.</p>
            </div>

            <form action="{{ route('pin.forgot.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="phone_number" class="form-label fw-bold small text-muted text-uppercase mb-2">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_number"
                        class="form-control form-control-lg @error('phone_number') is-invalid @enderror"
                        value="{{ old('phone_number') }}"
                        placeholder="Contoh: 081234567890" required>
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
                        Verifikasi Nomor Telepon
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-muted small mt-2">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
