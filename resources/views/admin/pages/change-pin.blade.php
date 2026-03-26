@extends('admin.layouts.main')

@section('title', 'Ganti PIN - Admin')
@section('page-title', 'Ganti PIN')

@push('styles')
    <style>
        .pin-page-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .pin-page-header h2 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .pin-page-header h2 i {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--primary-light-alpha);
            color: var(--primary);
            font-size: 1.2rem;
        }

        .pin-page-header p {
            margin: 0.7rem 0 0;
            color: var(--muted);
            font-size: 0.95rem;
            max-width: 620px;
        }

        .pin-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.75rem 1rem;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--line);
            box-shadow: 0 16px 30px rgba(16, 33, 50, 0.08);
            color: var(--text);
            font-weight: 700;
            white-space: nowrap;
        }

        .pin-status-badge i {
            color: var(--primary);
        }

        .pin-side-card,
        .pin-form-card {
            background: #fff;
            border-radius: var(--radius-lg);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .pin-side-card {
            padding: 1.6rem;
            background: linear-gradient(180deg, #ffffff 0%, #fff7f7 100%);
            position: sticky;
            top: 6rem;
        }

        .pin-side-header {
            display: flex;
            align-items: flex-start;
            gap: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .pin-side-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: var(--primary-light-alpha);
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .pin-side-header h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text);
        }

        .pin-side-header p {
            margin: 0.35rem 0 0;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .pin-tip-list {
            display: grid;
            gap: 0.85rem;
        }

        .pin-tip-item {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            padding: 0.9rem 1rem;
            border-radius: var(--radius-md);
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--line);
        }

        .pin-tip-item i {
            color: var(--primary);
            margin-top: 0.15rem;
        }

        .pin-tip-item strong {
            display: block;
            color: var(--text);
            font-size: 0.92rem;
            margin-bottom: 0.2rem;
        }

        .pin-tip-item span {
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.55;
        }

        .pin-form-card + .pin-form-card {
            margin-top: 1.5rem;
        }

        .pin-form-card-header {
            padding: 1.45rem 1.75rem;
            border-bottom: 1px solid var(--line);
            background: rgba(248, 251, 253, 0.58);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .pin-form-card-header h3 {
            margin: 0;
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .pin-form-card-header h3 i {
            color: var(--primary);
        }

        .pin-form-card-header p {
            margin: 0;
            color: var(--muted);
            font-size: 0.86rem;
        }

        .pin-form-card-body {
            padding: 1.75rem;
        }

        .pin-section + .pin-section {
            margin-top: 1.6rem;
            padding-top: 1.6rem;
            border-top: 1px dashed var(--line);
        }

        .pin-field-label {
            display: block;
            margin-bottom: 0.45rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .pin-field-caption {
            margin: 0 0 1rem;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .pin-input-group {
            display: flex;
            gap: 0.8rem;
            justify-content: flex-start;
            flex-wrap: nowrap;
        }

        .pin-digit {
            width: 68px;
            height: 72px;
            border-radius: 20px;
            border: 2px solid var(--line);
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            text-align: center;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--text);
            transition: all 0.25s ease;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        .pin-digit:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light-alpha);
            transform: translateY(-2px);
        }

        .pin-digit.filled {
            border-color: rgba(255, 2, 5, 0.16);
            background: #fff;
        }

        .pin-digit.error {
            border-color: var(--danger);
            background: rgba(239, 68, 68, 0.05);
            animation: shake 0.45s ease;
        }

        .pin-helper {
            display: flex;
            align-items: flex-start;
            gap: 0.55rem;
            margin-top: 0.9rem;
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.55;
        }

        .pin-helper i {
            color: var(--primary);
            margin-top: 0.15rem;
        }

        .pin-action-bar {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1.75rem;
        }

        .pin-btn {
            padding: 0.9rem 1.8rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            transition: all 0.25s ease;
            border: none;
            text-decoration: none;
        }

        .pin-btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 8px 18px rgba(255, 2, 5, 0.25);
        }

        .pin-btn-primary:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 22px rgba(255, 2, 5, 0.3);
        }

        .pin-btn-light {
            background: #fff;
            color: var(--muted);
            border: 2px solid var(--line);
        }

        .pin-btn-light:hover {
            background: var(--bg-light);
            border-color: rgba(16, 33, 50, 0.15);
            color: var(--text);
            transform: translateY(-2px);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @media (max-width: 991.98px) {
            .pin-page-header {
                flex-direction: column;
            }

            .pin-side-card {
                position: static;
            }

            .pin-action-bar {
                flex-direction: column;
            }

            .pin-btn {
                width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .pin-form-card-header,
            .pin-form-card-body,
            .pin-side-card {
                padding: 1.2rem;
            }

            .pin-input-group {
                gap: 0.55rem;
            }

            .pin-digit {
                width: 56px;
                height: 62px;
                border-radius: 16px;
                font-size: 1.4rem;
            }

            .pin-page-header h2 {
                font-size: 1.45rem;
            }
        }
    </style>
@endpush

@section('content')
    @include('admin.partials.breadcrumb', [
        'links' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Ganti PIN'],
        ],
    ])

    <div class="pin-page-header">
        <div>
            <h2>
                <i class="fa-solid fa-shield-halved"></i>
                Ganti PIN Admin
            </h2>
            <p>Perbarui PIN akses admin dengan tampilan yang lebih rapi dan proses yang lebih aman. Gunakan 4 digit angka yang mudah Anda ingat tetapi tidak mudah ditebak.</p>
        </div>
        <div class="pin-status-badge">
            <i class="fa-solid fa-lock"></i>
            4 Digit Numerik
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="pin-side-card">
                <div class="pin-side-header">
                    <div class="pin-side-icon">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <h3>Keamanan Akses</h3>
                        <p>Pastikan PIN baru hanya diketahui admin dan tidak menggunakan kombinasi angka yang mudah ditebak.</p>
                    </div>
                </div>

                <div class="pin-tip-list">
                    <div class="pin-tip-item">
                        <i class="fa-solid fa-check"></i>
                        <div>
                            <strong>Gunakan angka yang unik</strong>
                            <span>Hindari kombinasi seperti `1234`, `0000`, atau tanggal lahir yang mudah ditebak.</span>
                        </div>
                    </div>
                    <div class="pin-tip-item">
                        <i class="fa-solid fa-check"></i>
                        <div>
                            <strong>Simpan perubahan dengan teliti</strong>
                            <span>Pastikan PIN baru dan konfirmasi benar-benar sama sebelum disimpan.</span>
                        </div>
                    </div>
                    <div class="pin-tip-item">
                        <i class="fa-solid fa-check"></i>
                        <div>
                            <strong>Jaga kerahasiaan akses</strong>
                            <span>PIN admin sebaiknya tidak dibagikan agar panel tetap aman.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <form action="{{ route('admin.change-pin') }}" method="POST" id="changePinForm">
                @csrf

                <div class="pin-form-card">
                    <div class="pin-form-card-header">
                        <div>
                            <h3><i class="fa-solid fa-key"></i> Verifikasi PIN Saat Ini</h3>
                            <p>Masukkan PIN admin yang aktif sebelum mengganti ke PIN baru.</p>
                        </div>
                    </div>
                    <div class="pin-form-card-body">
                        <div class="pin-section">
                            <label class="pin-field-label">PIN Saat Ini</label>
                            <p class="pin-field-caption">Isi 4 digit PIN yang saat ini digunakan untuk masuk ke panel admin.</p>
                            <div class="pin-input-group" id="currentPinGroup">
                                @for ($i = 1; $i <= 4; $i++)
                                    <input type="password" name="pin{{ $i }}" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                @endfor
                            </div>
                            <div class="pin-helper">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>Digit akan diproses sebagai angka dan tersimpan setelah semua kolom lengkap.</span>
                            </div>
                            <input type="hidden" name="current_pin" id="currentPin">
                        </div>
                    </div>
                </div>

                <div class="pin-form-card">
                    <div class="pin-form-card-header">
                        <div>
                            <h3><i class="fa-solid fa-lock"></i> Atur PIN Baru</h3>
                            <p>Buat PIN baru lalu ulangi sekali lagi untuk konfirmasi.</p>
                        </div>
                    </div>
                    <div class="pin-form-card-body">
                        <div class="pin-section">
                            <label class="pin-field-label">PIN Baru</label>
                            <p class="pin-field-caption">Gunakan kombinasi angka yang baru dan tidak sama dengan pola yang mudah ditebak.</p>
                            <div class="pin-input-group" id="newPinGroup">
                                @for ($i = 1; $i <= 4; $i++)
                                    <input type="password" name="pin_new{{ $i }}" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                @endfor
                            </div>
                            <input type="hidden" name="new_pin" id="newPin">
                        </div>

                        <div class="pin-section">
                            <label class="pin-field-label">Konfirmasi PIN Baru</label>
                            <p class="pin-field-caption">Masukkan kembali PIN baru yang sama persis untuk memastikan tidak ada kesalahan input.</p>
                            <div class="pin-input-group" id="confirmPinGroup">
                                @for ($i = 1; $i <= 4; $i++)
                                    <input type="password" name="pin_confirm{{ $i }}" maxlength="1" class="pin-digit" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                @endfor
                            </div>
                            <input type="hidden" name="new_pin_confirmation" id="confirmPin">
                        </div>

                        <div class="pin-action-bar">
                            <a href="{{ route('admin.dashboard') }}" class="pin-btn pin-btn-light">
                                <i class="fa-solid fa-arrow-left"></i>
                                Kembali
                            </a>
                            <button type="submit" class="pin-btn pin-btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Simpan PIN Baru
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
            const currentPin = setupPinInputs('currentPinGroup', 'currentPin');
            const newPin = setupPinInputs('newPinGroup', 'newPin');
            const confirmPin = setupPinInputs('confirmPinGroup', 'confirmPin');
            const form = document.getElementById('changePinForm');

            function getPinValue(inputs) {
                return inputs.map((input) => input.value).join('');
            }

            function showClientError(message) {
                if (window.AdminAlerts) {
                    window.AdminAlerts.toastError(message);
                    return;
                }

                alert(message);
            }

            function flashError(inputs) {
                inputs.forEach((input) => {
                    input.classList.add('error');
                    setTimeout(() => input.classList.remove('error'), 450);
                });
            }

            [currentPin, newPin, confirmPin].forEach((group) => {
                group.inputs.forEach((input) => {
                    input.addEventListener('input', function() {
                        input.classList.remove('error');
                    });
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const currentPinValue = getPinValue(currentPin.inputs);
                const newPinValue = getPinValue(newPin.inputs);
                const confirmPinValue = getPinValue(confirmPin.inputs);

                if (currentPinValue.length !== 4) {
                    flashError(currentPin.inputs);
                    showClientError('PIN saat ini harus terdiri dari 4 digit angka.');
                    return;
                }

                if (newPinValue.length !== 4) {
                    flashError(newPin.inputs);
                    showClientError('PIN baru harus terdiri dari 4 digit angka.');
                    return;
                }

                if (confirmPinValue.length !== 4) {
                    flashError(confirmPin.inputs);
                    showClientError('Konfirmasi PIN baru harus terdiri dari 4 digit angka.');
                    return;
                }

                if (newPinValue !== confirmPinValue) {
                    flashError(confirmPin.inputs);
                    showClientError('Konfirmasi PIN baru tidak cocok. Silakan cek kembali.');
                    return;
                }

                currentPin.hiddenInput.value = currentPinValue;
                newPin.hiddenInput.value = newPinValue;
                confirmPin.hiddenInput.value = confirmPinValue;

                if (window.AdminAlerts) {
                    window.AdminAlerts.confirm({
                        icon: 'question',
                        title: 'Simpan PIN baru?',
                        text: 'PIN admin akan diperbarui. Pastikan kombinasi angka sudah benar.',
                        confirmButtonText: 'Ya, simpan',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                    return;
                }

                this.submit();
            });
        });
    </script>
@endpush
