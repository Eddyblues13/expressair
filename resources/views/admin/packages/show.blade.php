@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif

            <div class="mt-2 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-dark">Package Details</h1>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-light">
                        <div class="row">
                            <!-- Package Info -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Package Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Tracking Number:</th>
                                                    <td>{{ $package->tracking_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Item Description:</th>
                                                    <td>{{ $package->item_description }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Quantity:</th>
                                                    <td>{{ $package->item_quantity }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Declared Value:</th>
                                                    <td>${{ number_format($package->declared_value, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Weight:</th>
                                                    <td>{{ $package->total_weight }} kg</td>
                                                </tr>
                                                <tr>
                                                    <th>Number of Boxes:</th>
                                                    <td>{{ $package->number_of_boxes }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Box Weight:</th>
                                                    <td>{{ $package->box_weight }} kg</td>
                                                </tr>
                                                <tr>
                                                    <th>Notes:</th>
                                                    <td>{{ $package->notes ?? 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Info -->
                                <div class="card mb-4">
                                    <div class="card-header bg-info text-white">
                                        <h4 class="mb-0">Shipping Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Shipping From:</th>
                                                    <td>{{ $package->shipping_from }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping To:</th>
                                                    <td>{{ $package->shipping_to }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Date:</th>
                                                    <td>{{ $package->shipping_date->format('M d, Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Est. Delivery Date:</th>
                                                    <td>{{ $package->estimated_delivery_date->format('M d, Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Current Status:</th>
                                                    <td>
                                                        @php
                                                        $latestStatus =
                                                        $package->trackingLocations->sortByDesc('arrival_time')->first()->status
                                                        ?? 'Unknown';
                                                        @endphp
                                                        <span class="badge 
                                                            @if(str_contains($latestStatus, 'Delivered')) badge-success
                                                            @elseif(str_contains($latestStatus, 'Shipped') || str_contains($latestStatus, 'Transit')) badge-info
                                                            @elseif(str_contains($latestStatus, 'Pending')) badge-warning
                                                            @else badge-secondary @endif">
                                                            {{ $latestStatus }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Progress:</th>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated 
                                                                @if($package->progress_percentage == 100) bg-success
                                                                @elseif($package->progress_percentage >= 50) bg-info
                                                                @else bg-warning @endif" role="progressbar"
                                                                style="width: {{ $package->progress_percentage }}%"
                                                                aria-valuenow="{{ $package->progress_percentage }}"
                                                                aria-valuemin="0" aria-valuemax="100">
                                                                {{ $package->progress_percentage }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sender/Receiver Info -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h4 class="mb-0">Sender Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>{{ $package->sender_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email:</th>
                                                    <td>{{ $package->sender_email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>{{ $package->sender_phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>{{ $package->sender_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City/State/Zip:</th>
                                                    <td>{{ $package->sender_city }}, {{ $package->sender_state }} {{
                                                        $package->sender_zip }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td>{{ $package->sender_country }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-warning text-dark">
                                        <h4 class="mb-0">Receiver Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>{{ $package->receiver_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email:</th>
                                                    <td>{{ $package->receiver_email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>{{ $package->receiver_phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>{{ $package->receiver_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City/State/Zip:</th>
                                                    <td>{{ $package->receiver_city }}, {{ $package->receiver_state }} {{
                                                        $package->receiver_zip }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td>{{ $package->receiver_country }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tracking History -->
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Tracking History</h4>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addTrackingModal">
                                        <i class="fas fa-plus"></i> Add Tracking Update
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    @foreach($trackingLocations->sortByDesc('arrival_time') as $location)
                                    <div class="timeline-item @if($location->is_current) current @endif">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-indicator bg-
                                                @if(str_contains($location->status, 'Delivered')) success
                                                @elseif(str_contains($location->status, 'Shipped') || str_contains($location->status, 'Transit')) info
                                                @elseif(str_contains($location->status, 'Pending')) warning
                                                @else danger @endif">
                                            </div>
                                        </div>
                                        <div class="timeline-item-content">
                                            <div class="d-flex justify-content-between">
                                                <h5>{{ $location->status }}</h5>
                                                <small class="text-muted">{{ $location->arrival_time->format('M d, Y h:i
                                                    A') }}</small>
                                            </div>
                                            <p class="mb-1">{{ $location->location_name }}</p>
                                            @if($location->is_current)
                                            <span class="badge badge-primary">Current Location</span>
                                            @endif
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-info edit-tracking"
                                                    data-id="{{ $location->id }}" data-status="{{ $location->status }}"
                                                    data-location="{{ $location->location_name }}"
                                                    data-arrival="{{ $location->arrival_time->format('Y-m-d\TH:i') }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('admin.tracking.destroy', $location->id) }}"
                                                    method="POST" class="d-inline delete-tracking-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Tracking Modal -->
<div class="modal fade" id="addTrackingModal" tabindex="-1" role="dialog" aria-labelledby="addTrackingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrackingModalLabel">Add Tracking Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addTrackingForm" action="{{ route('admin.packages.tracking.store', $package->id) }}"
                method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Location Name</label>
                        <input type="text" class="form-control" name="location_name" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Package Created">Package Created</option>
                            <option value="Processing">Processing</option>
                            <option value="Shipped">Shipped</option>
                            <option value="In Transit">In Transit</option>
                            <option value="Out for Delivery">Out for Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Returned">Returned</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Arrival Time</label>
                        <input type="datetime-local" class="form-control" name="arrival_time" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tracking Modal -->
<div class="modal fade" id="editTrackingModal" tabindex="-1" role="dialog" aria-labelledby="editTrackingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTrackingModalLabel">Edit Tracking Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTrackingForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Location Name</label>
                        <input type="text" class="form-control" name="location_name" id="editLocationName" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="editStatus" required>
                            <option value="Package Created">Package Created</option>
                            <option value="Processing">Processing</option>
                            <option value="Shipped">Shipped</option>
                            <option value="In Transit">In Transit</option>
                            <option value="Out for Delivery">Out for Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Returned">Returned</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Arrival Time</label>
                        <input type="datetime-local" class="form-control" name="arrival_time" id="editArrivalTime"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Add tracking form submission
        $('#addTrackingForm').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitBtn = $(form).find('button[type="submit"]');
            
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
            
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#addTrackingModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function(response) {
                    toastr.error(response.responseJSON.message || 'Failed to add tracking update');
                    submitBtn.prop('disabled', false).text('Save Update');
                }
            });
        });
        
        // Edit tracking modal setup
        $('.edit-tracking').on('click', function() {
            const id = $(this).data('id');
            const status = $(this).data('status');
            const location = $(this).data('location');
            const arrival = $(this).data('arrival');
            
            $('#editTrackingForm').attr('action', '/admin/tracking/' + id);
            $('#editLocationName').val(location);
            $('#editStatus').val(status);
            $('#editArrivalTime').val(arrival);
            
            $('#editTrackingModal').modal('show');
        });
        
        // Edit tracking form submission
        $('#editTrackingForm').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            const submitBtn = $(form).find('button[type="submit"]');
            
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
            
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#editTrackingModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function(response) {
                    toastr.error(response.responseJSON.message || 'Failed to update tracking');
                    submitBtn.prop('disabled', false).text('Save Changes');
                }
            });
        });
        
        // Delete tracking location
        $('.delete-tracking-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }
                        },
                        error: function(response) {
                            toastr.error(response.responseJSON.message || 'Failed to delete tracking update');
                        }
                    });
                }
            });
        });
    });
</script>

<style>
    .timeline {
        position: relative;
        padding-left: 1rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
        padding-left: 1.5rem;
        border-left: 1px solid #dee2e6;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item-marker {
        position: absolute;
        left: -0.5rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        background-color: #fff;
        border: 3px solid #dee2e6;
    }

    .timeline-item-marker-indicator {
        position: absolute;
        top: 0.25rem;
        left: 0.25rem;
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 50%;
    }

    .timeline-item-content {
        padding: 0.5rem 0.75rem;
        background-color: #f8f9fa;
        border-radius: 0.25rem;
    }

    .timeline-item.current {
        border-left-color: #007bff;
    }

    .timeline-item.current .timeline-item-marker {
        border-color: #007bff;
    }
</style>

@include('admin.footer')