@extends('Dashboard');

<div class="container">
    <div class="row mt-5">
      <div class="col-md-3 mb-3">
        <div class="card bg-success text-purple">
          <div class="card-body" >
            <div class="card-title">
              <h5  style="color:white" class="card-title">Total Users</h5>
              <h4 style="color:black" id="totalUsers">500</h4>
            </div>
          </div>
  
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-warning text-green">
          <div class="card-body" >
            <div class="card-title">
              <h5  style="color:white" class="card-title">Total Florists</h5>
              <h4 style="color:black" id="totalUsers">30</h4>
            </div>
          </div>
  
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-info text-red">
          <div class="card-body" >
            <div class="card-title">
              <h5  style="color:white" class="card-title">Total Products</h5>
              <h4 style="color:black" id="totalUsers">200</h4>
            </div>
          </div>
  
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card bg-primary text-blue">
          <div class="card-body" >
            <div class="card-title">
              <h5  style="color:white" class="card-title">Total Accompaniments</h5>
              <h4 style="color:black" id="totalUsers">40</h4>
            </div>
          </div>
        </div>
      </div>
      <h1>Monthly User Registrations</h1>
      {{-- <div style="width:75%;">
          <x-chartjs-component :chart="$chart" />
      </div> --}}
    </div>
   </div>
  

  