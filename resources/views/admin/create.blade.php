@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Create New User</h1>
            </div>
            <div class="mb-5 row">
                <div class="col-lg-12">
                    <div class="p-3 card bg-light">
                        <form id="userForm" action="{{ route('admin.users.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Step 1: Basic Information -->
                            <div class="form-step step-1">
                                <h3 class="text-dark mb-4">Step 1: Basic Information</h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Full Name</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="name"
                                            value="{{ old('name') }}" required>
                                        <span class="text-danger" id="name_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Email Address</h5>
                                        <input class="form-control text-dark bg-light" type="email" name="email"
                                            value="{{ old('email') }}" required>
                                        <span class="text-danger" id="email_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Password</h5>
                                        <input class="form-control text-dark bg-light" type="password" name="password"
                                            required>
                                        <span class="text-danger" id="password_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Confirm Password</h5>
                                        <input class="form-control text-dark bg-light" type="password"
                                            name="password_confirmation" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Profile Image</h5>
                                        <input class="form-control text-dark bg-light" type="file" name="profile_image">
                                        <span class="text-danger" id="profile_image_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Status</h5>
                                        <select class="form-control text-dark bg-light" name="status" required>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="suspended">Suspended</option>
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
                                        <h5 class="text-dark">Wallet Address</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="wallet_address"
                                            value="xxxx" style:"display:none;">
                                        <span class="text-danger" id="wallet_address_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Withdrawal Destination Company</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="receiver_company" value="{{ old('receiver_company') }}">
                                        <span class="text-danger" id="receiver_company_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Wallet Type</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="wallet_type"
                                            value="{{ old('wallet_type') }}">
                                        <span class="text-danger" id="wallet_type_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Amount</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="payment_amount" value="{{ old('payment_amount') }}">
                                        <span class="text-danger" id="payment_amount_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Total Amount</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="total_amount" value="{{ old('total_amount') }}">
                                        <span class="text-danger" id="total_amount_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Currency</h5>
                                        <input class="form-control text-dark bg-light" type="text"
                                            name="payment_currency" value="{{ old('payment_currency') }}"
                                            placeholder="e.g. USD, EUR">
                                        <span class="text-danger" id="payment_currency_error"></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>

                            <!-- Step 3: Payment Information -->
                            <div class="form-step step-3 d-none">
                                <h3 class="text-dark mb-4">Step 3: Payment Information</h3>

                                <div class="form-group mb-4">
                                    <h5 class="text-dark">Payment Method</h5>
                                    <select class="form-control text-dark bg-light" id="paymentMethod"
                                        name="payment_method" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="wallet" {{ old('payment_method')=='wallet' ? 'selected' : '' }}>
                                            Wallet Transfer</option>
                                        <option value="bank" {{ old('payment_method')=='bank' ? 'selected' : '' }}>Bank
                                            Transfer</option>
                                    </select>
                                    <span class="text-danger" id="payment_method_error"></span>
                                </div>

                                <!-- Wallet Details -->
                                <div id="walletDetails" class="{{ old('payment_method') != 'bank' ? '' : 'd-none' }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Receiver Wallet Address</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="receiver_wallet_address"
                                                value="{{ old('receiver_wallet_address') }}">
                                            <span class="text-danger" id="receiver_wallet_address_error"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Payment Wallet Address</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="payment_wallet_address"
                                                value="{{ old('payment_wallet_address') }}">
                                            <span class="text-danger" id="payment_wallet_address_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Payment Instruction Currency</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="payment_instruction_currency"
                                                value="{{ old('payment_instruction_currency') }}">
                                            <span class="text-danger" id="payment_instruction_currency_error"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <h5 class="text-dark">Payment Instruction</h5>
                                            <textarea class="form-control text-dark bg-light"
                                                name="payment_instruction">{{ old('payment_instruction') }}</textarea>
                                            <span class="text-danger" id="payment_instruction_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bank Details -->
                                <div id="bankDetails" class="{{ old('payment_method') == 'bank' ? '' : 'd-none' }}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Bank Name</h5>
                                            <input class="form-control text-dark bg-light" type="text" name="bank_name"
                                                value="{{ old('bank_name') }}">
                                            <span class="text-danger" id="bank_name_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Account Number</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="account_number" value="{{ old('account_number') }}">
                                            <span class="text-danger" id="account_number_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Account Name</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="account_name" value="{{ old('account_name') }}">
                                            <span class="text-danger" id="account_name_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Routing Number</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="routing_number" value="{{ old('routing_number') }}">
                                            <span class="text-danger" id="routing_number_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Sort Code</h5>
                                            <input class="form-control text-dark bg-light" type="text" name="sort_code"
                                                value="{{ old('sort_code') }}">
                                            <span class="text-danger" id="sort_code_error"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5 class="text-dark">Bank Address</h5>
                                            <input class="form-control text-dark bg-light" type="text"
                                                name="bank_address" value="{{ old('bank_address') }}">
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
                                            name="special_notes">{{ old('special_notes') }}</textarea>
                                        <span class="text-danger" id="special_notes_error"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h5 class="text-dark">Security Message</h5>
                                        <textarea class="form-control text-dark bg-light"
                                            name="security_message">{{ old('security_message') }}</textarea>
                                        <span class="text-danger" id="security_message_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Expires At</h5>
                                        <input class="form-control text-dark bg-light" type="datetime-local"
                                            name="payment_expires_at" value="{{ old('payment_expires_at') }}">
                                        <span class="text-danger" id="payment_expires_at_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Payment Status</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="payment_status"
                                            value="{{ old('payment_status') }}">
                                        <span class="text-danger" id="payment_status_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Spread Fee</h5>
                                        <input class="form-control text-dark bg-light" type="number" step="0.01"
                                            name="spread_fee" value="{{ old('spread_fee') }}">
                                        <span class="text-danger" id="spread_fee_error"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="text-dark">Fee Reason</h5>
                                        <input class="form-control text-dark bg-light" type="text" name="fee_reason"
                                            value="{{ old('fee_reason') }}">
                                        <span class="text-danger" id="fee_reason_error"></span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Create User</button>
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

        // Form submission
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('.text-danger').text('');

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
                    let errors = response.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        $('#' + field + '_error').text(messages[0]);
                    });
                    toastr.error('Please correct the errors and try again.');
                }
            });
        });
    });
</script>

@include('admin.footer')