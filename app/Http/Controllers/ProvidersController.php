<?php

namespace App\Http\Controllers;

use App\Models\providers;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proveedores.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provider= new providers();
        $provider->name=$request->fullnameProvider;
        $provider->country=$request->countryProvider;
        $provider->direction=$request->directionProvider;
        $provider->email=$request->mailProvider;
        $provider->phone=$request->phoneProvider;
        $provider->pageWeb=$request->pageWebProvider;
        $provider->created_by=$request->id_user_create;
        $provider->save();
        return json_encode(['success' => true]);       
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = providers::where('id', $id)->first();
        return json_encode(['success' => true, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $provider= providers::findOrFail($id);
        $provider->name=$request->edit_fullnameProvider;
        $provider->country=$request->edit_countryProvider;
        $provider->direction=$request->edit_directionProvider;
        $provider->email=$request->edit_mailProvider;
        $provider->phone=$request->edit_phoneProvider;
        $provider->pageWeb=$request->edit_pageWebProvider;
        $provider->modified_by=$request->id_user_edit;
        $provider->save();
        return json_encode(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = providers::find($id)->delete();

        if ($reg) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'data' => 'No se puede eliminar, hace parte de otro modulo.']);
        }
    }
    public function getData(Request $request)
    {
        $Provider = providers::select('id','name', 'country', 'direction', 'email', 'phone', 'pageWeb', 'created_at')
        ->orderBy('id', 'asc');

        $datatables =  app('datatables')->of($Provider)
           
            ->addColumn('date_created', function ($Provider) {
                $timestamp = strtotime($Provider->created_at);
                $newDate = date("m-d-Y", $timestamp);
                return $newDate;
            })
            ->addColumn('actions', function ($Provider) {
                return view('proveedores.edit', ['id' => $Provider->id]);
            })
            ->rawColumns(['date_created', 'actions']);

        return $datatables->make(true);
    }
}
