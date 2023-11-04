@extends('layouts.main')

@section('title')
    <title>Create Reservation - {{ config('app.name', 'Vehicle Reservation') }}</title>
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    <link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endsection

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create Reservation</h3>
                    <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('reservation.index')}}">Reservation</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Application Form</h4>
                </div>
                <div class="card-body">
                    <form id="create-reservation" class="form" action={{route('reservation.store')}} method="POST">
                        @csrf
                        <input type="text" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="start_date">Rent from date</label>
                                    <input type="date" id="start_date" class="form-control" name="start_date">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="end_date">Returns</label>
                                    <input type="date" id="end_date" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="driver_id">Driver</label>
                                    <select class="choices form-select" id="driver_id" name="driver_id">
                                        @foreach ($drivers as $driver)
                                        <option value="{{$driver->id}}">{{$driver->driver_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="vehicle_id">Vehicle</label>
                                    <select class="choices form-select" id="vehicle_id" name="vehicle_id">
                                        @foreach ($vehicles as $vehicle)
                                        <option value="{{$vehicle->id}}">{{$vehicle->vehicle_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/js/pages/form-element-select.js')}}"></script>
    <script>
        // $(function() {
        //     $('#reservation-data').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: '{!! route('getDataReservation') !!}',
        //         columns: [{
        //                 data: 'id',
        //                 name: 'id'
        //             },
        //             {
        //                 data: 'vehicle_name',
        //                 name: 'vehicle_name'
        //             },
        //             {
        //                 data: 'plate_number',
        //                 name: 'plate_number'
        //             },
        //             {
        //                 data: 'fuel_consume',
        //                 name: 'fuel_consume'
        //             },
        //             {
        //                 data: 'repair',
        //                 name: 'repair'
        //             },
        //         ]
        //     });
        // });
    </script>
@endpush