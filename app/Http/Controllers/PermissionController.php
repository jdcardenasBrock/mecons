<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\PermissionRegistrar;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = Permission::select('name', 'created_at');
        return view("permissions.index", compact($permissions));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Permission::create($request->only('name'));
        return json_encode(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Permission::where('id', $id)->first();
        return json_encode(['success' => true, 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Permission::where('id', $id)->first();
        return json_encode(['success' => true, 'data' => $data]);
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
        $reg = Permission::findOrFail($id);
        $reg->name = $request->edit_name_permission;
        $reg->save();
        return json_encode(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = Permission::find($id)->delete();

        if ($reg) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'data' => 'No se puede eliminar, hace parte de otro modulo.']);
        }
    }
    public function anyData()
    {
        $Permission = Permission::all();
        return Datatables::of(Permission::query())
            ->addColumn('date_created', function ($Permission) {
                $timestamp = strtotime($Permission->created_at);
                $newDate = date("m-d-Y", $timestamp);
                return $newDate;
            })
            ->addColumn('actions', function ($Permission) {
                return '<div class="dropdown d-inline-block">
                    <button class="btn btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButtonUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonUser" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">  
                        <a class="dropdown-item" onclick="edit(this)" id="' . $Permission->id . '">Editar</a>
                        <a class="dropdown-item" onclick="drop(this)" id="' . $Permission->id . '">Eliminar</a>

                    </div>
                </div>';
            })
            ->rawColumns(['date_created', 'actions'])
            ->make(true);
    }
}
