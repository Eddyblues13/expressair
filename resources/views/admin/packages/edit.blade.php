@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="title1 text-dark">Edit Package</h1>
                    <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Package
                    </a>
                </div>
            </div>

            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-light">
                        <form id="editPackageForm" action="{{ route('admin.packages.update', $package->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Similar to create form but with existing values -->
                            <div class="form-step step-1">
                                <h3 class="text-dark mb-4">Step 1: Sender Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Sender Name</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_name"
                                            value="{{ old('sender_name', $package->sender_name) }}" required>
                                        <span class="text-danger" id="sender_name_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Sender Email</h5>
                                        <input class="form-control text-dark bg-light" type="email" name="sender_email"
                                            value="{{ old('sender_email', $package->sender_email) }}" required>
                                        <span class="text-danger" id="sender_email_error"></span>
                                    </div>
                                    <!-- Other sender fields with old('field', $package->field) -->
                                </div>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 2: Receiver Information -->
                            <div class="form-step step-2 d-none">
                                <h3 class="text-dark mb-4">Step 2: Receiver Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Receiver Name</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="receiver_name"
                                            value="{{ old('receiver_name', $package->receiver_name) }}" required>
                                        <span class="text-danger" id="receiver_name_error"></span>
                                    </div>
                                    <!-- Other receiver fields with old('field', $package->field) -->
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 3: Package Details -->
                            <div class="form-step step-3 d-none">
                                <h3 class="text-dark mb-4">Step 3: Package Details</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Tracking Number</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="tracking_number"
                                            value="{{ old('tracking_number', $package->tracking_number) }}" required>
                                        <span class="text-danger" id="tracking_number_error"></span>
                                    </div>
                                    <!-- Other package fields with old('field', $package->field) -->
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 4: Shipping Information -->
                            <div class="form-step step-4 d-none">
                                <h3 class="text-dark mb-4">Step 4: Shipping Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Shipping From</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="shipping_from"
                                            value="{{ old('shipping_from', $package->shipping_from) }}" required>
                                        <span class="text-danger" id="shipping_from_error"></span>
                                    </div>
                                    <!-- Other shipping fields with old('field', $package->field) -->
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Update Package</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Multi-step form navigation (same as create)
        $('.next-step').on('click', function() {
            const currentStep = $(this).closest('.form-step');
            const nextStep = currentStep.next('.form-step');

            currentStep.addClass('d-none');
            nextStep.removeClass('d-none');
        });

        $('.prev-step').on('click', function() {
            const currentStep = $(this).closest('.form-step');
            const prevStep = currentStep.prev('.form-step');

            currentStep.addClass('d-none');
            prevStep.removeClass('d-none');
        });

        // Form submission with loading state
        $('#editPackageForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $('.text-danger').text('');
            
            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true);
            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect || "{{ route('admin.packages.show', $package->id) }}";
                        }, 1500);
                    } else {
                        toastr.error(response.message || 'An error occurred');
                        submitBtn.prop('disabled', false);
                        submitBtn.text('Update Package');
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(field, messages) {
                            $('#' + field + '_error').text(messages[0]);
                        });
                    }
                    toastr.error(response.responseJSON.message || 'Please correct the errors and try again.');
                    submitBtn.prop('disabled', false);
                    submitBtn.text('Update Package');
                }
            });
        });
    });
</script>

@include('admin.footer')