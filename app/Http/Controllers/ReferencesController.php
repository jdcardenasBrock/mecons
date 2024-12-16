<?php

namespace App\Http\Controllers;

use App\Models\references;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Exports\ReferencesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReferencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('references.index');
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
        $validator = Validator::make($request->all(), [
            'name_reference' => 'bail|required|max:280',
            'weights_pounds' => 'bail|required|max:180',
            'description' => 'bail|required',
            'brand' => 'bail|required|max:280',
        ]);

        if ($validator->fails()) {
            return json_encode(['success' => false, 'data' => $validator->errors()]);
        } else {
            
            $tipo_id = $request->complete_id;
            if ($tipo_id == "auto") {
                $res = new references();
                $res->name_reference = $request->name_reference;
                $res->weights_pounds = $request->weights_pounds;
                $res->volume = $request->volume;
                $res->description = $request->description;
                $res->brand = $request->brand;
                $res->notes = $request->notes;
                $res->save();
                $res->id_reference = $res->id;
                $res->save();


                return json_encode(['success' => true]);
            } elseif ($tipo_id == "existent") {
                $IdAsociar = $request->id_asociar;
                $ExisteId = references::ExistIdReference($IdAsociar);

                if ($ExisteId) {
                    $res = new references();
                    $res->id_reference = $IdAsociar;
                    $res->name_reference = $request->name_reference;
                    $res->weights_pounds = $request->weights_pounds;
                    $res->volume = $request->volume;
                    $res->description = $request->description;
                    $res->brand = $request->brand;
                    $res->notes = $request->notes;
                    $res->save();

                    return json_encode(['success' => true]);
                } else {
                    return json_encode(['success' => false, 'data' => "Verifique el Id, No es posible asociar por que no existe"]);
                }
            }
            else{
                return json_encode(['success' => false, 'data' => "Eror en el tipo de id."]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\references  $references
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = references::where('id', $id)->first();
        return json_encode(['success' => true, 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\references  $references
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = references::where('id', $id)->first();
        return json_encode(['success' => true, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\references  $references
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reg = references::findOrFail($id);
        $reg->name_reference = $request->edit_name_reference;
        $reg->weights_pounds = $request->edit_weights_pounds;
        $reg->volume = $request->edit_volume;
        $reg->description = $request->edit_description;
        $reg->brand = $request->edit_brand;
        $reg->notes = $request->edit_notes;
        $reg->save();
        return json_encode(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\references  $references
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = references::find($id)->delete();

        if ($reg) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'data' => 'No se puede eliminar, hace parte de otro modulo.']);
        }
    }
    public function anyData(Request $request)
    {
        $Reference = references::select('id','id_reference','name_reference','weights_pounds','volume','description','brand','notes','created_at','updated_at')
        ->orderBy('id','desc');


        // additional users.name search
        if ($id_refer = $request->id) {
            $Reference->where('id_reference', 'like', "$id_refer");
        }

        if ($name_refer = $request->reference) {
            $Reference->where('name_reference', 'like', "%$name_refer%");
        }

        $datatables =  app('datatables')->of($Reference)
            ->addColumn('id_bold', function ($Reference) {
                return "<b>".$Reference->id_reference."</b>";
            })
            ->addColumn('note_limited', function ($Reference) {
                $array_str = $Reference->notes;
                if ($array_str=="") {
                   return '<span class="badge badge-pill badge-outline-info mb-1">No hay Notas.</span>';
                }else{
                    return '<span class="badge badge-pill badge-outline-success mb-1">Registro con Notas.</span>';
                }
            })
            ->addColumn('date_created', function ($Reference) {
                $timestamp = strtotime($Reference->created_at);
                $newDate = date("m-d-Y", $timestamp);
                return $newDate;
            })
            ->addColumn('actions', function ($Reference) {
                return view('references.edit', ['id' => $Reference->id]);
            })
            ->rawColumns(['id_bold','date_created', 'actions', 'note_limited']);

        return $datatables->make(true);




        // if ($request->ajax()) {
        //     $Reference = references::select('*');
        //     return Datatables::of($Reference)
        //         ->addIndexColumn()
        //         ->addColumn('note_limited', function ($Reference) {
        //             $array_str = explode(' ', $Reference->notes);

        //             $limit = 10;
        //             $string_final = implode(' ', array_slice($array_str, 0, $limit));
        //             return  $string_final . "...";
        //         })
        //         ->addColumn('date_created', function ($Reference) {
        //             $timestamp = strtotime($Reference->created_at);
        //             $newDate = date("m-d-Y", $timestamp);
        //             return $newDate;
        //         })
        //         ->addColumn('actions', function ($Reference) {
        //             return view('references.edit', ['id' => $Reference->id]);
        //         })
        //         ->rawColumns(['date_created', 'actions', 'note_limited'])
        //         ->make(true);
        // }
    }
    public static function AssignID($data)
    {
        $array = explode(",", $data);
        $IdExistente = $array[0];
        $IdAsociar = $array[1];
        $ExisteId = references::ExistIdReference($IdAsociar);

        if ($ExisteId) {

            $reg = references::findOrFail($IdExistente);
            $reg->id_reference = $IdAsociar;
            $reg->save();
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'data' => "Verifique el Id, No es posible asociar por que no existe"]);
        }
    }
    public function export()
    {
        ini_set('memory_limit', '512M');
        return Excel::download(new ReferencesExport, 'references_' . now()->timestamp . '.csv');
    }
}
