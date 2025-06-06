@include('home.header')
<main>
    <article>


        <section class="section newsletter" aria-label="newsletter">
            <div class="container">

                {{-- Error Message at the Top --}}
                @if (session('error'))
                <div
                    style="background-color: white; color: red; padding: 15px; border: 1px solid red; margin-bottom: 20px;">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" onclick="this.parentElement.style.display='none'"
                        style="float:right; border:none; background:none; font-size:16px; cursor:pointer;">&times;</button>
                </div>
                @endif

                {{-- Success Message --}}
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <b>Success!</b> {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif (session('message'))
                <div class="alert alert-success" role="alert">
                    <b>Success!</b> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="newsletter-content">
                    <h2 class="h2 section-title">Enter Your Tracking Number</h2>
                    <form action="{{ route('package') }}" method="POST" class="newsletter-form">
                        @csrf
                        <input type="text" name="search" placeholder="Enter Your Tracking Number"
                            aria-label="Tracking Number" class="email-field">
                        <button type="submit" class="newsletter-btn">Track</button>
                    </form>
                </div>

            </div>
        </section>





    </article>
</main>
@include('home.footer')