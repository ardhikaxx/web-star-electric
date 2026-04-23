@extends('admin.layouts.main')

@section('title', 'Profile Karyawan')
@section('page-title', 'Profile Karyawan')

@push('styles')
    <style>
        .pin-input-group {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
            margin-top: 0.5rem;
        }

        .pin-digit {
            width: 45px;
            height: 55px;
            border-radius: 12px;
            border: 2px solid var(--line);
            background: #fff;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text);
            transition: all 0.2s ease;
        }

        .pin-digit:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light-alpha);
            transform: translateY(-2px);
        }

        .pin-digit.filled {
            border-color: var(--primary-light-alpha);
        }

        .pin-digit.error {
            border-color: var(--danger);
            background: rgba(239, 68, 68, 0.05);
            animation: shake 0.45s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @media (max-width: 575.98px) {
            .pin-input-group {
                gap: 0.4rem;
            }
            .pin-digit {
                width: 40px;
                height: 50px;
                font-size: 1.1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white py-3" style="border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-user-gear me-2 text-primary"></i>Pengaturan Profile Karyawan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('employee.profile.update') }}" method="POST" id="profileForm">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-12 col-lg-4">
                                <label class="form-label fw-bold">Nama</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required placeholder="Nama Lengkap">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required placeholder="Username Akses">
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label fw-bold">Nomor Telepon</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number) }}" required placeholder="08xxxxxx">
                                @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-12"><hr class="my-2 opacity-10"></div>
                            
                            <div class="col-12">
                                <div class="alert alert-info border-0 mb-4" style="background: var(--primary); color: white;">
                                    <i class="fa-solid fa-circle-info me-2 text-white"></i>
                                    Kosongkan bagian PIN jika Anda tidak ingin mengubah PIN keamanan.
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label class="form-label fw-bold">PIN Saat Ini</label>
                                <div class="pin-input-group" id="currentPinGroup">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <input type="password" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                    @endfor
                                </div>
                                <input type="hidden" name="current_pin" id="currentFullPin">
                                @error('current_pin')<div class="text-danger mt-2 small">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 col-lg-4">
                                <label class="form-label fw-bold">PIN Baru</label>
                                <div class="pin-input-group" id="newPinGroup">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <input type="password" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                    @endfor
                                </div>
                                <input type="hidden" name="new_pin" id="newFullPin">
                                @error('new_pin')<div class="text-danger mt-2 small">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 col-lg-4">
                                <label class="form-label fw-bold">Konfirmasi PIN Baru</label>
                                <div class="pin-input-group" id="confirmPinGroup">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <input type="password" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                    @endfor
                                </div>
                                <input type="hidden" name="new_pin_confirmation" id="confirmFullPin">
                                @error('new_pin_confirmation')<div class="text-danger mt-2 small">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mt-5 border-top pt-4">
                            <button class="btn btn-primary px-4 py-2 fw-bold" type="submit">
                                <i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white py-3" style="border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-location-dot me-2 text-primary"></i>Lokasi Penugasan</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small">Lokasi berikut ditetapkan oleh admin dan tidak bisa diubah dari akun karyawan.</p>
                    <div class="d-flex flex-column gap-2">
                        @foreach ($user->locations as $location)
                            <div class="border rounded-4 px-3 py-2 bg-light d-flex align-items-center">
                                <i class="fa-solid fa-store me-2 text-primary opacity-50"></i>
                                <span class="fw-semibold">{{ $location->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setupPinInputs(inputGroupId, hiddenInputId) {
            const inputGroup = document.getElementById(inputGroupId);
            const inputs = Array.from(inputGroup.querySelectorAll('.pin-digit'));
            const hiddenInput = document.getElementById(hiddenInputId);

            function syncFilledState() {
                inputs.forEach((input) => {
                    input.classList.toggle('filled', input.value !== '');
                });
            }

            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value.replace(/\D/g, '').slice(-1);
                    e.target.value = value;
                    input.classList.remove('error');
                    syncFilledState();

                    if (value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && e.target.value.length === 0 && index > 0) {
                        inputs[index - 1].focus();
                        inputs[index - 1].select();
                    }
                    if (e.key === 'ArrowLeft' && index > 0) {
                        inputs[index - 1].focus();
                    }
                    if (e.key === 'ArrowRight' && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener('focus', function() {
                    input.select();
                });

                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const digits = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 4).split('');

                    digits.forEach((digit, digitIndex) => {
                        if (inputs[digitIndex]) {
                            inputs[digitIndex].value = digit;
                            inputs[digitIndex].classList.remove('error');
                        }
                    });

                    syncFilledState();

                    if (digits.length > 0) {
                        inputs[Math.min(digits.length, 4) - 1].focus();
                    }
                });
            });

            syncFilledState();

            return { inputs, hiddenInput };
        }

        document.addEventListener('DOMContentLoaded', function() {
            const currentPin = setupPinInputs('currentPinGroup', 'currentFullPin');
            const newPin = setupPinInputs('newPinGroup', 'newFullPin');
            const confirmPin = setupPinInputs('confirmPinGroup', 'confirmFullPin');
            const form = document.getElementById('profileForm');

            function getPinValue(inputs) {
                return inputs.map((input) => input.value).join('');
            }

            function flashError(inputs) {
                inputs.forEach((input) => {
                    input.classList.add('error');
                    setTimeout(() => input.classList.remove('error'), 450);
                });
            }

            form.addEventListener('submit', function(e) {
                const currentPinValue = getPinValue(currentPin.inputs);
                const newPinValue = getPinValue(newPin.inputs);
                const confirmPinValue = getPinValue(confirmPin.inputs);

                if (newPinValue.length > 0 || confirmPinValue.length > 0 || currentPinValue.length > 0) {
                    if (currentPinValue.length !== 4) {
                        e.preventDefault();
                        flashError(currentPin.inputs);
                        alert('PIN saat ini harus terdiri dari 4 digit angka jika ingin mengubah PIN.');
                        return;
                    }

                    if (newPinValue.length > 0 && newPinValue.length !== 4) {
                        e.preventDefault();
                        flashError(newPin.inputs);
                        alert('PIN baru harus terdiri dari 4 digit angka.');
                        return;
                    }

                    if (confirmPinValue.length > 0 && confirmPinValue.length !== 4) {
                        e.preventDefault();
                        flashError(confirmPin.inputs);
                        alert('Konfirmasi PIN baru harus terdiri dari 4 digit angka.');
                        return;
                    }

                    if (newPinValue !== confirmPinValue) {
                        e.preventDefault();
                        flashError(confirmPin.inputs);
                        alert('Konfirmasi PIN baru tidak cocok.');
                        return;
                    }
                }

                currentPin.hiddenInput.value = currentPinValue;
                newPin.hiddenInput.value = newPinValue;
                confirmPin.hiddenInput.value = confirmPinValue;
            });
        });
    </script>
@endpush
