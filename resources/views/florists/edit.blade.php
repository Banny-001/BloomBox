@extends('Dashboard')
<h1>Welcome add Florists</h1>
   <x-slot name="title">
    Edit Florists
   </x-slot>

        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                
                   <div  class="alert alert-success">{{session('status')}}</div>
                @endif

                <div class='card'>
                    <div class="card-header">
                        <h4>
                            <a href="{{url('florists')}}" class="btn btn-primary float-end" type="button"> Back</a>
                        </h4> 
                    </div>
                    <div class="card-body">
                        <form action="{{url('florists/' .$florist->id .'/edit')}}" method="POST">
                            @csrf
                            @method('PUT')
                         
                            <div class="mb-3">
                                <label>User_id</label>
                                <input type="text" name="user_id" class="form-control" value="{{$florist->user_id}}"/>
                                @error('user_id')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Business Name</label>
                                <textarea  name="business_name"  class="form-control" rows="3" {{$florist->business_name}}></textarea>
                                @error('business_name')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="text" name="image" class="form-control" value="{{$florist->image}}" />
                                @error('image')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control" value="{{$florist->location}}" />
                                @error('location')<span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{$florist->phone_number}}" />
                                @error('phone_number"')<span class="text-danger">{{$message}}</span>@enderror
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

 
    
    
    
