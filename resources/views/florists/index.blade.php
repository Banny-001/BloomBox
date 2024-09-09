
@extends('Dashboard')  
<h1>Welcome add Florists</h1>
<div class="mx-auto p-20 ">
   <div class="row mb-20">
       <div class="col-md-12 mt-20">
           <div class='card'>
               <div class="card-header">
                   <h4>Florists
                       <a href="{{url('florists/create')}}" class="btn btn-primary float-end" type="button"> Add Florists</a>
                   </h4> 
               </div>
         
               <div class="card-body">
                 
                   <table class="table table-striped">
                   
                         <thead>
                           <tr>
                           <th>user_id</th>
                           <th>Business_name</th>
                           <th>Image</th>
                           <th>Location</th>
                           <th>Phone_number</th>
                           <tr>
                         </thead>
                         <tbody>
                       @foreach($florists as $item)
                          <tr>
                               <td>{{$item->user_id}}</td>
                               <td>{{$item->business_name}}</td>
                               <td>{{$item->image}}</td>
                               <td>{{$item->location}}</td>
                               <td>{{$item->phone_number}}</td>
                             
                             
                              
                               <td>
                                   <a href="{{url('florists/'.$item->id.'/edit')}}"  class="btn btn-success mx-1">Edit</a>
                                   <a href="{{url('florists/'.$item->id.'/delete')}}" class="btn btn-danger mx-1"
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









