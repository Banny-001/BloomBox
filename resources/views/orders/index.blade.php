@extends('Dashboard')
<h1>Welcome add Florists</h1>
<div class="mx-auto p-20 ">
    <div class="row mb-20">
        <div class="col-md-12 mt-20">
            <div class='card'>
                <div class="card-header">
                    <h4> My Orders
                        {{-- <a href="{{ url('orders/create') }}" class="btn btn-primary float-end" type="button"> Add
                            Add Orders</a> --}}
                    </h4>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>tracking_no</th>
                                <th>product_id</th>
                                <th>accompaniment_id</th>
                                <th>customer_id</th>
                                <th>total_price</th>
                                <th>Payment Mode</th>
                                <th>Status_Message</th>
                                <th>Ordered_date</th>
                                <th>Action</th>

                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->product_id }}</td>
                                    <td>{{ $item->accompaniment_id }}</td>
                                    <td>{{ $item->customer_id }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td>{{ $item->status_message }}</td>
                                    <td>{{ $item->ordered_date->format('d-m-y') }}</td>
                                    <td>{{ $item->action }}</td>
                                    <td>
                                        <a href="{{ url('orders/' . $item->id . '/edit') }}"
                                            class="btn btn-success mx-1">Edit</a>
                                        <a href="{{ url('orders/' . $item->id . '/delete') }}"
                                            class="btn btn-danger mx-1" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                               
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>

</div>
