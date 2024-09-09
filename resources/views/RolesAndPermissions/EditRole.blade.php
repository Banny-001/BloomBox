@extends('Dashboard');
{{-- @section('content') --}}
<div class="card">
    <div class="card-header">
        <h1>{{_('Create New Role')}}</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{URL('update-role')}}">
            @csrf
            <input type="text" id="id" name="id" value="{{$role->id}}" readonly required hidden/>
            <label for="name">{{_('Role Name')}}</label>
            <input type="text"  required name="name"  class=" form-control"value="{{$role->name}}"/>

            <div class="row">
                <div class="col-md-6">
                    <h1>{{_('Permissions')}}</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{_('Name')}}</th>
                                <th>{{_('Permission')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td class="styled-checkbox">
                                    <input type="checkbox" value="{{$permission->name}}" name="permission[]" id="permission_{{$permission->id}}"
                                    @if($role->permissions->contains('id',$permission->id)) checked @endif/>
                                    <label class="checkmark" for="permission_{{$permission->id}}"></label>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="col-md-6">
                    <h1>{{_("Users")}}</h1>
                    <label for="users">{{_("Users")}}</label>
                    <select class="form-control" name="users[]" id="users" multiple>
                        @foreach($users as $user)
                        <option value="{{$user->id}}" @if($role->users->contains('id',user->id)) selected @endif>
                            {{$user->name}}

                        </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="{{_('Save')}}"/>
    </div>
</div>
{{-- @endsection --}}

