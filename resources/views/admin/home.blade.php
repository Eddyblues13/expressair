@include('admin.header')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Square button styling */
    .square-btn {
        height: 100%;
        width: 100%;
        min-height: 120px;
        padding: 15px 10px;
        border-radius: 8px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .square-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .square-btn .btn-label {
        font-size: 0.9rem;
        font-weight: 500;
        text-align: center;
    }

    /* Status badges */
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-processing {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-in-transit {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-delivered {
        background-color: #d4edda;
        color: #155724;
    }

    .status-failed {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Progress bar styling */
    .progress-thin {
        height: 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .square-btn {
            min-height: 100px;
            padding: 10px 5px;
        }

        .square-btn i {
            font-size: 1.5rem !important;
            margin-bottom: 5px !important;
        }

        .square-btn .btn-label {
            font-size: 0.8rem;
        }
    }
</style>
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title text-dark"><i class="fas fa-tachometer-alt mr-2"></i>Shipping Dashboard</h4>
            </div>

            <!-- Stats Cards Row -->
            <div class="row">
                <!-- Total Shipments Card -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-primary card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Shipments</p>
                                        <h4 class="card-title">{{ $totalPackagesCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- In Transit Card -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-info card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-shipping-fast"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">In Transit</p>
                                        <h4 class="card-title">{{ $inTransitCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivered Card -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-success card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Delivered</p>
                                        <h4 class="card-title">{{ $deliveredCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Issues Card -->
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-danger card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">With Issues</p>
                                        <h4 class="card-title">{{ $issuesCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Row -->
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-dark">Quick Actions</h4>
                        </div>
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6 col-md-3 mb-3">
                                    <a href="{{ route('admin.packages.create') }}"
                                        class="btn btn-primary btn-block square-btn">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-plus-circle fa-2x mb-2"></i>
                                            <span class="btn-label">New Shipment</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-3 mb-3">
                                    <a href="{{ route('admin.packages.index') }}"
                                        class="btn btn-info btn-block square-btn">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-list fa-2x mb-2"></i>
                                            <span class="btn-label">All Shipments</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-3 mb-3">
                                    <a href="{{ route('admin.packages.index') }}"
                                        class="btn btn-warning btn-block square-btn">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-users fa-2x mb-2"></i>
                                            <span class="btn-label">Customers</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-md-3 mb-3">
                                    <a href="{{ route('admin.packages.index') }}"
                                        class="btn btn-secondary btn-block square-btn">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                            <span class="btn-label">Reports</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title text-dark">Shipment Analytics</h4>
                                <div class="card-tools">
                                    <select class="form-control form-control-sm" id="analyticsPeriod">
                                        <option value="week">Last Week</option>
                                        <option value="month" selected>Last Month</option>
                                        <option value="year">Last Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="shipmentAnalyticsChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-dark">Shipment Status</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="shipmentStatusChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title text-dark">Recent Shipments</h4>
                                <div class="card-tools">
                                    <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-primary">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tracking #</th>
                                            <th>Receiver</th>
                                            <th>Status</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentPackages as $package)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.packages.edit', $package->id) }}">
                                                    {{ $package->tracking_number }}
                                                </a>
                                            </td>
                                            <td>{{ $package->receiver_name }}</td>
                                            <td>
                                                @if($package->current_step == 4)
                                                <span class="status-badge status-delivered">Delivered</span>
                                                @elseif($package->current_step > 1)
                                                <span class="status-badge status-in-transit">In Transit</span>
                                                @else
                                                <span class="status-badge status-processing">Processing</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: {{ $package->progress_percentage }}%"
                                                        aria-valuenow="{{ $package->progress_percentage }}"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <small>{{ $package->progress_percentage }}%</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title text-dark">Recent Tracking Updates</h4>
                                <div class="card-tools">
                                    <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-info">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tracking #</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentTracking as $tracking)
                                        <tr>
                                            <td>{{ $tracking->package->tracking_number ?? 'N/A' }}</td>
                                            <td>{{ $tracking->location }}</td>
                                            <td>
                                                @if($tracking->status == 'delivered')
                                                <span class="status-badge status-delivered">Delivered</span>
                                                @elseif($tracking->status == 'in_transit')
                                                <span class="status-badge status-in-transit">In Transit</span>
                                                @else
                                                <span class="status-badge status-processing">Processing</span>
                                                @endif
                                            </td>
                                            <td>{{ $tracking->created_at->format('M d, H:i') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Shipment Analytics Chart
        const shipmentCtx = document.getElementById('shipmentAnalyticsChart').getContext('2d');
        const shipmentChart = new Chart(shipmentCtx, {
            type: 'line',
            data: {
                labels: @json($shipmentAnalytics['labels']),
                datasets: [{
                    label: 'Shipments Created',
                    data: @json($shipmentAnalytics['data']),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Shipment Status Chart
        const statusCtx = document.getElementById('shipmentStatusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Processing', 'In Transit', 'Delivered', 'With Issues'],
                datasets: [{
                    data: @json($shipmentStatusData),
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Period selector change
        $('#analyticsPeriod').change(function() {
            const period = $(this).val();
            
            $.ajax({
                url: "{{ route('admin.dashboard.analytics') }}",
                type: "GET",
                data: { period: period },
                success: function(response) {
                    shipmentChart.data.labels = response.labels;
                    shipmentChart.data.datasets[0].data = response.data;
                    shipmentChart.update();
                }
            });
        });
    });
</script>

@include('admin.footer')