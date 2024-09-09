
@extends('Dashboard') 
<h1>Products</h1>

<div class="container mt-5">
        <div class="row">
            <div class="col-mt-5">
                <div class='card'>
                    <div class="card-header">
                        <h4>Products
                            <a href="{{url('products/create')}}" class="btn btn-primary float-end" type="button"> Add Products</a>
                        </h4> 
                    </div>
              
                    <div class="card-body">
                        {{-- {{$products}} --}}
                        <table class="table table-striped">
                              <thead>
                               
                                <tr>
                                <th>florist_id</th>
                                <th>name</th>
                                <th>image</th>
                                <th>description</th>
                                <th>price</th>
                                <tr>
                              </thead>
                              <tbody>
                            @foreach($products as $item)
                               <tr>
                                  <td>{{$item->florist_id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->image}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->price}}</td>
                                    
                                    

                                   
                                    <td>
                                        <a href="{{url('products/'.$item->id.'/edit')}}"  class="btn btn-success mx-1">Edit</a>
                                        <a href="{{url('products/'.$item->id.'/delete')}}" class="btn btn-danger mx-1"
                                            onclick="return confirm('Are you sure?')" >
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

    
    
    



