@extends('admin.layouts.auth')

@section('title', 'Ubah PIN Baru')

@section('content')
    <div class="login-page">
        <div class="login-bg"></div>
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('assets/logo-auth.png') }}" alt="Ar-Rahman E-Bike">
                </div>
                <h2>Ubah PIN Baru Anda</h2>
                <p>Buat PIN 4 digit baru lalu konfirmasi ulang untuk menyimpan perubahan.</p>
            </div>

            <form action="{{ route('pin.reset.submit') }}" method="POST" id="resetPinForm">
                @csrf
                <div class="mb-4 text-center">
                    <label class="form-label fw-bold small text-muted text-uppercase mb-3">PIN Baru (4 Digit)</label>
                    <div class="pin-input" data-pin-block>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                    </div>
                    <input type="hidden" name="pin" id="pin_hidden">
                    @error('pin')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 text-center">
                    <label class="form-label fw-bold small text-muted text-uppercase mb-3">Konfirmasi PIN Baru</label>
                    <div class="pin-input" data-pin-block>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]*" class="form-control" required>
                    </div>
                    <input type="hidden" name="pin_confirmation" id="pin_confirmation_hidden">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
                        Simpan PIN Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const blocks = document.querySelectorAll('[data-pin-block]');
                const hiddenInputs = [
                    document.getElementById('pin_hidden'),
                    document.getElementById('pin_confirmation_hidden')
                ];

                blocks.forEach((block, blockIndex) => {
                    const inputs = block.querySelectorAll('input');

                    const syncHidden = function() {
                        hiddenInputs[blockIndex].value = Array.from(inputs).map(input => input.value).join('');
                    };

                    inputs.forEach((input, index) => {
                        input.addEventListener('input', function(e) {
                            e.target.value = e.target.value.replace(/\D/g, '');
                            syncHidden();

                            if (e.target.value.length === 1 && index < inputs.length - 1) {
                                inputs[index + 1].focus();
                            }
                        });

                        input.addEventListener('keydown', function(e) {
                            if (e.key === 'Backspace' && e.target.value.length === 0 && index > 0) {
                                inputs[index - 1].focus();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
