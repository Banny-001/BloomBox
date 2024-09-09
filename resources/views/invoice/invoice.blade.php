@extends('Dashboard')
<table class="table table-bordered mt-20" >
<div class="label row">
   <h3>All</h3>
   <h3>Paid</h3>
</div>
<div class="input-group flex-nowrap">
  <span class="input-group-text" id="addon-wrapping">Filter</span>
  <input type="text" class="form-control" placeholder="Search Invoice" aria-label="Username" aria-describedby="addon-wrapping">
</div>
<table class="table mt-20">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Date</th>
        <th scope="col">Number</th>
        <th scope="col">Customer</th>
        <th scope="col">Due Date</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        <td>@fat</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        <td>@twitter</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
</table>