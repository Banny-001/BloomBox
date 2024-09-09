

@extends('Dashboard')

    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                
                   <div  class="alert alert-success">{{session('status')}}</div>
                @endif

                <div class='card'>
                    <div class="card-header">
                        <h4>
                            <a href="{{url('products')}}" class="btn btn-primary float-end" type="button"> Back</a>
                        </h4> 
                    </div>
                    <div class="card-body">
                        <form action="{{url('products/'.$product->id.'/edit')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Florist</label>

                                <input type="text" name="florist_id" class="form-control" value="{{$product->florist_id}}" />
                                @error('florist_id')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{$product->name}}"/>
                                @error('name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea  name="description"  class="form-control" rows="3" {{$product->description}}></textarea>
                                @error('description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control" value="{{$product->price}}" />
                                @error('price')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="text" name="image" class="form-control" value="{{$product->image}}" />
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"
                                onclick="return successs('Saved!')"
                                >update</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
    
    
