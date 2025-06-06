@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-dark">All Packages</h1>
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New Package
                    </a>
                </div>
            </div>

            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-light">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tracking #</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Status</th>
                                        <th>Progress</th>
                                        <th>Shipping Date</th>
                                        <th>Est. Delivery</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($packages as $package)
                                    <tr>
                                        <td>{{ $package->tracking_number }}</td>
                                        <td>{{ $package->sender_name }}</td>
                                        <td>{{ $package->receiver_name }}</td>
                                        <td>
                                            @php
                                            $latestStatus =
                                            $package->trackingLocations->sortByDesc('arrival_time')->first()->status ??
                                            'Unknown';
                                            @endphp
                                            <span class="badge 
                                                @if(str_contains($latestStatus, 'Delivered')) badge-success
                                                @elseif(str_contains($latestStatus, 'Shipped') || str_contains($latestStatus, 'Transit')) badge-info
                                                @elseif(str_contains($latestStatus, 'Pending')) badge-warning
                                                @else badge-secondary @endif">
                                                {{ $latestStatus }}
                                            </span>
                                        </td>
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
                                        <td>{{ $package->shipping_date->format('M d, Y') }}</td>
                                        <td>{{ $package->estimated_delivery_date->format('M d, Y') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.packages.show', $package->id) }}"
                                                    class="btn btn-sm btn-info mr-2" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.packages.edit', $package->id) }}"
                                                    class="btn btn-sm btn-primary mr-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                                    method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No packages found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $packages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Delete confirmation
        $('.delete-form').on('submit', function(e) {
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
                                $(form).closest('tr').fadeOut(300, function() {
                                    $(this).remove();
                                });
                            }
                        },
                        error: function(response) {
                            toastr.error(response.responseJSON.message || 'Failed to delete package');
                        }
                    });
                }
            });
        });
    });
</script>

@include('admin.footer')