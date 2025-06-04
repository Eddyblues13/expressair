@include('home.header')
<main>
    <article>













        <section class="section newsletter" aria-label="newsletter">
            <div class="container">
                <div class="newsletter-content">
                    <h2 class="h2 section-title">Enter Your Tracking Number</h2>
                    <form id="trackingForm" class="newsletter-form">
                        @csrf
                        <input type="text" name="search" id="trackingNumber" placeholder="Enter Your Tracking Number"
                            aria-label="tracking number" class="email-field" required>
                        <button type="submit" class="newsletter-btn" id="trackButton">
                            <span class="button-text">Track</span>
                            <span class="loading-spinner" style="display: none;">
                                <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                        opacity=".25" />
                                    <path
                                        d="M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z">
                                        <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                            values="0 12 12;360 12 12" repeatCount="indefinite" />
                                    </path>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Success Modal -->
        <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Success!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="successMessage">
                        <!-- Message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Error!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="errorMessage">
                        <!-- Message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('trackingForm');
    const trackButton = document.getElementById('trackButton');
    const buttonText = trackButton.querySelector('.button-text');
    const loadingSpinner = trackButton.querySelector('.loading-spinner');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        buttonText.textContent = 'Checking...';
        loadingSpinner.style.display = 'inline-block';
        trackButton.disabled = true;
        
        // Get the tracking number
        const trackingNumber = document.getElementById('trackingNumber').value;
        
        // AJAX request
        fetch("{{ route('package') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                search: trackingNumber
            })
        })
        .then(response => response.json())
        .then(data => {
            // Reset button state
            buttonText.textContent = 'Track';
            loadingSpinner.style.display = 'none';
            trackButton.disabled = false;
            
            // Handle response
            if (data.error) {
                document.getElementById('errorMessage').textContent = data.error;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            } else if (data.status || data.message) {
                const successMessage = data.status || data.message;
                document.getElementById('successMessage').textContent = successMessage;
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            }
        })
        .catch(error => {
            // Reset button state
            buttonText.textContent = 'Track';
            loadingSpinner.style.display = 'none';
            trackButton.disabled = false;
            
            // Show error
            document.getElementById('errorMessage').textContent = 'An error occurred while processing your request.';
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            console.error('Error:', error);
        });
    });
});
        </script>

        <style>
            .newsletter-btn {
                position: relative;
            }

            .loading-spinner {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .loading-spinner svg {
                fill: currentColor;
            }

            .button-text {
                transition: opacity 0.2s;
            }

            .newsletter-btn.loading .button-text {
                opacity: 0;
            }

            .newsletter-btn.loading .loading-spinner {
                display: inline-block;
            }
        </style>
    </article>
</main>
@include('home.footer')