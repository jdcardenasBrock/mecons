<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all()->pluck('name', 'id');

        $filtered = $permissions->filter(function ($value) {
            if ($value != 'crear_permisos' && $value != 'editar_permisos' && $value != 'eliminar_permisos') {
                return $value;
            }
        });
        $roles = Role::select('name', 'created_at');
        return view("roles.index", ['roles' => $roles, 'permissions' => $filtered]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));
        $role->permissions()->sync($request->input('permissions', []));
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
        $data = Role::where('id', $id)->first();
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
        $items = [];
        $data = Role::where('id', $id)->first();
        foreach ($data->permissions as $i => $permission) {
            $items[$i] = $permission->id;
        }

        return json_encode(['success' => true, ['data' => $data, 'permissions' => $items]]);
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
        $reg = Role::findOrFail($id);
        $reg->name = $request->edit_name_role;
        $reg->permissions()->sync($request->input('permissions', []));
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
        $reg = Role::find($id)->delete();

        if ($reg) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'data' => 'No se puede eliminar, hace parte de otro modulo.']);
        }
    }

    public function anyData()
    {
        $Rol = Role::all();
        return Datatables::of(Role::query())
            ->addColumn('permission', function ($Rol) {
                $span = "";
                foreach ($Rol->permissions as $item) {
                    $span = $span . '<span class="badge badge-pill badge-theme-3 align-self-start mb-3">' . $item->name . '</span>';
                }
                return $span;
            })
            ->addColumn('date_created', function ($Rol) {
                $timestamp = strtotime($Rol->created_at);
                $newDate = date("m-d-Y", $timestamp);
                return $newDate;
            })
            ->addColumn('actions', function ($Rol) {


                return '<div class="dropdown d-inline-block">
                    <button class="btn btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButtonUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonUser" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">  
                        <a class="dropdown-item" onclick="edit(this)" id="' . $Rol->id . '">Editar</a>  
                        <a class="dropdown-item" onclick="drop(this)" id="' . $Rol->id . '">Eliminar</a>

                    </div>
                </div>';
            })
            ->rawColumns(['date_created', 'actions', 'permission'])
            ->make(true);
    }
}
