@extends('layouts.app')

@section('title', 'Detail Departemen')

@section('buttons')
    <a href="{{ route('departments.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
    @endif
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Informasi Departemen</h5>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <td>{{ $department->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $department->name }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ date('d-m-Y H:i', strtotime($department->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui Pada</th>
                        <td>{{ date('d-m-Y H:i', strtotime($department->updated_at)) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Daftar Karyawan</h5>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td>{{ $employee->firstname }} {{ $employee->lastname }}</td>
                                    <td>{{ ucfirst($employee->gender) }}</td>
                                    <td>
                                        @if($employee->status === 'cont')
                                            <span class="badge bg-info">Contract</span>
                                        @elseif($employee->status === 'emp')
                                            <span class="badge bg-success">Employee</span>
                                        @else
                                            <span class="badge bg-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada karyawan di departemen ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 