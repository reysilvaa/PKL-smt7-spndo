@extends('layouts.app')

@section('title', 'Detail Karyawan')

@section('buttons')
    <a href="{{ route('employees.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
    @endif
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <h5>Informasi Umum</h5>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $employee->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Depan</th>
                        <td>{{ $employee->firstname }}</td>
                    </tr>
                    <tr>
                        <th>Nama Belakang</th>
                        <td>{{ $employee->lastname ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ ucfirst($employee->gender) }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $employee->address }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ date('d-m-Y', strtotime($employee->dob)) }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6 mb-3">
                <h5>Informasi Pekerjaan</h5>
                <table class="table">
                    <tr>
                        <th>Departemen</th>
                        <td>{{ $employee->department->name }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($employee->status === 'cont')
                                <span class="badge bg-info">Contract</span>
                            @elseif($employee->status === 'emp')
                                <span class="badge bg-success">Employee</span>
                            @else
                                <span class="badge bg-danger">Not Active</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ date('d-m-Y H:i', strtotime($employee->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diperbarui</th>
                        <td>{{ $employee->updated_at ? date('d-m-Y H:i', strtotime($employee->updated_at)) : '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 