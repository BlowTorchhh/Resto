@extends('layout.customer')

@section('link')
    
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
<div class="card-body table-responsive">
    <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nomor Meja</th>
                <th>Customer</th>
                <th>Jam Booking</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($reservasi as $item_r)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $item_r->code }}</td>
                    <td>{{ $item_r->nomor_meja }}</td>
                    <td>{{ $item_r->user->name }}</td>
                    <td>{{ $item_r->jam_booking }}</td>
                    <td>{{ $item_r->status }}</td>
                </tr>
        @endforeach
        </tbody>
    </table>    
</div>
@endsection