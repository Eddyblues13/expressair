@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Update Admin Unique ID</h1>
            </div>
 
            <div class="card bg-light">
                <div class="card-body">
                    <form id="updateUniqueIdForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h5 class="text-dark">Current Unique ID</h5>
                                <input class="form-control text-dark bg-light"
                                    value="{{ Auth::guard('admin')->user()->unique_id }}" type="text"
                                    id="current_unique_id" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 class="text-dark">New Unique ID</h5>
                                <input class="form-control text-dark bg-light" type="text" name="unique_id"
                                    id="new_unique_id" required>
                                <span class="text-danger" id="unique_id_error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Unique ID</button>
                            <a href="{{ route('admin.home') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const currentUniqueId = "{{ Auth::guard('admin')->user()->unique_id }}";
        $('#updateUniqueIdForm').attr('action', `/admin/${currentUniqueId}/update-unique-id`);

        $('#updateUniqueIdForm').on('submit', function (e) {
            e.preventDefault();
            const formData = $(this).serialize();
            const url = $(this).attr('action');
            $('#unique_id_error').text('');

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.admins.edit-unique-id') }}";
                    }, 1500);
                },
                error: function (response) {
                    if (response.status === 422) {
                        $('#unique_id_error').text(response.responseJSON.errors.unique_id[0]);
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                }
            });
        });
    });
</script>

@include('admin.footer')