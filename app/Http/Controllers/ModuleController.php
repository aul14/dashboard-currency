<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\History;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasPermission('manage-module')) {
            if ($request->ajax()) {
                $module = Module::select('*');
                return DataTables::of($module)
                    ->addColumn('action', function ($module) {
                        return view('datatable-modal._action', [
                            'row_id' => $module->id,
                            'edit_url' => route('modules.edit', $module->id),
                            'delete_url' => route('modules.destroy', $module->id),
                            'can_edit' => 'edit-module',
                            'can_delete' => 'delete-module'
                        ]);
                    })
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('module.index');
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
        if (Auth::user()->hasPermission('create-module')) {
            return view('module.create');
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
        if (Auth::user()->hasPermission('create-module')) {
            $validateData =  $request->validate([
                'name'       => 'required|unique:modules,name'
            ]);

            $validateData['name'] = ucwords($request->name);

            Module::create($validateData);
            return to_route('modules.index')->with('success', 'New module has been added!');
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
    public function edit(Module $module)
    {
        if (Auth::user()->hasPermission('edit-module')) {
            return view('module.edit', compact('module'));
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
        if (Auth::user()->hasPermission('edit-module')) {
            $validateData =  $request->validate([
                'name'       => 'required|unique:modules,name,' . $id
            ]);

            $validateData['name'] = ucwords($request->name);

            Module::where('id', $id)->update($validateData);
            return to_route('modules.index')->with('success', 'New module has been updated!');
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
    public function destroy(Module $module)
    {
        if (Auth::user()->hasPermission('delete-module')) {
            $module->delete();
            return to_route('modules.index')->with('success', 'Module has been deleted!');
        } else {
            abort(403);
        }
    }
}
