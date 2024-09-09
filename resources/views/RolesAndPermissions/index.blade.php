@extends ('Dashboard');
{{-- @section('content') --}}
<div class="card">
    <div class="card-header">
       
        <h1>{{ 'Roles And Permissions' }}</h1>
    </div>
    <div class="card-body">
        <a href="{{ URL('create-roles') }}" class="btn btn-success">{{ _('Create Roles') }}</a>
    </div>
    <table class="table" width="100%">
        <tr>
            <td>{{ _('Name') }}</td>
            <td>{{ _('Actions') }}</td>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}
                <td>
                <td>
                    <a href="{{ URL('edit-role') }}/{{ $role -> id }}" class="btn btn-success">{{ _('Edit') }}</a>
                    <a href="{{ URL('delete-role') }}/{{ $role -> id }}"
                        class="btn btn-danger">{{ _('Delete') }}</a>
                </td>

            </tr>
        @endforeach
    </table>

</div>
{{-- @endsection --}}
