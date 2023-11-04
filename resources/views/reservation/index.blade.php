@extends('layouts.main')

@section('title')
    <title>Reservation - {{ config('app.name', 'Vehicle Reservation') }}</title>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Reservation</h3>
                    <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reservation</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Reservation Data</h4>
                    @if (Auth::user()->role_id == 1)
                    <div>
                        <a href="{{ route('reservation.create') }}" class="btn btn-outline-primary">Add New Reservation</a>

                        <a class="btn btn-outline-secondary" href="{{ route('ReservationExport') }}">Export Excel</a>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="reservation-data">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Applicant</th>
                                <th class="text-center">Vehicle Name</th>
                                <th class="text-center">Driver Name</th>
                                @if (Auth::user()->role_id == 2)
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservation as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $item->user->name }}</td>
                                    <td class="text-center">{{ $item->vehicle->vehicle_name }}</td>
                                    <td class="text-center">{{ $item->driver->driver_name }}</td>
                                    @if (Auth::user()->role_id == 2)
                                        @if ($item->status == 0)
                                            <form id="approval{{ $item->id }}"
                                                action="{{ route('approving.store', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="text" name="reservation_id" id="reservation_id" value="{{$item->id}}" hidden>
                                                <input type="text" name="user_approve_id" id="user_approve_id" value="{{Auth::user()->id}}" hidden>
                                                <input type="text" name="vehicle_id" id="vehicle_id" value="{{$item->vehicle_id}}" hidden>
                                            </form>
                                            <td class="text-center">In request</td>
                                            <td class="text-center"><a class="btn btn-sm btn-outline-success"
                                                    onclick="confirmApprove({{ $item->id }})">Approve</a></td>
                                        @else
                                            <td class="text-center">Approved</td>
                                            <td class="text-center"><a class="btn btn-outline-success" disabled>Approve</a></td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function confirmApprove(itemId) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approval' + itemId).submit();
                }
            });
        }
    </script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            })
        </script>
    @elseif (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            })
        </script>
    @endif
@endpush
