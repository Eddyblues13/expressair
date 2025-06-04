@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            @if(session('message'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-success mb-2">{{ session('message') }}</div>
            @endif
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">All Recovery Cases</h1>
            </div>
            <div class="row">
                @foreach($recoveries as $recovery)
                <div class="col-md-4">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $recovery->first_name }} {{ $recovery->last_name }}</h5>
                            <p class="card-text text-dark">
                                <strong>Recovery Code:</strong> {{ $recovery->recovery_code }}<br>
                                <strong>Email:</strong> {{ $recovery->email_address }}<br>
                                <strong>Phone:</strong> {{ $recovery->phone_number }}<br>
                                <strong>Amount Invested:</strong> {{ $recovery->currency }} {{
                                number_format($recovery->amount_invested, 2) }}<br>
                                <strong>Status:</strong> {{ ucfirst($recovery->status) }}<br>
                            </p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.recovery.edit', $recovery->id) }}"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.recovery.delete', $recovery->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this recovery case?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('admin.footer')