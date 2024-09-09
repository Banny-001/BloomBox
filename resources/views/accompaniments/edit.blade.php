
@extends('Dashboard')
<h1>Welcome Edit Accompaniments</h1>
   <x-slot name="title">
    Edit Accompaniments
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
                        <form action="{{url('accompaniments/' .$accompaniment->id .'/edit')}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>product_id</label>
                                <input type="text" name="user_id" class="form-control" value="{{$accompaniment->product_id}}"/>
                                @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label> Name</label>
                                <textarea  name="name"  class="form-control" rows="3"value="{{$accompaniment->name}}"></textarea>
                                @error('name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="text" name="image" class="form-control" value="{{$accompaniment->image}}" />
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" value="{{$accompaniment->description}}" />
                                @error('description')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                           
                    
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"
                                  onclick="return success('Saved!')"  >Update
                                </button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>

 
    
    
    
