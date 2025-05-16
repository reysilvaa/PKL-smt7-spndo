@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('buttons')
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Karyawan
        </a>
    @endif
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Gender</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->lastname ?? '-' }}</td>
                            <td>{{ ucfirst($employee->gender) }}</td>
                            <td>{{ $employee->department->name }}</td>
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
                                <div class="btn-group">
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data karyawan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 