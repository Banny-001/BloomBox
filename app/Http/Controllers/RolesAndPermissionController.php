<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionController extends Controller
{
    public function addPermissions(Request $request)
    {
        $permissions = [
            'view products',
            'view accompaniments',
            'add products',
            'edit products',
            'delete products',
            'add accompaniments',
            'edit accompaniments',
            'delete accompaniments',
            'view orders',
            'manage inventory',
            'manage accompaniments',
            'view sales reports',
            'manage users',
            'manage florists',
            'view financial reports',
            'manage permissions',
            'platform settings',
            'place orders',

            'leave reviews'

        ];
        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }
    }
    public function show()
    {
        $roles = Role::all();
        return view('RolesAndPermissions.index', compact('roles'));
    }

    public function createRole()
    {
        $permissions = Permission::all();
        $users = User::select('name', 'id')->get();
        return view('RolesAndPermissions.CreateRoles', compact('permissions', 'users'));
    }
    public function create(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        foreach ($request->permission as $permission) {
            $role->givePermissionTo($permission);
        }
        foreach ($request->users as $user) {
            $user = User::find($user);
            $user->assignRole($role->name);
        }
        return redirect('show-roles');
    }
    public function editRole($id)
    {
        $role = Role::where('id', $id)
            ->with('permissions', 'users')
            ->first();
        $permissions = Permission::all();
        $users = User::select('name', 'id')->get();

        return view('RoleAndPermisions.EditRole', compact('role', 'permissions', 'users'));
    }
    public function updateRole(Request $request)
    {
        $role = Role::where('id', $request->id)->first();
        $role->name = $request->name;
        $role->update();
        $role->syncPermissions($request->permission);

        DB::table('model_has_roles')->where('role_id', $request->id)->delete();

        foreach ($request->users as $user) {
            $user = User::find($user);
            $user->assignRole($role->name);
        }
        return redirect('show-roles');
    }
    public function destroy($id)
    {
        Role::where('id', $id)->delete();
        return redirect('show-roles');
    }
}
