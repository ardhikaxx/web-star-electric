@php
    $adminFlashToast = null;

    if (session('success')) {
        $adminFlashToast = ['type' => 'success', 'message' => session('success')];
    } elseif (session('error')) {
        $adminFlashToast = ['type' => 'error', 'message' => session('error')];
    } elseif (session('warning')) {
        $adminFlashToast = ['type' => 'warning', 'message' => session('warning')];
    } elseif (session('info')) {
        $adminFlashToast = ['type' => 'info', 'message' => session('info')];
    } elseif ($errors->any()) {
        $adminFlashToast = ['type' => 'error', 'message' => $errors->first()];
    }
@endphp

<style>
    .swal2-popup.swal-theme-modal {
        border-radius: 24px;
        padding: 1.35rem 1.35rem 1.15rem;
        border: 1px solid rgba(16, 33, 50, 0.08);
        box-shadow: 0 26px 60px rgba(8, 19, 33, 0.18);
    }

    .swal2-title.swal-theme-title {
        color: var(--text);
        font-size: 1.22rem;
        font-weight: 800;
        line-height: 1.35;
    }

    .swal2-html-container.swal-theme-content {
        color: var(--muted);
        font-size: 0.94rem;
        line-height: 1.6;
    }

    .swal2-actions.swal-theme-actions {
        gap: 0.75rem;
        margin-top: 1.35rem;
    }

    .swal2-confirm.swal-theme-confirm,
    .swal2-cancel.swal-theme-cancel {
        border: none;
        border-radius: 14px;
        padding: 0.82rem 1.35rem;
        font-size: 0.92rem;
        font-weight: 700;
        min-width: 128px;
        transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
    }

    .swal2-confirm.swal-theme-confirm {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: #fff;
        box-shadow: 0 12px 24px rgba(255, 2, 5, 0.22);
    }

    .swal2-confirm.swal-theme-confirm:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 30px rgba(255, 2, 5, 0.28);
    }

    .swal2-cancel.swal-theme-cancel {
        background: #fff;
        color: var(--muted);
        border: 1px solid rgba(16, 33, 50, 0.1);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .swal2-cancel.swal-theme-cancel:hover {
        background: var(--bg-light);
        color: var(--text);
        transform: translateY(-1px);
    }

    .swal2-popup.swal-theme-toast {
        width: auto !important;
        max-width: 420px;
        padding: 0.9rem 1rem;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid rgba(16, 33, 50, 0.08);
        box-shadow: 0 18px 36px rgba(8, 19, 33, 0.16);
        backdrop-filter: blur(10px);
    }

    .swal2-title.swal-theme-toast-title {
        margin: 0;
        color: var(--text);
        font-size: 0.92rem;
        font-weight: 700;
        line-height: 1.45;
    }

    .swal2-popup.swal-theme-toast .swal2-icon {
        margin: 0 0.75rem 0 0;
        transform: scale(0.88);
    }

    .swal2-popup.swal-theme-toast .swal2-timer-progress-bar {
        background: linear-gradient(90deg, rgba(255, 2, 5, 0.85), rgba(255, 2, 5, 0.4));
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($adminFlashToast)
    <script>
        window.__adminFlashToast = @json($adminFlashToast);
    </script>
@endif
<script>
    (function () {
        if (typeof Swal === 'undefined') {
            return;
        }

        const toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            timer: 3200,
            timerProgressBar: true,
            showConfirmButton: false,
            customClass: {
                popup: 'swal-theme-toast',
                title: 'swal-theme-toast-title'
            }
        });

        function normalizeType(type) {
            return ['success', 'error', 'warning', 'info', 'question'].includes(type) ? type : 'info';
        }

        function fireToast(type, message, options) {
            return toast.fire(Object.assign({
                icon: normalizeType(type),
                title: message
            }, options || {}));
        }

        function fireConfirm(options) {
            const config = options || {};

            return Swal.fire(Object.assign({
                icon: normalizeType(config.icon || 'warning'),
                title: config.title || 'Konfirmasi tindakan',
                text: config.text || 'Lanjutkan aksi ini?',
                showCancelButton: true,
                reverseButtons: true,
                focusCancel: true,
                confirmButtonText: config.confirmButtonText || 'Lanjutkan',
                cancelButtonText: config.cancelButtonText || 'Batal',
                buttonsStyling: false,
                customClass: {
                    popup: 'swal-theme-modal',
                    title: 'swal-theme-title',
                    htmlContainer: 'swal-theme-content',
                    actions: 'swal-theme-actions',
                    confirmButton: 'swal-theme-confirm',
                    cancelButton: 'swal-theme-cancel'
                }
            }, config));
        }

        window.AdminAlerts = {
            toastSuccess(message, options) {
                return fireToast('success', message, options);
            },
            toastError(message, options) {
                return fireToast('error', message, options);
            },
            toastWarning(message, options) {
                return fireToast('warning', message, options);
            },
            toastInfo(message, options) {
                return fireToast('info', message, options);
            },
            confirm(options) {
                return fireConfirm(options);
            }
        };

        document.addEventListener('DOMContentLoaded', function () {
            if (window.__adminFlashToast && window.__adminFlashToast.message) {
                fireToast(window.__adminFlashToast.type, window.__adminFlashToast.message);
            }
        });

        document.addEventListener('submit', function (event) {
            const form = event.target;

            if (!(form instanceof HTMLFormElement) || !form.matches('[data-swal-confirm]')) {
                return;
            }

            event.preventDefault();

            fireConfirm({
                icon: form.dataset.confirmIcon || 'warning',
                title: form.dataset.confirmTitle || 'Konfirmasi tindakan',
                text: form.dataset.confirmText || 'Lanjutkan aksi ini?',
                confirmButtonText: form.dataset.confirmButtonText || 'Lanjutkan',
                cancelButtonText: form.dataset.cancelButtonText || 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    })();
</script>
