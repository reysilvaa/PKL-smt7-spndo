@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('buttons')
    <a href="{{ route('employees.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="">Pilih Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="dept_id" class="form-label">Departemen <span class="text-danger">*</span></label>
                    <select class="form-select" id="dept_id" name="dept_id" required>
                        <option value="">Pilih Departemen</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('dept_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="cont" {{ old('status') === 'cont' ? 'selected' : '' }}>Contract</option>
                        <option value="emp" {{ old('status') === 'emp' ? 'selected' : '' }}>Employee</option>
                        <option value="not_act" {{ old('status') === 'not_act' ? 'selected' : '' }}>Not Active</option>
                    </select>
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 