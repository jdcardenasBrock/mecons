<?php

namespace App\Http\Controllers;

use App\Models\clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.index');
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client=new clients();
        $client->name=$request->fullnameClient;
        $client->typeID=$request->typeId;
        $client->numID=$request->identificationClient;
        $client->direccion=$request->directionClient;
        $client->telefono=$request->phoneClient;
        $client->web=$request->webClient;
        $client->created_by=$request->id_user_create;
        $client->save();
        return json_encode(['success' => true]);        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = clients::where('id', $id)->first();
        return json_encode(['success' => true, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client= clients::findOrFail($id);
        $client->name=$request->edit_fullnameClient;
        $client->typeID=$request->edit_typeId;
        $client->numID=$request->edit_identificationClient;
        $client->direccion=$request->edit_directionClient;
        $client->telefono=$request->edit_phoneClient;
        $client->web=$request->edit_webClient;
        $client->modified_by=$request->id_user_edit;
        $client->save();
        return json_encode(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = clients::find($id)->delete();

        if ($reg) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false, 'data' => 'No se puede eliminar, hace parte de otro modulo.']);
        }
    }
    public function getData(Request $request)
    {
        $Client = clients::select('id','name', 'typeID', 'numID', 'direccion', 'telefono', 'margen', 'web','created_at')
        ->orderBy('id', 'asc');

        $datatables =  app('datatables')->of($Client)
           
            ->addColumn('date_created', function ($Client) {
                $timestamp = strtotime($Client->created_at);
                $newDate = date("m-d-Y", $timestamp);
                return $newDate;
            })
            ->addColumn('typeNumID', function ($Client) {
                return $Client->typeID.'-'.$Client->numID;
            })
            ->addColumn('actions', function ($Client) {
                return view('clients.edit', ['id' => $Client->id]);
            })
            ->addColumn('marginPorc', function ($Client) {
                return $Client->margen.'%';
            })
            ->rawColumns(['date_created','typeNumID', 'actions','marginPorc']);

        return $datatables->make(true);
    }

}
