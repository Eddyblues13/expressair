@include('admin.header')

<div class="main-panel">
    <div class="content bg-light">
        <div class="page-inner">
            <div class="mt-2 mb-4">
                <h1 class="title1 text-dark">Package Details</h1>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2 shadow card p-4 bg-light">
                    <h4 class="text-dark">Tracking Number: {{ $package->tracking_number }}</h4>

                    <table class="table table-bordered text-dark">
                        <tr>
                            <th>Sender Name</th>
                            <td>{{ $package->sender_name }}</td>
                        </tr>
                        <tr>
                            <th>Receiver Name</th>
                            <td>{{ $package->receiver_name }}</td>
                        </tr>
                        <tr>
                            <th>Current Location</th>
                            <td>{{ $package->current_location }}</td>
                        </tr>
                        <tr>
                            <th>Parcel Status</th>
                            <td>
                                @if($package->parcel_status == 'Delivered')
                                <span class="badge badge-success">Delivered</span>
                                @elseif($package->parcel_status == 'In Transit')
                                <span class="badge badge-warning">In Transit</span>
                                @else
                                <span class="badge badge-danger">{{ $package->parcel_status }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $package->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </table>

                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')