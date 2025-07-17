@include('admin.header')
<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Create New Package</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="createPackageForm" method="POST" action="{{ route('admin.packages.store') }}">
                                @csrf

                                <!-- Progress Steps Indicator -->
                                <div class="steps-progress mb-5">
                                    <div class="steps">
                                        <div class="step active" data-step="1" onclick="jumpToStep(1)">
                                            <div class="step-number">1</div>
                                            <div class="step-title">Sender/Receiver</div>
                                        </div>
                                        <div class="step" data-step="2" onclick="jumpToStep(2)">
                                            <div class="step-number">2</div>
                                            <div class="step-title">Package Details</div>
                                        </div>
                                        <div class="step" data-step="3" onclick="jumpToStep(3)">
                                            <div class="step-number">3</div>
                                            <div class="step-title">Shipping</div>
                                        </div>
                                        <div class="step" data-step="4" onclick="jumpToStep(4)">
                                            <div class="step-number">4</div>
                                            <div class="step-title">Tracking</div>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%"></div>
                                    </div>
                                </div>

                                <!-- Step 1: Sender & Receiver Information -->
                                <div class="form-step step-1 animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 1: Sender & Receiver Information</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-header bg-primary text-white">
                                                    <h5>Sender Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="sender_name" class="form-control"
                                                            value="{{ old('sender_name') }}" required>
                                                        <span class="text-danger" id="sender_name_error"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="sender_address" class="form-control"
                                                            value="{{ old('sender_address') }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" name="sender_city"
                                                                    class="form-control"
                                                                    value="{{ old('sender_city') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>State/Province</label>
                                                                <input type="text" name="sender_state"
                                                                    class="form-control"
                                                                    value="{{ old('sender_state') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ZIP/Postal Code</label>
                                                                <input type="text" name="sender_zip"
                                                                    class="form-control"
                                                                    value="{{ old('sender_zip') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select name="sender_country" class="form-control">
                                                                    <option value="">Select Country</option>
                                                                    @foreach(config('countries') as $code => $name)
                                                                    <option value="{{ $name }}" {{
                                                                        old('sender_country')==$name ? 'selected' : ''
                                                                        }}>
                                                                        {{ $name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" name="sender_phone"
                                                                    class="form-control"
                                                                    value="{{ old('sender_phone') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="sender_email"
                                                                    class="form-control"
                                                                    value="{{ old('sender_email') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card mb-4 shadow-sm">
                                                <div class="card-header bg-primary text-white">
                                                    <h5>Receiver Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="receiver_name" class="form-control"
                                                            value="{{ old('receiver_name') }}" required>
                                                        <span class="text-danger" id="receiver_name_error"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="receiver_address" class="form-control"
                                                            value="{{ old('receiver_address') }}">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" name="receiver_city"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_city') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>State/Province</label>
                                                                <input type="text" name="receiver_state"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_state') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ZIP/Postal Code</label>
                                                                <input type="text" name="receiver_zip"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_zip') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select name="receiver_country" class="form-control">
                                                                    <option value="">Select Country</option>
                                                                    @foreach(config('countries') as $code => $name)
                                                                    <option value="{{ $name }}" {{
                                                                        old('receiver_country')==$name ? 'selected' : ''
                                                                        }}>
                                                                        {{ $name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" name="receiver_phone"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_phone') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="receiver_email"
                                                                    class="form-control"
                                                                    value="{{ old('receiver_email') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-primary next-step">
                                            Next <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 2: Package Details -->
                                <div class="form-step step-2 d-none animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 2: Package Details</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tracking Number <span class="text-danger">*</span></label>
                                                <input type="text" name="tracking_number" class="form-control"
                                                    value="{{ old('tracking_number', 'PKG' . strtoupper(uniqid())) }}"
                                                    required>
                                                <span class="text-danger" id="tracking_number_error"></span>
                                                <div class="input-example">Automatically generated tracking number</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Item Description</label>
                                                <textarea name="item_description" class="form-control"
                                                    rows="3">{{ old('item_description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Item Quantity</label>
                                                <input type="number" name="item_quantity" class="form-control"
                                                    value="{{ old('item_quantity', 1) }}">
                                                <div class="input-hint">Please enter only numbers (e.g. 5)</div>
                                                <div class="input-example">Example: 5 (for 5 items)</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Declared Value</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" step="any" name="declared_value"
                                                        class="form-control" value="{{ old('declared_value', 0) }}">
                                                </div>
                                                <div class="input-hint">Please enter only numbers (e.g. 99.99)</div>
                                                <div class="input-example">Example: 99.99 (for $99.99)</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Weight (kg)</label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="total_weight"
                                                        class="form-control" value="{{ old('total_weight', 1) }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                                <div class="input-hint">Please enter only numbers (e.g. 2.5)</div>
                                                <div class="input-example">Example: 2.5 (for 2.5 kilograms)</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Number of Boxes</label>
                                                <input type="number" name="number_of_boxes" class="form-control"
                                                    value="{{ old('number_of_boxes', 1) }}">
                                                <div class="input-hint">Please enter only whole numbers (e.g. 3)</div>
                                                <div class="input-example">Example: 3 (for 3 boxes)</div>
                                            </div>
                                            <div class="form-group">
                                                <label>Box Weight (kg)</label>
                                                <div class="input-group">
                                                    <input type="number" step="any" name="box_weight"
                                                        class="form-control" value="{{ old('box_weight', 1) }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                                <div class="input-hint">Please enter only numbers (e.g. 0.5)</div>
                                                <div class="input-example">Example: 0.5 (for 500 grams)</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-secondary prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step">
                                            Next <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 3: Shipping Details -->
                                <div class="form-step step-3 d-none animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 3: Shipping Details</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shipping From</label>
                                                <input type="text" name="shipping_from" class="form-control"
                                                    value="{{ old('shipping_from') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Shipping Date</label>
                                                <input type="datetime-local" name="shipping_date" class="form-control"
                                                    value="{{ old('shipping_date') }}">
                                                <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shipping To</label>
                                                <input type="text" name="shipping_to" class="form-control"
                                                    value="{{ old('shipping_to') }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Estimated Delivery Date</label>
                                                <input type="datetime-local" name="estimated_delivery_date"
                                                    class="form-control" value="{{ old('estimated_delivery_date') }}">
                                                <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-secondary prev-step">
                                            <i class="fas fa-arrow-left mr-2"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-primary next-step">
                                            Next <i class="fas fa-arrow-right ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 4: Progress Tracking -->
                                <div class="form-step step-4 d-none animated fadeIn">
                                    <h3 class="text-dark mb-4">Step 4: Progress Tracking</h3>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Step</label>
                                                <select name="current_step" class="form-control">
                                                    <option value="1" {{ old('current_step', 1)==1 ? 'selected' : '' }}>
                                                        Step 1: Initiation</option>
                                                    <option value="2" {{ old('current_step', 1)==2 ? 'selected' : '' }}>
                                                        Step 2: Verification</option>
                                                    <option value="3" {{ old('current_step', 1)==3 ? 'selected' : '' }}>
                                                        Step 3: Processing</option>
                                                    <option value="4" {{ old('current_step', 1)==4 ? 'selected' : '' }}>
                                                        Step 4: Completion</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Progress Percentage</label>
                                                <div class="input-group">
                                                    <input type="number" min="0" max="100" name="progress_percentage"
                                                        class="form-control"
                                                        value="{{ old('progress_percentage', 25) }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="input-hint">Enter a value between 0 and 100</div>
                                                <div class="input-example">Example: 75 (for 75% complete)</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Notes</label>
                                                <textarea name="notes" class="form-control"
                                                    rows="3">{{ old('notes') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        @for($i = 1; $i <= 4; $i++) <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Step {{ $i }} Name</label>
                                                <input type="text" name="step{{ $i }}_name" class="form-control"
                                                    value="{{ old('step'.$i.'_name') }}">
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Step {{ $i }} Date</label>
                                            <input type="datetime-local" name="step{{ $i }}_date" class="form-control"
                                                value="{{ old('step'.$i.'_date') }}">
                                            <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>

                                <!-- Tracking Locations -->
                                <div class="card mt-4 shadow-sm">
                                    <div
                                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Tracking Locations</h5>
                                        <button type="button" class="btn btn-sm btn-light" id="addTrackingLocation">
                                            <i class="fas fa-plus"></i> Add Location
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="trackingLocations">
                                            <div class="tracking-location mb-3 p-3 border rounded">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Location Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text"
                                                                name="tracking_locations[0][location_name]"
                                                                class="form-control" required
                                                                value="{{ old('tracking_locations.0.location_name', 'Origin Facility') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Status <span class="text-danger">*</span></label>
                                                            <select name="tracking_locations[0][status]"
                                                                class="form-control" required>
                                                                <option value="Package received" selected>Package
                                                                    received</option>
                                                                <option value="In transit">In transit</option>
                                                                <option value="Out for delivery">Out for delivery
                                                                </option>
                                                                <option value="Delivered">Delivered</option>
                                                                <option value="Exception">Exception</option>
                                                                <option value="On Hold">On Hold</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Arrival Time <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="datetime-local"
                                                                name="tracking_locations[0][arrival_time]"
                                                                class="form-control" required
                                                                value="{{ old('tracking_locations.0.arrival_time', now()->format('Y-m-d\TH:i')) }}">
                                                            <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Current</label>
                                                            <div class="custom-control custom-switch mt-2">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="is_current_0"
                                                                    name="tracking_locations[0][is_current]" value="1"
                                                                    checked>
                                                                <label class="custom-control-label"
                                                                    for="is_current_0"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger remove-location"
                                                    disabled>
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mt-4">
                                    <button type="button" class="btn btn-secondary prev-step">
                                        <i class="fas fa-arrow-left mr-2"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success" id="submitBtn">
                                        <span id="submitText">Create Package</span>
                                        <span id="submitSpinner" class="spinner-border spinner-border-sm d-none"
                                            role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .steps-progress {
        position: relative;
        margin-bottom: 30px;
    }

    .steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .step {
        text-align: center;
        flex: 1;
        position: relative;
        cursor: pointer;
    }

    .step:hover .step-number {
        background-color: #007bff;
        color: white;
        opacity: 0.8;
    }

    .step:hover .step-title {
        color: #007bff;
        font-weight: bold;
    }

    .step-number {
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        margin: 0 auto 10px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .step-title {
        color: #6c757d;
        font-size: 14px;
        transition: all 0.3s;
    }

    .step.active .step-number {
        background-color: #007bff;
        color: white;
    }

    .step.active .step-title {
        color: #007bff;
        font-weight: bold;
    }

    .progress {
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }

    .progress-bar {
        background-color: #007bff;
        transition: width 0.3s;
    }

    .tracking-location {
        background-color: #f8f9fa;
        position: relative;
    }

    .remove-location {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .animated {
        animation-duration: 0.5s;
    }

    /* Input hints and examples */
    .input-hint {
        font-size: 12px;
        color: #dc3545;
        margin-top: 2px;
        display: none;
    }

    .input-example {
        font-size: 12px;
        color: #6c757d;
        font-style: italic;
        margin-top: 2px;
    }

    .is-invalid~.input-hint {
        display: block;
    }

    /* Better error highlighting */
    .is-invalid {
        border-color: #dc3545;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, .25);
    }

    /* Animation classes */
    .fadeOut {
        animation: fadeOut 0.5s;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>

@include('admin.footer')

<script>
    function jumpToStep(stepNumber) {
        // Don't do anything if we're already on this step
        const currentStep = $('.form-step:not(.d-none)');
        if (currentStep.hasClass(`step-${stepNumber}`)) {
            return;
        }

        // Get current step number
        const currentStepNumber = parseInt(currentStep.attr('class').match(/step-(\d+)/)[1]);

        // Only allow going forward or one step back when clicking step numbers
        if (stepNumber < currentStepNumber - 1) {
            return;
        }

        // Validate current step before proceeding if going forward
        if (stepNumber > currentStepNumber && !validateStep(currentStepNumber)) {
            return;
        }

        // Start fade out animation on current step
        currentStep.removeClass('fadeIn').addClass('fadeOut');
        
        // After animation completes
        setTimeout(() => {
            currentStep.addClass('d-none').removeClass('fadeOut');
            
            // Show the selected step
            const nextStep = $(`.step-${stepNumber}`);
            nextStep.removeClass('d-none').addClass('fadeIn');
            
            // Update progress steps
            updateProgressSteps(stepNumber);
            
            // Scroll to top of the form
            $('html, body').animate({
                scrollTop: $('.page-inner').offset().top
            }, 500);
        }, 500);
    }

    function updateProgressSteps(activeStep) {
        // Update step indicators
        $('.step').removeClass('active');
        $(`.step[data-step="${activeStep}"]`).addClass('active');
        
        // Update progress bar
        const progressPercentage = ((activeStep - 1) / 3) * 100;
        $('.progress-bar').css('width', progressPercentage + '%');
        
        // Enable/disable navigation buttons as needed
        $('.prev-step').toggle(activeStep > 1);
        $('.next-step').toggle(activeStep < 4);
        
        // Change next button to submit on last step
        if (activeStep === 4) {
            $('.next-step').addClass('d-none');
        } else {
            $('.next-step').removeClass('d-none');
        }
    }

    function validateStep(stepNumber) {
        let isValid = true;
        
        // Clear previous errors
        $('.text-danger').text('');
        $('.is-invalid').removeClass('is-invalid');
        $('.input-hint').hide();
        
        // Step 1 validation
        if (stepNumber === 1) {
            if (!$('input[name="sender_name"]').val().trim()) {
                $('#sender_name_error').text('Sender name is required');
                $('input[name="sender_name"]').addClass('is-invalid');
                isValid = false;
            }
            
            if (!$('input[name="receiver_name"]').val().trim()) {
                $('#receiver_name_error').text('Receiver name is required');
                $('input[name="receiver_name"]').addClass('is-invalid');
                isValid = false;
            }
        }
        
        // Step 2 validation
        if (stepNumber === 2) {
            if (!$('input[name="tracking_number"]').val().trim()) {
                $('#tracking_number_error').text('Tracking number is required');
                $('input[name="tracking_number"]').addClass('is-invalid');
                isValid = false;
            }
            
            // Check numeric fields
            const numericFields = [
                'item_quantity', 
                'total_weight', 
                'box_weight', 
                'declared_value',
                'number_of_boxes'
            ];
            
            numericFields.forEach(field => {
                const value = $(`input[name="${field}"]`).val();
                if (value && isNaN(value)) {
                    $(`input[name="${field}"]`).addClass('is-invalid');
                    $(`input[name="${field}"]`).siblings('.input-hint').show();
                    isValid = false;
                }
            });
        }
        
        if (!isValid) {
            // Scroll to first error
            $('html, body').animate({
                scrollTop: $('.is-invalid:first').offset().top - 100
            }, 500);
            
            toastr.error('Please correct the highlighted fields');
        }
        
        return isValid;
    }

    $(document).ready(function() {
        // Initialize Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Initialize navigation buttons
        updateProgressSteps(1);

        // Multi-step form navigation
        $('.next-step').on('click', function() {
            const currentStep = $(this).closest('.form-step');
            const nextStep = currentStep.next('.form-step');
            const currentStepNumber = parseInt(currentStep.attr('class').match(/step-(\d+)/)[1]);
            const nextStepNumber = currentStepNumber + 1;

            // Validate current step before proceeding
            if (!validateStep(currentStepNumber)) {
                return;
            }

            // Start fade out animation
            currentStep.removeClass('fadeIn').addClass('fadeOut');
            
            // After animation completes
            setTimeout(() => {
                currentStep.addClass('d-none').removeClass('fadeOut');
                nextStep.removeClass('d-none').addClass('fadeIn');
                
                // Update progress steps
                updateProgressSteps(nextStepNumber);
                
                // Scroll to top of the form
                $('html, body').animate({
                    scrollTop: $('.page-inner').offset().top
                }, 500);
            }, 500);
        });

        $('.prev-step').on('click', function() {
            const currentStep = $(this).closest('.form-step');
            const prevStep = currentStep.prev('.form-step');
            const currentStepNumber = parseInt(currentStep.attr('class').match(/step-(\d+)/)[1]);
            const prevStepNumber = currentStepNumber - 1;

            // Start fade out animation
            currentStep.removeClass('fadeIn').addClass('fadeOut');
            
            // After animation completes
            setTimeout(() => {
                currentStep.addClass('d-none').removeClass('fadeOut');
                prevStep.removeClass('d-none').addClass('fadeIn');
                
                // Update progress steps
                updateProgressSteps(prevStepNumber);
                
                // Scroll to top of the form
                $('html, body').animate({
                    scrollTop: $('.page-inner').offset().top
                }, 500);
            }, 500);
        });

        // Real-time validation for numeric fields
        $('input[name="item_quantity"], input[name="total_weight"], input[name="box_weight"], input[name="declared_value"], input[name="number_of_boxes"]').on('input', function() {
            const value = $(this).val();
            if (value && isNaN(value)) {
                $(this).addClass('is-invalid');
                $(this).siblings('.input-hint').show();
            } else {
                $(this).removeClass('is-invalid');
                $(this).siblings('.input-hint').hide();
            }
        });

        // Add new tracking location
        let locationCounter = 1;
        $('#addTrackingLocation').on('click', function() {
            const newLocation = `
                <div class="tracking-location mb-3 p-3 border rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Location Name <span class="text-danger">*</span></label>
                                <input type="text" name="tracking_locations[${locationCounter}][location_name]" 
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="tracking_locations[${locationCounter}][status]" class="form-control" required>
                                    <option value="Package received">Package received</option>
                                    <option value="In transit" selected>In transit</option>
                                    <option value="Out for delivery">Out for delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Exception">Exception</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Arrival Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="tracking_locations[${locationCounter}][arrival_time]" 
                                    class="form-control" required>
                                <div class="input-example">Format: YYYY-MM-DD HH:MM</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Current</label>
                                <div class="custom-control custom-switch mt-2">
                                    <input type="checkbox" class="custom-control-input" 
                                        id="is_current_${locationCounter}" 
                                        name="tracking_locations[${locationCounter}][is_current]"
                                        value="1">
                                    <label class="custom-control-label" for="is_current_${locationCounter}"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-location">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            `;
            
            $('#trackingLocations').append(newLocation);
            
            // Set current datetime if not set
            $('input[name^="tracking_locations"][name$="[arrival_time]"]:last').val(new Date().toISOString().slice(0, 16));
            
            locationCounter++;
        });

        // Remove tracking location
        $(document).on('click', '.remove-location', function() {
            if ($('.tracking-location').length > 1) {
                $(this).closest('.tracking-location').remove();
            } else {
                toastr.error('You must have at least one tracking location');
            }
        });

        // Form submission handling
        $('#createPackageForm').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const submitBtn = $('#submitBtn');
            const submitText = $('#submitText');
            const submitSpinner = $('#submitSpinner');

            // Show loading state
            submitText.text('Creating...');
            submitSpinner.removeClass('d-none');
            submitBtn.prop('disabled', true);

            // Clear previous errors
            $('.text-danger').text('');
            $('.is-invalid').removeClass('is-invalid');
            $('.input-hint').hide();

            // Prepare form data
            const formData = new FormData(this);

            // Add CSRF token to headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.status === 'success') {
                        toastr.success(response.message);
                        
                        // Redirect after delay
                        setTimeout(() => {
                            window.location.href = response.redirect || "{{ route('admin.packages.index') }}";
                        }, 1500);
                    } else {
                        toastr.error(response.message || 'An error occurred');
                    }
                },
                error: function(xhr) {
                    if(xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        
                        // Display validation errors
                        for(const field in errors) {
                            // Handle array fields (like tracking_locations)
                            if (field.includes('tracking_locations')) {
                                const matches = field.match(/tracking_locations\.(\d+)\.(\w+)/);
                                if (matches) {
                                    const index = matches[1];
                                    const fieldName = matches[2];
                                    
                                    // Find the specific input and show error
                                    const input = $(`input[name="tracking_locations[${index}][${fieldName}]"]`);
                                    const select = $(`select[name="tracking_locations[${index}][${fieldName}]"]`);
                                    
                                    if (input.length) {
                                        input.addClass('is-invalid');
                                        input.after(`<span class="text-danger">${errors[field][0]}</span>`);
                                    } else if (select.length) {
                                        select.addClass('is-invalid');
                                        select.after(`<span class="text-danger">${errors[field][0]}</span>`);
                                    }
                                }
                            } else {
                                // Handle regular fields
                                const input = $(`[name="${field}"]`);
                                if (input.length) {
                                    input.addClass('is-invalid');
                                    const errorElement = $(`#${field}_error`);
                                    if (errorElement.length) {
                                        errorElement.text(errors[field][0]);
                                    } else {
                                        input.after(`<span class="text-danger" id="${field}_error">${errors[field][0]}</span>`);
                                    }
                                }
                            }
                        }
                        
                        toastr.error('Please fix the validation errors');
                    } else {
                        toastr.error('An error occurred while creating the package');
                    }
                },
                complete: function() {
                    submitText.text('Create Package');
                    submitSpinner.addClass('d-none');
                    submitBtn.prop('disabled', false);
                }
            });
        });

        // Initialize date pickers
        $('input[type="date"]').attr('min', new Date().toISOString().split('T')[0]);
        $('input[type="datetime-local"]').each(function() {
            if(!$(this).val()) {
                $(this).val(new Date().toISOString().slice(0, 16));
            }
        });
    });
</script>