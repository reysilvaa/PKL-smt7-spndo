@extends('layouts.app')

@section('title', 'Laporan Daftar Karyawan')

@section('buttons')
    <button class="btn btn-sm btn-success" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak
    </button>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Gender</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Departemen</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->lastname ?? '-' }}</td>
                            <td>{{ ucfirst($employee->gender) }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ date('d-m-Y', strtotime($employee->dob)) }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data karyawan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        
        .card, .card * {
            visibility: visible;
        }
        
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
        }
        
        .btn, .navbar, .sidebar {
            display: none !important;
        }
    }
</style>
@endsection 