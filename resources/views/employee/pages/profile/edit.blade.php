@extends('admin.layouts.main')

@section('title', 'Profile Karyawan')
@section('page-title', 'Profile Karyawan')

@section('content')
    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header">Pengaturan Profile Karyawan</div>
                <div class="card-body">
                    <form action="{{ route('employee.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-12 col-lg-4">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number) }}" required>
                                @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12"><hr></div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label">PIN Saat Ini</label>
                                <input type="password" name="current_pin" class="form-control @error('current_pin') is-invalid @enderror" maxlength="4">
                                @error('current_pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label">PIN Baru</label>
                                <input type="password" name="new_pin" class="form-control @error('new_pin') is-invalid @enderror" maxlength="4">
                                @error('new_pin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label class="form-label">Konfirmasi PIN Baru</label>
                                <input type="password" name="new_pin_confirmation" class="form-control" maxlength="4">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary" type="submit">Simpan Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header">Lokasi Penugasan</div>
                <div class="card-body">
                    <p class="text-muted">Lokasi berikut ditetapkan oleh admin dan tidak bisa diubah dari akun karyawan.</p>
                    <div class="d-flex flex-column gap-2">
                        @foreach ($user->locations as $location)
                            <div class="border rounded px-3 py-2">{{ $location->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
