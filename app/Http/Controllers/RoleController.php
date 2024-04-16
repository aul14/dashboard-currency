<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Models\History;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasPermission('manage-role')) {
            if ($request->ajax()) {
                $role = Role::with([
                    'permission_role' => function ($sql) {
                        $sql->with('permission');
                    }
                ])->orderBy('roles.id', 'DESC')->select('*');
                return DataTables::of($role)
                    ->addColumn('action', function ($role) {
                        return view('datatable-modal._action', [
                            'row_id' => $role->id,
                            'edit_url' => route('roles.edit', $role->id),
                            'delete_url' => route('roles.destroy', $role->id),
                            'access_url' => route('roles.access', $role->id),
                            'can_edit' => 'edit-role',
                            'can_delete'    => 'delete-role',
                            'can_role_access'    => 'manage-role-access',
                        ]);
                    })
                    ->editColumn('permission_role', function ($role) {
                        $permisson_name = '';
                        foreach ($role->permission_role as $row) {
                            $permisson_name .= ' ' . '<span class="badge badge-sm bg-primary">' .
                                $row->permission->display_name . '</span>';
                        }
                        return  $permisson_name;
                    })
                    ->rawColumns(['permission_role', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('role.index');
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
        if (Auth::user()->hasPermission('create-role')) {
            return view('role.create');
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
        if (Auth::user()->hasPermission('create-role')) {
            $request->validate([
                'name'    => 'required|unique:roles,name',
                'display_name' => 'required|unique:roles,display_name'
            ]);

            $role = new Role();
            $role->name = ucwords($request->name);
            $role->display_name = ucwords($request->display_name);
            $role->description = $request->description;
            $role->save();

            return to_route('roles.index')->with('success', 'New role has been added!');
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
    public function edit(Role $role)
    {
        if (Auth::user()->hasPermission('edit-role')) {
            return view('role.edit', compact('role'));
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
        if (Auth::user()->hasPermission('edit-role')) {
            $request->validate([
                'name'    => 'required|unique:roles,name,' . $id,
                'display_name' => 'required|unique:roles,display_name,' . $id
            ]);

            $role = Role::find($id);
            $role->name = ucwords($request->name);
            $role->display_name = ucwords($request->display_name);
            $role->description = $request->description;
            $role->update();

            return to_route('roles.index')->with('success', 'Role has been updated!');
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
    public function destroy(Role $role)
    {
        if (Auth::user()->hasPermission('delete-role')) {
            $role->delete();
            return to_route('roles.index')->with('success', 'Role has been deleted!');
        } else {
            abort(403);
        }
    }

    public function roles_access($id)
    {
        if (Auth::user()->hasPermission('manage-role-access')) {
            $module = Module::with([
                'permission'
            ])->whereHas('permission')->filter(request(['search']))->paginate(10)->withQueryString();
            // dd(count($module));
            $role = Role::find($id);

            return view('role.role', compact('module', 'role'));
        } else {
            abort(403);
        }
    }
}
