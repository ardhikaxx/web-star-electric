@php
    $selectedLocations = collect(old('location_ids', isset($employee) ? $employee->locations->pluck('id')->all() : []))
        ->map(fn ($id) => (int) $id)
        ->all();
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <label class="form-label">Nama Karyawan</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-lg-6">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $employee->username ?? '') }}" required>
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-lg-6">
        <label class="form-label">Nomor Telepon</label>
        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $employee->phone_number ?? '') }}" required>
        @error('phone_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-lg-6">
        <label class="form-label">{{ isset($employee) ? 'PIN Baru (Opsional)' : 'PIN 4 Digit' }}</label>
        <input type="password" name="pin" class="form-control @error('pin') is-invalid @enderror" maxlength="4" {{ isset($employee) ? '' : 'required' }}>
        @error('pin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Lokasi Toko</label>
        <div class="row g-2">
            @foreach ($locations as $location)
                <div class="col-12 col-md-6">
                    <label class="form-check border rounded p-3 d-flex gap-2 align-items-start">
                        <input class="form-check-input mt-1" type="checkbox" name="location_ids[]" value="{{ $location->id }}"
                            {{ in_array($location->id, $selectedLocations, true) ? 'checked' : '' }}>
                        <span>{{ $location->name }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        @error('location_ids')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                {{ old('is_active', isset($employee) ? (int) $employee->is_active : 1) ? 'checked' : '' }}>
            <span class="form-check-label">Akun aktif</span>
        </label>
    </div>
</div>
