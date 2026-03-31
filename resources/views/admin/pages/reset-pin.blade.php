@extends('admin.layouts.auth')

@section('title', 'Atur PIN Baru - Admin Ar-Rahman E-Bike')

@section('content')
    <div class="login-page">
        <div class="login-bg"></div>
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('assets/logo-auth.png') }}" alt="Ar-Rahman E-Bike">
                </div>
                <h2>Atur PIN Baru</h2>
                <p>Silakan buat 4 digit PIN baru untuk akun admin Anda.</p>
            </div>

            <form action="{{ route('admin.reset-pin.post') }}" method="POST" id="resetPinForm">
                @csrf
                <div class="mb-4 text-center">
                    <label class="form-label fw-bold small text-muted text-uppercase mb-3">PIN Baru (4 Digit)</label>
                    <div class="pin-input">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                    </div>
                    <input type="hidden" name="new_pin" id="new_pin_hidden">
                    @error('new_pin')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 text-center">
                    <label class="form-label fw-bold small text-muted text-uppercase mb-3">Konfirmasi PIN Baru</label>
                    <div class="pin-input">
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                    </div>
                    <input type="hidden" name="new_pin_confirmation" id="new_pin_confirmation_hidden">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
                        Ubah PIN
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.pin-input');
            const hiddenInputs = [
                document.getElementById('new_pin_hidden'),
                document.getElementById('new_pin_confirmation_hidden')
            ];

            forms.forEach((container, formIndex) => {
                const inputs = container.querySelectorAll('input');
                
                inputs.forEach((input, index) => {
                    input.addEventListener('input', function(e) {
                        if (e.target.value.length === 1) {
                            if (index < inputs.length - 1) {
                                inputs[index + 1].focus();
                            }
                        }
                        updateHiddenInput(formIndex);
                    });

                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && e.target.value.length === 0) {
                            if (index > 0) {
                                inputs[index - 1].focus();
                            }
                        }
                    });
                });

                function updateHiddenInput(idx) {
                    let pin = '';
                    container.querySelectorAll('input').forEach(input => {
                        pin += input.value;
                    });
                    hiddenInputs[idx].value = pin;
                }
            });
        });
    </script>
    @endpush
@endsection
