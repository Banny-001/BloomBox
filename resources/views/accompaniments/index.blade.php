@extends('Dashboard')
<div class="mx-auto p-20">
    <h1>Welcome add Accompaniments</h1>
  <table class="table table-striped">
<div class="mx-auto p-20 ">
    <div class="row mb-20">
        <div class="col-md-12 mt-20">
            <div class='card-body'>
                <div class="card-header">
                    <h4>Accompaniments
                        <a href="{{ url('accompaniments/create') }}" class="btn btn-primary float-end" type="button"> Add
                            Accompaniments</a>
                    </h4>
                </div>

                <div class="card-body">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Product_id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price</th>
                           

                            <tr>
                        </thead>
                        <tbody>
                            @foreach ($accompaniment as $item)
                                <tr>
                                    <td>{{ $item->product_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->image }}</td>
                                   
                                    <td>{{ $item->price }}</td>
                                    




                                    <td>
                                        <a href="{{ url('accompaniments/' . $item->id . '/edit') }}"
                                            class="btn btn-success mx-1">Edit</a>
                                        <a href="{{ url('accompaniments/' . $item->id . '/delete') }}" class="btn btn-danger mx-1"
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>

            </div>

        </div>
    </div>

</div>
  </table>
</div>
