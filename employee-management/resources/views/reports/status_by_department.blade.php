@extends('layouts.app')

@section('title', 'Laporan Status Karyawan per Departemen')

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
                        <th>Departemen</th>
                        <th class="text-center">Contract</th>
                        <th class="text-center">Employee</th>
                        <th class="text-center">Not Active</th>
                        <th class="text-center">Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalContract = 0;
                        $totalEmployee = 0;
                        $totalNotActive = 0;
                        $grandTotal = 0;
                    @endphp
                    
                    @foreach($statusByDept as $id => $dept)
                        <tr>
                            <td>{{ $dept['name'] }}</td>
                            <td class="text-center">{{ $dept['contract'] }}</td>
                            <td class="text-center">{{ $dept['employee'] }}</td>
                            <td class="text-center">{{ $dept['not_active'] }}</td>
                            <td class="text-center fw-bold">{{ $dept['total'] }}</td>
                        </tr>
                        
                        @php
                            $totalContract += $dept['contract'];
                            $totalEmployee += $dept['employee'];
                            $totalNotActive += $dept['not_active'];
                            $grandTotal += $dept['total'];
                        @endphp
                    @endforeach
                    
                    <tr class="table-secondary fw-bold">
                        <td>Grand Total</td>
                        <td class="text-center">{{ $totalContract }}</td>
                        <td class="text-center">{{ $totalEmployee }}</td>
                        <td class="text-center">{{ $totalNotActive }}</td>
                        <td class="text-center">{{ $grandTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            <canvas id="deptChart"></canvas>
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
        const ctx = document.getElementById('deptChart').getContext('2d');
        
        const chartData = {
            labels: [
                @foreach($statusByDept as $dept)
                    '{{ $dept['name'] }}',
                @endforeach
            ],
            datasets: [
                {
                    label: 'Contract',
                    data: [
                        @foreach($statusByDept as $dept)
                            {{ $dept['contract'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(23, 162, 184, 0.7)',
                    borderColor: 'rgba(23, 162, 184, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Employee',
                    data: [
                        @foreach($statusByDept as $dept)
                            {{ $dept['employee'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Not Active',
                    data: [
                        @foreach($statusByDept as $dept)
                            {{ $dept['not_active'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(220, 53, 69, 0.7)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1
                }
            ]
        };
        
        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: false,
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Status Karyawan per Departemen'
                    }
                }
            }
        });
    });
</script>
@endsection 