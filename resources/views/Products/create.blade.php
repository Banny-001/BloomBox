 

@extends('Dashboard')
 <div class="container mt-5">
     <div class="row">
         <div class="col-md-12">
             @if (session('status'))
                 <div class="alert alert-success">{{ session('status') }}</div>
             @endif
             <div class="card">
                 <div class="card-header">
                     <h4>
                         Add Products
                         <a href="{{ url('products') }}" class="btn btn-danger float-end">Back</a>
                     </h4>
                 </div>
                 <div class='card-body'>
                     <form action="{{ url('products/create') }}" method="POST">
                         @csrf

                         <div class="mb-3">
                             <label>Name</label>
                             <input type="text" name="name"class="form-control" value="{{ old('name') }}">
                             @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                             </div>
                             <div class="mb-3">
                                 <label>Image</label>
                                 <input type="text" name="image" class="form-control" value="{{ old('image') }}">
                                 @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                             </div>
                            
                             <div class="mb-3">
                                 <label>Price</label>
                                 <input type="text" name="price" class="form-control"rows="3"
                                     value="{{ old('price') }}">
                                 @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                             </div>
                             <div class="mb-3">
                                 <label>Description</label>
                                 <textarea type="text" name="description" class="form-control"  value="{{ old('description') }}"></textarea>
                                 @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                             </div>
                             <div class="mb-3">
                                 <label>Florist</label>
                                 <input type="text" name="seller"class="form-control"  value="{{ old('florist_id') }}">
                                 
                                 @error('florist_id') <span class="text-danger">{{ $message }}</span> @enderror

                             </div>
                             <div class="mb-3">
                                 <button type="submit" class="btn btn-primary"
                                 onclick="return success('Saved!')"
                                 >Save</button>
                             </div>
                         </form>


                     </div>

                 </div>

             </div>
         </div>
     </div>
