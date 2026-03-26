@extends('admin.layouts.main')

@section('title', 'Ganti PIN - Admin')

@push('styles')
    <style>
        .change-pin-card {
            max-width: 480px;
            margin: 0 auto;
        }

        .pin-input-group {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .pin-input-group input {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            border: 2px solid var(--border);
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .pin-input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(12, 143, 116, 0.15);
            outline: none;
        }

        .pin-input-group input.error {
            border-color: var(--danger);
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-label {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .info-box {
            background: rgba(12, 143, 116, 0.1);
            border: 1px solid var(--primary);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .info-box i {
            color: var(--primary);
            margin-top: 0.125rem;
        }

        .info-box p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--text);
        }
    </style>
@endpush

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ganti PIN</li>
        </ol>
    </nav>

    <div class="card change-pin-card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fa-solid fa-key me-2"></i>
                Ganti PIN Admin
            </h5>
        </div>
        <div class="card-body">
            <div class="info-box">
                <i class="fa-solid fa-circle-info"></i>
                <p>PIN harus 4 digit angka. Pastikan mengingat PIN baru Anda.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4">
                    <i class="fa-solid fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center mb-4">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.change-pin') }}" method="POST" id="changePinForm">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label">PIN Saat Ini</label>
                    <div class="pin-input-group" id="currentPinGroup">
                        <input type="password" name="pin1" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin2" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin3" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin4" maxlength="1" class="pin-digit" autocomplete="off">
                    </div>
                    <input type="hidden" name="current_pin" id="currentPin">
                </div>

                <div class="mb-4">
                    <label class="form-label">PIN Baru</label>
                    <div class="pin-input-group" id="newPinGroup">
                        <input type="password" name="pin_new1" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin_new2" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin_new3" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin_new4" maxlength="1" class="pin-digit" autocomplete="off">
                    </div>
                    <input type="hidden" name="new_pin" id="newPin">
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi PIN Baru</label>
                    <div class="pin-input-group" id="confirmPinGroup">
                        <input type="password" name="pin_confirm1" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin_confirm2" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin_confirm3" maxlength="1" class="pin-digit" autocomplete="off">
                        <input type="password" name="pin_confirm4" maxlength="1" class="pin-digit" autocomplete="off">
                    </div>
                    <input type="hidden" name="new_pin_confirmation" id="confirmPin">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2">
                        <i class="fa-solid fa-save me-2"></i>
                        Simpan PIN Baru
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary py-2">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function setupPinInputs(inputGroupId, hiddenInputId) {
                const inputGroup = document.getElementById(inputGroupId);
                const inputs = inputGroup.querySelectorAll('.pin-digit');
                const hiddenInput = document.getElementById(hiddenInputId);

                inputs.forEach((input, index) => {
                    input.addEventListener('input', function(e) {
                        if (e.target.value.length === 1) {
                            if (index < inputs.length - 1) {
                                inputs[index + 1].focus();
                            }
                        }
                    });

                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Backspace' && e.target.value.length === 0) {
                            if (index > 0) {
                                inputs[index - 1].focus();
                            }
                        }
                    });

                    input.addEventListener('paste', function(e) {
                        e.preventDefault();
                        const pasteData = e.clipboardData.getData('text');
                        const digits = pasteData.replace(/\D/g, '').split('').slice(0, 4);

                        digits.forEach((digit, i) => {
                            if (inputs[i]) {
                                inputs[i].value = digit;
                            }
                        });

                        if (digits.length > 0) {
                            inputs[Math.min(digits.length, 3)].focus();
                        }
                    });
                });

                return { inputs, hiddenInput };
            }

            document.addEventListener('DOMContentLoaded', function() {
                const currentPin = setupPinInputs('currentPinGroup', 'currentPin');
                const newPin = setupPinInputs('newPinGroup', 'newPin');
                const confirmPin = setupPinInputs('confirmPinGroup', 'confirmPin');

                const form = document.getElementById('changePinForm');

                function getPinValue(inputs) {
                    let pin = '';
                    inputs.forEach(input => {
                        pin += input.value;
                    });
                    return pin;
                }

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const currentPinValue = getPinValue(currentPin.inputs);
                    const newPinValue = getPinValue(newPin.inputs);
                    const confirmPinValue = getPinValue(confirmPin.inputs);

                    if (currentPinValue.length !== 4) {
                        currentPin.inputs.forEach(input => {
                            input.classList.add('error');
                            setTimeout(() => input.classList.remove('error'), 500);
                        });
                        return;
                    }

                    if (newPinValue.length !== 4) {
                        newPin.inputs.forEach(input => {
                            input.classList.add('error');
                            setTimeout(() => input.classList.remove('error'), 500);
                        });
                        return;
                    }

                    if (confirmPinValue.length !== 4) {
                        confirmPin.inputs.forEach(input => {
                            input.classList.add('error');
                            setTimeout(() => input.classList.remove('error'), 500);
                        });
                        return;
                    }

                    if (newPinValue !== confirmPinValue) {
                        confirmPin.inputs.forEach(input => {
                            input.classList.add('error');
                            setTimeout(() => input.classList.remove('error'), 500);
                        });
                        alert('Konfirmasi PIN tidak cocok');
                        return;
                    }

                    currentPin.hiddenInput.value = currentPinValue;
                    newPin.hiddenInput.value = newPinValue;
                    confirmPin.hiddenInput.value = confirmPinValue;

                    this.submit();
                });
            });
        </script>
    @endpush
@endsection