@extends('Dashboard')
<h1>Welcome add Accompaniments</h1>
<x-slot name="title">
    Add Accompaniments

   </x-slot>
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                
                   <div  class="alert alert-success">{{session('status')}}</div>
                @endif

                <div class='card'>
                    <div class="card-header">
                        <h4>
                            <a href="{{url('accompaniments')}}" class="btn btn-primary float-end" type="button"> Back</a>
                        </h4> 
                    </div>
                    <div class="card-body">
                        <form action="{{url('accompaniments/create')}}" method="POST">
                            @csrf
                    
                            <div class="mb-3">
                                <label> Product_id</label>
                                <input type="text" name="product_id" class="form-control" value="{{old('product_id')}}"/>
                                @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label> Name</label>
                                <textarea  name="name"  class="form-control" rows="3" {{old('name"')}}></textarea>
                                @error('name"')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <label> Image</label>
                                <input type="text" name="image" class="form-control" value="{{old('image')}}" />
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label> Price</label>
                                <input type="text" name="price" class="form-control" value="{{old('price')}}" />
                                @error('price')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label> Description</label>
                                <input type="text" name="description" class="form-control" value="{{old('description')}}" />
                                @error('description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                          
                    
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"
                                  onclick="return success('Saved!')"  >Save
                                </button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

   
    
    
    
