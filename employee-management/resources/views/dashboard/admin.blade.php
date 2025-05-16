@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Selamat datang, {{ Auth::user()->name }}!</h5>
                <p class="card-text">
                    Anda login sebagai <span class="badge bg-primary">Admin</span>. 
                    Sebagai admin, Anda dapat mengakses semua fitur sistem manajemen karyawan.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title">Karyawan</h5>
                        <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-primary">Kelola Karyawan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-building fa-3x text-success"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title">Departemen</h5>
                        <a href="{{ route('departments.index') }}" class="btn btn-sm btn-outline-success">Kelola Departemen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-chart-bar fa-3x text-info"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title">Laporan</h5>
                        <div class="btn-group">
                            <a href="{{ route('reports.employee_list') }}" class="btn btn-sm btn-outline-info">Lihat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 