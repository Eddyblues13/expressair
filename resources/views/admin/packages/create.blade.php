<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Create New Package</h1>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-light">
                        <form id="packageForm" action="{{ route('admin.packages.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Step 1: Sender Information -->
                            <div class="form-step step-1">
                                <h3 class="text-dark mb-4">Step 1: Sender Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Sender Name</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_name"
                                            value="{{ old('sender_name') }}" required>
                                        <span class="text-danger" id="sender_name_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Sender Email</h5>
                                        <input class="form-control text-dark bg-light" type="email" name="sender_email"
                                            value="{{ old('sender_email') }}" required>
                                        <span class="text-danger" id="sender_email_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Sender Phone</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_phone"
                                            value="{{ old('sender_phone') }}" required>
                                        <span class="text-danger" id="sender_phone_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Sender Address</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_address"
                                            value="{{ old('sender_address') }}" required>
                                        <span class="text-danger" id="sender_address_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Sender City</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_city"
                                            value="{{ old('sender_city') }}" required>
                                        <span class="text-danger" id="sender_city_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Sender State</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_state"
                                            value="{{ old('sender_state') }}" required>
                                        <span class="text-danger" id="sender_state_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Sender Zip</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_zip"
                                            value="{{ old('sender_zip') }}" required>
                                        <span class="text-danger" id="sender_zip_error"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h5 class="text-dark">Sender Country</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="sender_country"
                                            value="{{ old('sender_country') }}" required>
                                        <span class="text-danger" id="sender_country_error"></span>
                                    </div>
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
                                            value="{{ old('receiver_name') }}" required>
                                        <span class="text-danger" id="receiver_name_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Receiver Email</h5>
                                        <input class="form-control text-dark bg-light" type="email"
                                            name="receiver_email" value="{{ old('receiver_email') }}" required>
                                        <span class="text-danger" id="receiver_email_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Receiver Phone</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="receiver_phone"
                                            value="{{ old('receiver_phone') }}" required>
                                        <span class="text-danger" id="receiver_phone_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Receiver Address</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="receiver_address" value="{{ old('receiver_address') }}" required>
                                        <span class="text-danger" id="receiver_address_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Receiver City</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="receiver_city"
                                            value="{{ old('receiver_city') }}" required>
                                        <span class="text-danger" id="receiver_city_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Receiver State</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="receiver_state"
                                            value="{{ old('receiver_state') }}" required>
                                        <span class="text-danger" id="receiver_state_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Receiver Zip</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="receiver_zip"
                                            value="{{ old('receiver_zip') }}" required>
                                        <span class="text-danger" id="receiver_zip_error"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h5 class="text-dark">Receiver Country</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="receiver_country" value="{{ old('receiver_country') }}" required>
                                        <span class="text-danger" id="receiver_country_error"></span>
                                    </div>
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
                                            name="tracking_number" value="{{ old('tracking_number') }}" required>
                                        <span class="text-danger" id="tracking_number_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Item Description</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="item_description" value="{{ old('item_description') }}" required>
                                        <span class="text-danger" id="item_description_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Item Quantity</h5>
                                        <input class="form-control text-dark bg-light" type="number"
                                            name="item_quantity" value="{{ old('item_quantity', 1) }}" required>
                                        <span class="text-danger" id="item_quantity_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Declared Value</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="declared_value" value="{{ old('declared_value') }}" required>
                                        <span class="text-danger" id="declared_value_error"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <h5 class="text-dark">Total Weight (kg)</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="total_weight" value="{{ old('total_weight') }}" required>
                                        <span class="text-danger" id="total_weight_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Number of Boxes</h5>
                                        <input class="form-control text-dark bg-light" type="number"
                                            name="number_of_boxes" value="{{ old('number_of_boxes', 1) }}" required>
                                        <span class="text-danger" id="number_of_boxes_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Box Weight (kg)</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="box_weight" value="{{ old('box_weight') }}" required>
                                        <span class="text-danger" id="box_weight_error"></span>
                                    </div>
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
                                            value="{{ old('shipping_from') }}" required>
                                        <span class="text-danger" id="shipping_from_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Shipping To</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="shipping_to"
                                            value="{{ old('shipping_to') }}" required>
                                        <span class="text-danger" id="shipping_to_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Shipping Date</h5>
                                        <input class="form-control text-dark bg-light" type="date" name="shipping_date"
                                            value="{{ old('shipping_date') }}" required>
                                        <span class="text-danger" id="shipping_date_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Estimated Delivery Date</h5>
                                        <input class="form-control text-dark bg-light" type="date"
                                            name="estimated_delivery_date" value="{{ old('estimated_delivery_date') }}"
                                            required>
                                        <span class="text-danger" id="estimated_delivery_date_error"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h5 class="text-dark">Notes</h5>
                                        <textarea class="form-control text-dark bg-light"
                                            name="notes">{{ old('notes') }}</textarea>
                                        <span class="text-danger" id="notes_error"></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Create Package</button>
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
        // Multi-step form navigation
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
        $('#packageForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('.text-danger').text('');
            
            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true);
            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...');

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect || "{{ route('admin.packages.index') }}";
                        }, 1500);
                    } else {
                        toastr.error(response.message || 'An error occurred');
                        submitBtn.prop('disabled', false);
                        submitBtn.text('Create Package');
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
                    submitBtn.text('Create Package');
                }
            });
        });
    });
</script>