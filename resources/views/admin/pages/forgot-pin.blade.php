@extends('admin.layouts.auth')

@section('title', 'Lupa PIN - Admin Ar-Rahman E-Bike')

@section('content')
    <div class="login-page">
        <div class="login-bg"></div>
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('assets/logo-auth.png') }}" alt="Ar-Rahman E-Bike">
                </div>
                <h2>Lupa PIN Admin</h2>
                <p>Masukkan Kunci Pemulihan untuk mereset PIN Anda.</p>
            </div>

            <form action="{{ route('admin.forgot-pin.post') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="recovery_key" class="form-label fw-bold small text-muted text-uppercase mb-2">Kunci Pemulihan</label>
                    <input type="password" name="recovery_key" id="recovery_key" 
                        class="form-control form-control-lg @error('recovery_key') is-invalid @enderror" 
                        placeholder="Masukkan kunci rahasia..." required>
                    @error('recovery_key')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
                        Verifikasi Kunci
                    </button>
                    <a href="{{ route('admin.login') }}" class="btn btn-link text-decoration-none text-muted small mt-2">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
