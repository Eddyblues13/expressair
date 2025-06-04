@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <h1 class="title1 text-dark">Manage Packages</h1>
                <a href="{{ route('admin.packages.create') }}" class="btn btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add New Package
                </a>
            </div>

            <!-- Search Filter -->
            <div class="mb-3">
                <input type="text" id="packageSearch" class="form-control"
                    placeholder="Search by sender, receiver or tracking number...">
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="packagesTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tracking #</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->tracking_number }}</td>
                                    <td>{{ $package->sender_name }}</td>
                                    <td>{{ $package->receiver_name }}</td>


                                    <td>
                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger delete-package"
                                            data-id="{{ $package->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $packages->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this package? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let deleteId;

        // Delete handler
        $('.delete-package').click(function() {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDelete').click(function() {
            $.ajax({
                url: '/admin/packages/' + deleteId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#deleteModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function() {
                    toastr.error('An error occurred while deleting the package.');
                }
            });
        });

        // JavaScript Table Filter
        $('#packageSearch').on('keyup', function() {
            let value = $(this).val().toLowerCase();
            $('#packagesTable tbody tr').filter(function() {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                );
            });
        });
    });
</script>

@include('admin.footer')