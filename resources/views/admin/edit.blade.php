@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Edit User</h1>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-light">
                        <form id="editUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Step 1: Basic Information -->
                            <div class="form-step step-1">
                                <h3 class="text-dark mb-4">Step 1: Basic Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Full Name</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="name"
                                            value="{{ old('name', $user->name) }}" required>
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Email Address</h5>
                                        <input class="form-control text-dark bg-light" type="email" name="email"
                                            value="{{ old('email', $user->email) }}" required>
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Password (leave blank to keep current)</h5>
                                        <input class="form-control text-dark bg-light" type="password" name="password">
                                        <span class="text-danger" id="password_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Confirm Password</h5>
                                        <input class="form-control text-dark bg-light" type="password"
                                            name="password_confirmation">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Profile Image</h5>
                                        <input class="form-control text-dark bg-light" type="file" name="profile_image">
                                        @if($user->profile_image)
                                        <div class="mt-2">
                                            <img src="{{ asset($user->profile_image) }}" width="100"
                                                class="img-thumbnail">
                                        </div>
                                        @endif
                                        <span class="text-danger" id="profile_image_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Status</h5>
                                        <select class="form-control text-dark bg-light" name="status" required>
                                            <option value="active" {{ old('status', $user->status) == 'active' ?
                                                'selected' : '' }}>Active</option>
                                            <option value="pending" {{ old('status', $user->status) == 'pending' ?
                                                'selected' : '' }}>Pending</option>
                                            <option value="suspended" {{ old('status', $user->status) == 'suspended' ?
                                                'selected' : '' }}>Suspended</option>
                                        </select>
                                        <span class="text-danger" id="status_error"></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 2: Wallet Information -->
                            <div class="form-step step-2 d-none">
                                <h3 class="text-dark mb-4">Step 2: Wallet Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Wallet Type</h5>
                                        <select class="form-control text-dark bg-light"
                                            name="payment_instruction_currency">
                                            <option value="BTC" {{ old('payment_instruction_currency', $user->
                                                payment_instruction_currency) == 'BTC' ? 'selected' : '' }}>BTC</option>
                                            <option value="ETH" {{ old('payment_instruction_currency', $user->
                                                payment_instruction_currency) == 'ETH' ? 'selected' : '' }}>ETH</option>
                                            <option value="USDT" {{ old('payment_instruction_currency', $user->
                                                payment_instruction_currency) == 'USDT' ? 'selected' : '' }}>USDT
                                            </option>
                                        </select>
                                        <span class="text-danger" id="payment_instruction_currency_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Wallet Address</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="payment_wallet_address"
                                            value="{{ old('payment_wallet_address', $user->payment_wallet_address) }}">
                                        <span class="text-danger" id="payment_wallet_address_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Amount</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="payment_amount"
                                            value="{{ old('payment_amount', $user->payment_amount) }}">
                                        <span class="text-danger" id="payment_amount_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Total Amount</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="total_amount" value="{{ old('total_amount', $user->total_amount) }}">
                                        <span class="text-danger" id="total_amount_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Charges/Fee</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="receiver_company"
                                            value="{{ old('receiver_company', $user->receiver_company) }}">
                                        <span class="text-danger" id="receiver_company_error"></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 3: Payment Information -->
                            <div class="form-step step-3 d-none">
                                <h3 class="text-dark mb-4">Step 3: Payment Information</h3>
                                <div class="form-group mb-4">
                                    <h5 class="text-dark">User Payment Method</h5>
                                    <select class="form-control text-dark bg-light" id="paymentMethod"
                                        name="payment_method" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="wallet" {{ old('payment_method', $user->payment_method) ==
                                            'wallet' ? 'selected' : '' }}>Wallet Transfer</option>
                                        <option value="bank" {{ old('payment_method', $user->payment_method) == 'bank' ?
                                            'selected' : '' }}>Bank Transfer</option>
                                    </select>
                                    <span class="text-danger" id="payment_method_error"></span>
                                </div>

                                <!-- Wallet Details -->
                                <div id="walletDetails"
                                    class="{{ old('payment_method', $user->payment_method) != 'bank' ? '' : 'd-none' }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Receiver Wallet Address</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="receiver_wallet_address"
                                                value="{{ old('receiver_wallet_address', $user->receiver_wallet_address) }}">
                                            <span class="text-danger" id="receiver_wallet_address_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Receiver Wallet Type</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="wallet_type" value="{{ old('wallet_type', $user->wallet_type) }}">
                                            <span class="text-danger" id="wallet_type_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Details -->
                                <div id="bankDetails"
                                    class="{{ old('payment_method', $user->payment_method) == 'bank' ? '' : 'd-none' }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Bank Name</h5>
                                            <input class="form-control text-dark bg-light" type="text" name="bank_name"
                                                value="{{ old('bank_name', $user->bank_name) }}">
                                            <span class="text-danger" id="bank_name_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Transaction ID</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="account_number"
                                                value="{{ old('account_number', $user->account_number) }}">
                                            <span class="text-danger" id="account_number_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Account Name</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="account_name"
                                                value="{{ old('account_name', $user->account_name) }}">
                                            <span class="text-danger" id="account_name_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Routing/Swift</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="routing_number"
                                                value="{{ old('routing_number', $user->routing_number) }}">
                                            <span class="text-danger" id="routing_number_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Amount sent</h5>
                                            <input class="form-control text-dark bg-light" type="text" name="sort_code"
                                                value="{{ old('sort_code', $user->sort_code) }}">
                                            <span class="text-danger" id="sort_code_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Destination Country</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="bank_address"
                                                value="{{ old('bank_address', $user->bank_address) }}">
                                            <span class="text-danger" id="bank_address_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 4: Additional Information -->
                            <div class="form-step step-4 d-none">
                                <h3 class="text-dark mb-4">Step 4: Additional Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h5 class="text-dark">Special Notes</h5>
                                        <textarea class="form-control text-dark bg-light"
                                            name="special_notes">{{ old('special_notes', $user->special_notes) }}</textarea>
                                        <span class="text-danger" id="special_notes_error"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h5 class="text-dark">Security Message</h5>
                                        <textarea class="form-control text-dark bg-light"
                                            name="security_message">{{ old('security_message', $user->security_message) }}</textarea>
                                        <span class="text-danger" id="security_message_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Expires At</h5>
                                        <input class="form-control text-dark bg-light" type="datetime-local"
                                            name="payment_expires_at"
                                            value="{{ old('payment_expires_at', $user->payment_expires_at ? $user->payment_expires_at->format('Y-m-d\TH:i') : '') }}">
                                        <span class="text-danger" id="payment_expires_at_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Status</h5>
                                        <select class="form-control text-dark bg-light" name="payment_status">
                                            <option value="inactive" {{ old('payment_status', $user->payment_status) ==
                                                'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="pending" {{ old('payment_status', $user->payment_status) ==
                                                'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ old('payment_status', $user->payment_status) ==
                                                'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="expired" {{ old('payment_status', $user->payment_status) ==
                                                'expired' ? 'selected' : '' }}>Expired</option>
                                            <option value="failed" {{ old('payment_status', $user->payment_status) ==
                                                'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        <span class="text-danger" id="payment_status_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Total Refundable Amount</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="spread_fee" value="{{ old('spread_fee', $user->spread_fee) }}">
                                        <span class="text-danger" id="spread_fee_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Fee Reason</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="fee_reason"
                                            value="{{ old('fee_reason', $user->fee_reason) }}">
                                        <span class="text-danger" id="fee_reason_error"></span>
                                    </div>

                                    <!-- Progress Tracking Fields -->
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Current Progress Step</h5>
                                        <select class="form-control text-dark bg-light" name="progress_step">
                                            <option value="1" {{ old('progress_step', $user->progress_step) == 1 ?
                                                'selected' : '' }}>Step 1: {{ $user->step1_name ?? 'Initiation' }}
                                            </option>
                                            <option value="2" {{ old('progress_step', $user->progress_step) == 2 ?
                                                'selected' : '' }}>Step 2: {{ $user->step2_name ?? 'Verification' }}
                                            </option>
                                            <option value="3" {{ old('progress_step', $user->progress_step) == 3 ?
                                                'selected' : '' }}>Step 3: {{ $user->step3_name ?? 'Processing' }}
                                            </option>
                                            <option value="4" {{ old('progress_step', $user->progress_step) == 4 ?
                                                'selected' : '' }}>Step 4: {{ $user->step4_name ?? 'Completion' }}
                                            </option>
                                        </select>
                                        <span class="text-danger" id="progress_step_error"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Progress Percentage</h5>
                                        <input class="form-control text-dark bg-light" type="number" min="0" max="100"
                                            name="progress_percentage"
                                            value="{{ old('progress_percentage', $user->progress_percentage) }}">
                                        <span class="text-danger" id="progress_percentage_error"></span>
                                    </div>

                                    @for($i = 1; $i <= 4; $i++) <div class="form-group col-md-6">
                                        <h5 class="text-dark">Step {{ $i }} Name</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="step{{ $i }}_name"
                                            value="{{ old('step'.$i.'_name', $user->{'step'.$i.'_name'}) }}">
                                        <span class="text-danger" id="step{{ $i }}_name_error"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5 class="text-dark">Step {{ $i }} Date</h5>
                                    <input class="form-control text-dark bg-light" type="datetime-local"
                                        name="step{{ $i }}_date"
                                        value="{{ old('step'.$i.'_date', $user->{'step'.$i.'_date'} ? $user->{'step'.$i.'_date'}->format('Y-m-d\TH:i') : '') }}">
                                    <span class="text-danger" id="step{{ $i }}_date_error"></span>
                                </div>
                                @endfor
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <span id="submitText">Update User</span>
                                <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
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

        // Toggle between wallet and bank details
        $('#paymentMethod').on('change', function() {
            const method = $(this).val();
            if (method === 'wallet') {
                $('#walletDetails').removeClass('d-none');
                $('#bankDetails').addClass('d-none');
            } else if (method === 'bank') {
                $('#walletDetails').addClass('d-none');
                $('#bankDetails').removeClass('d-none');
            } else {
                $('#walletDetails').addClass('d-none');
                $('#bankDetails').addClass('d-none');
            }
        });

        // Auto-calculate percentage based on step
        $('select[name="progress_step"]').on('change', function() {
            const step = $(this).val();
            const percentage = step * 25;
            $('input[name="progress_percentage"]').val(percentage);
        });

        // Auto-update step dates when step is changed
        $('select[name="progress_step"]').on('change', function() {
            const currentStep = $(this).val();
            const now = new Date().toISOString().slice(0, 16);
            
            for (let i = 1; i <= currentStep; i++) {
                if (!$(`input[name="step${i}_date"]`).val()) {
                    $(`input[name="step${i}_date"]`).val(now);
                }
            }
        });

        // Form submission
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('.text-danger').text('');
            
            // Show loading state
            $('#submitText').addClass('d-none');
            $('#submitSpinner').removeClass('d-none');
            $('#submitBtn').prop('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        window.location.href = "{{ route('admin.users.index') }}";
                    }
                },
                error: function(response) {
                    // Hide loading state
                    $('#submitText').removeClass('d-none');
                    $('#submitSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                    
                    let errors = response.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(field, messages) {
                            $('#' + field + '_error').text(messages[0]);
                        });
                    }
                    toastr.error('Please correct the errors and try again.');
                },
                complete: function() {
                    // Hide loading state if request completes (success or error)
                    $('#submitText').removeClass('d-none');
                    $('#submitSpinner').addClass('d-none');
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
    });
</script>

@include('admin.footer')