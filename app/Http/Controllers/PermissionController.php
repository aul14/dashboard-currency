<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Models\History;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasPermission('manage-permission')) {
            if ($request->ajax()) {
                $permission = Permission::with('module')->orderBy('permissions.id', 'DESC')->select('*');
                return DataTables::of($permission)
                    ->addColumn('action', function ($permission) {
                        return view('datatable-modal._action', [
                            'row_id' => $permission->id,
                            'edit_url' => route('permissions.edit', $permission->id),
                            'delete_url' => route('permissions.destroy', $permission->id),
                            'can_edit' => 'edit-permission',
                            'can_delete' => 'delete-permission'
                        ]);
                    })
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('permission.index');
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission('create-permission')) {
            $modules = Module::all();
            return view('permission.create', compact('modules'));
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasPermission('create-permission')) {
            $request->validate([
                'name'    => 'required|unique:permissions,name',
                'module_id' => 'required',
                'display_name' => 'required|unique:permissions,display_name'
            ]);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = ucwords($request->display_name);
            $permission->description = $request->description;
            $permission->module_id = $request->module_id;
            $permission->save();

            return to_route('permissions.index')->with('success', 'New permission has been added!');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        if (Auth::user()->hasPermission('edit-permission')) {
            $modules = Module::all();
            return view('permission.edit', compact('modules', 'permission'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->hasPermission('edit-permission')) {
            $request->validate([
                'name'    => 'required|unique:permissions,name,' . $id,
                'module_id' => 'required',
                'display_name' => 'required|unique:permissions,display_name,' . $id
            ]);

            $permission = Permission::find($id);
            $permission->name = $request->name;
            $permission->display_name = ucwords($request->display_name);
            $permission->description = $request->description;
            $permission->module_id = $request->module_id;
            $permission->update();

            return to_route('permissions.index')->with('success', 'Permission has been updated!');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (Auth::user()->hasPermission('delete-permission')) {
            $permission->delete();
            return to_route('permissions.index')->with('success', 'Permission has been deleted!');
        } else {
            abort(403);
        }
    }

    public function attachPermission(Request $request, $role_id)
    {
        $role = Role::find($role_id);
        $role->attachPermission($request->permission);
    }

    public function detachPermission(Request $request, $role_id)
    {

        $role = Role::find($role_id);
        $role->detachPermission($request->permission);
    }
}
