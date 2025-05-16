@extends('layouts.app')

@section('title', 'Laporan Ringkasan Status Karyawan')

@section('buttons')
    <button class="btn btn-sm btn-success" onclick="window.print()">
        <i class="fas fa-print"></i> Cetak
    </button>
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>Status</th>
                                <th>Total Karyawan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-info">Contract</span></td>
                                <td>{{ $statusSummary['Contract'] }}</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-success">Employee</span></td>
                                <td>{{ $statusSummary['Employee'] }}</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-danger">Not Active</span></td>
                                <td>{{ $statusSummary['Not Active'] }}</td>
                            </tr>
                            <tr class="table-secondary fw-bold">
                                <td>Grand Total</td>
                                <td>{{ array_sum($statusSummary) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-5">
                <canvas id="statusChart"></canvas>
            </div>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('statusChart').getContext('2d');
        
        const chartData = {
            labels: ['Contract', 'Employee', 'Not Active'],
            datasets: [{
                data: [
                    {{ $statusSummary['Contract'] }},
                    {{ $statusSummary['Employee'] }},
                    {{ $statusSummary['Not Active'] }}
                ],
                backgroundColor: [
                    'rgba(23, 162, 184, 0.7)',
                    'rgba(40, 167, 69, 0.7)',
                    'rgba(220, 53, 69, 0.7)'
                ],
                borderColor: [
                    'rgba(23, 162, 184, 1)',
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        };
        
        new Chart(ctx, {
            type: 'pie',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Status Karyawan'
                    }
                }
            }
        });
    });
</script>
@endsection 