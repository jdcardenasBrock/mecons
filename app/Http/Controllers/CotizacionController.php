<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\cotizacion;
use Illuminate\Http\Request;
use App\Models\clients;
use App\Models\providers;
use App\Models\references;
use App\Models\User;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cotizacion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cotizacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchQuote(Request $request)
    {
        $query = $request->get('query');
        
        // Validación básica (opcional)
        if (!$query || strlen($query) < 3) {
            return response()->json([]);
        }

        // Consultar la base de datos
        $results = references::where('name_reference', 'LIKE', '%' . $query . '%')
            ->orWhere('id_reference', $query)
            ->take(10) // Limitar los resultados
            ->get(['id', 'weights_pounds','volume','brand']);

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $cotizacion = new cotizacion();
        $cotizacion->array=json_encode($request->export_array);
        //Variables de Calculo Usuario
        $cotizacion->prov=json_encode($request->export_prov);
        $cotizacion->marca=json_encode($request->export_marca);
        $cotizacion->cant=json_encode($request->export_cant);
        $cotizacion->ref=json_encode($request->export_ref);
        $cotizacion->desc=json_encode($request->export_desc);
        $cotizacion->peso=json_encode($request->export_peso);
        $cotizacion->cosl=json_encode($request->export_cosl);
        $cotizacion->cosc=json_encode($request->export_cosc);
        $cotizacion->dias=json_encode($request->export_dias);

        $cotizacion->rentabilidad_calc=$request->export_rentabilidad_calc;
        $cotizacion->trm_dia_calc=$request->export_trm_dia_calc;
        $cotizacion->flete_usd_calc=$request->export_flete_usd_calc;
        $cotizacion->flete_cop_calc=$request->export_flete_cop_calc;
        $cotizacion->arancel_calc=$request->export_arancel_calc;
        $cotizacion->comision_banco_transf_exterior_calc=$request->export_comision_banco_transf_exterior_calc;
        $cotizacion->nacionalizacion_calc=$request->export_nacionalizacion_calc;
        $cotizacion->transportadora_calc=$request->export_transportadora_calc;

        $cotizacion->porcPeso=json_encode($request->export_porcPeso);
        $cotizacion->pesoTotalXItem=json_encode($request->export_pesoTotalXItem);
        $cotizacion->sumaPesoTotal=$request->export_sumaPesoTotal;
        $cotizacion->costo_libra_calc=$request->export_costo_libra_calc;
        $cotizacion->costoTotalXPeso=$request->export_costoTotalXPeso;
        $cotizacion->porcPesoXItem=json_encode($request->export_porcPesoXItem);
        $cotizacion->costoTotalAntePeso=json_encode($request->export_costoTotalAntePeso);
        $cotizacion->costoValorImportXPeso=json_encode($request->export_costoValorImportXPeso);

        $cotizacion->costoValFleteInternoIntUSD=json_encode($request->export_costoValFleteInternoIntUSD);
        $cotizacion->CostoTotal=json_encode($request->export_CostoTotal);
        $cotizacion->CostoTotalPesosPartsImpor=json_encode($request->export_CostoTotalPesosPartsImpor);
        $cotizacion->costoTotalEnPesos=json_encode($request->export_costoTotalEnPesos);
        $cotizacion->costoTotalPartes=$request->export_costoTotalPartes;
    
        $cotizacion->costoTotalPFN=$request->export_costoTotalPFN;
        $cotizacion->costoTotalSinAdc=$request->export_costoTotalSinAdc;
        $cotizacion->GranTotalEnPesosPartsImport=$request->export_GranTotalEnPesosPartsImport;
        $cotizacion->GranTotalCostoPesos=$request->export_GranTotalCostoPesos;
        $cotizacion->CostoUnitPesosPartsImpor=json_encode($request->export_CostoUnitPesosPartsImpor);
        $cotizacion->PorcPesosAcuerdoPesos=json_encode($request->export_PorcPesosAcuerdoPesos);
        $cotizacion->Res_costoGranTotalPesosconAdc=$request->export_Res_costoGranTotalPesosconAdc;
        $cotizacion->costoTotalPesosImporMasNal=json_encode($request->export_costoTotalPesosImporMasNal);
        $cotizacion->precioVentaTotalXItem=json_encode($request->export_precioVentaTotalXItem);
        $cotizacion->precioVentaUnitarioXItem=json_encode($request->export_precioVentaUnitarioXItem);
        $cotizacion->ivaFinal=$request->export_ivaFinal;
        $cotizacion->GranTotal=$request->export_Gran_Total;
        $cotizacion->notas=$request->export_notas;
        $cotizacion->nombreCotizacion=$request->export_nombre;
        $cotizacion->rentabilidadFinal=$request->export_rentabilidadFinal;
        $cotizacion->rentabilidadFinalPorc=$request->export_rentabilidadFinalPorc;
        $cotizacion->dolarRealCalc=$request->export_dolarRealCalc;
        $cotizacion->created_by=$request->created_by;
        $cotizacion->client_id=$request->export_client_id;

        $precioTotalVenta=$request->export_precioGranTotalVenta;
        if($precioTotalVenta=="NaN" || $precioTotalVenta==""){

            return json_encode(['success' => false]);
        }
        else{
            $cotizacion->precioGranTotalVenta=$precioTotalVenta;
            $cotizacion->save(); 
            $chage_number=Cotizacion::find($cotizacion->id);
            $chage_number->num_cotizacion=$cotizacion->id;
            $chage_number->rel_qoute=$cotizacion->id;
            $chage_number->save();
            return json_encode(['success' => true]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(cotizacion $cotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = cotizacion::where('id', $id)->first();
        $client=cotizacion::find($id)->client;
        return view('cotizacion.edit',[
            'data'=>$data,
            'client'=>$client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function returnNum($id){
        $numRel=Cotizacion::select('rel_qoute')->where("id","=",$id)->first();
        $countNum=Cotizacion::where("rel_qoute","=",$numRel->rel_qoute)->count();
        if($countNum>1){

        }
        $letra="";
        switch ($countNum) {
            case 1:
                $letra="A";
                break;
            case 2:
                $letra="B";
                break;
            case 3:
                $letra="C";
                break;
            case 4:
                $letra="D";
                break;
            case 5:
                $letra="E";
                break;
            case 6:
                $letra="F";
                break;
            case 7:
                $letra="G";
                break;
            case 8:
                $letra="H";
                break;
            case 9:
                $letra="I";
                break;
            case 10:
                $letra="J";
                break;
            case 11:
                $letra="K";
                break;
            case 12:
                $letra="L";
                break;
            case 13:
                $letra="M";
                break;
            case 14:
                $letra="N";
                break;
            case 15:
                $letra="O";
                break;
            case 16:
                $letra="P";
                break;
            case 17:
                $letra="Q";
                break;
            case 18:
                $letra="R";
                break;
            case 19:
                $letra="S";
                break;
            case 20:
                $letra="T";
                break;
            default:
                $letra="N/A";
                break;
        }
        return $numRel->rel_qoute." - ".$letra;
    }
    public function update(Request $request,  $id)
    {
        $cotizacion = new cotizacion();
        $cotizacion->array=json_encode($request->export_array);
        //Variables de Calculo Usuario
        $cotizacion->prov=json_encode($request->export_prov);
        $cotizacion->marca=json_encode($request->export_marca);
        $cotizacion->cant=json_encode($request->export_cant);
        $cotizacion->ref=json_encode($request->export_ref);
        $cotizacion->desc=json_encode($request->export_desc);
        $cotizacion->peso=json_encode($request->export_peso);
        $cotizacion->cosl=json_encode($request->export_cosl);
        $cotizacion->cosc=json_encode($request->export_cosc);
        $cotizacion->dias=json_encode($request->export_dias);

        $cotizacion->rentabilidad_calc=$request->export_rentabilidad_calc;
        $cotizacion->trm_dia_calc=$request->export_trm_dia_calc;
        $cotizacion->flete_usd_calc=$request->export_flete_usd_calc;
        $cotizacion->flete_cop_calc=$request->export_flete_cop_calc;
        $cotizacion->arancel_calc=$request->export_arancel_calc;
        $cotizacion->comision_banco_transf_exterior_calc=$request->export_comision_banco_transf_exterior_calc;
        $cotizacion->nacionalizacion_calc=$request->export_nacionalizacion_calc;
        $cotizacion->transportadora_calc=$request->export_transportadora_calc;

        $cotizacion->porcPeso=json_encode($request->export_porcPeso);
        $cotizacion->pesoTotalXItem=json_encode($request->export_pesoTotalXItem);
        $cotizacion->sumaPesoTotal=$request->export_sumaPesoTotal;
        $cotizacion->costo_libra_calc=$request->export_costo_libra_calc;
        $cotizacion->costoTotalXPeso=$request->export_costoTotalXPeso;
        $cotizacion->porcPesoXItem=json_encode($request->export_porcPesoXItem);
        $cotizacion->costoTotalAntePeso=json_encode($request->export_costoTotalAntePeso);
        $cotizacion->costoValorImportXPeso=json_encode($request->export_costoValorImportXPeso);

        $cotizacion->costoValFleteInternoIntUSD=json_encode($request->export_costoValFleteInternoIntUSD);
        $cotizacion->CostoTotal=json_encode($request->export_CostoTotal);
        $cotizacion->CostoTotalPesosPartsImpor=json_encode($request->export_CostoTotalPesosPartsImpor);
        $cotizacion->costoTotalEnPesos=json_encode($request->export_costoTotalEnPesos);
        $cotizacion->costoTotalPartes=$request->export_costoTotalPartes;
    
        $cotizacion->costoTotalPFN=$request->export_costoTotalPFN;
        $cotizacion->costoTotalSinAdc=$request->export_costoTotalSinAdc;
        $cotizacion->GranTotalEnPesosPartsImport=$request->export_GranTotalEnPesosPartsImport;
        $cotizacion->GranTotalCostoPesos=$request->export_GranTotalCostoPesos;
        $cotizacion->CostoUnitPesosPartsImpor=json_encode($request->export_CostoUnitPesosPartsImpor);
        $cotizacion->PorcPesosAcuerdoPesos=json_encode($request->export_PorcPesosAcuerdoPesos);
        $cotizacion->Res_costoGranTotalPesosconAdc=$request->export_Res_costoGranTotalPesosconAdc;
        $cotizacion->costoTotalPesosImporMasNal=json_encode($request->export_costoTotalPesosImporMasNal);
        $cotizacion->precioVentaTotalXItem=json_encode($request->export_precioVentaTotalXItem);
        $cotizacion->precioVentaUnitarioXItem=json_encode($request->export_precioVentaUnitarioXItem);
        $cotizacion->ivaFinal=$request->export_ivaFinal;
        $cotizacion->GranTotal=$request->export_Gran_Total;
        $cotizacion->notas=$request->export_notas;
        $cotizacion->nombreCotizacion=$request->export_nombre;
        $cotizacion->rentabilidadFinal=$request->export_rentabilidadFinal;
        $cotizacion->rentabilidadFinalPorc=$request->export_rentabilidadFinalPorc;
        $cotizacion->dolarRealCalc=$request->export_dolarRealCalc;
        $cotizacion->created_by=$request->created_by;
        $cotizacion->client_id=$request->export_client_id;

        $precioTotalVenta=$request->export_precioGranTotalVenta;
        if($precioTotalVenta=="NaN" || $precioTotalVenta==""){

            return json_encode(['success' => false]);
        }
        else{
            
            $label_id=$this->returnNum($id);
            $cotizacion->precioGranTotalVenta=$precioTotalVenta;
            $numRel=Cotizacion::select('rel_qoute')->where("id","=",$id)->first();
            $cotizacion->rel_qoute=$numRel->rel_qoute;
            $cotizacion->save(); 
            $chage_number=Cotizacion::find($cotizacion->id);
            $chage_number->num_cotizacion=$label_id;
            $chage_number->save();
            return json_encode(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(cotizacion $cotizacion)
    {
        //
    }
    public function findGuest($id)
    {
        $query = clients::all()->where("id", "=", $id)->first();
        return $query;
    }
    public function findProvider($id){
        $query = providers::all()->where("id", "=", $id)->first();
        return $query;
    }

    // Función paralenar tabla de modal clientes

    public function getDataManyClients($data)
    {

        $parameter = $data; // Second Option: Search for name

        $parameter = strtoupper(str_replace("  ", "", $parameter));

        $Clients = clients::searchByName($parameter);
        

        return datatables($Clients)
            ->addColumn('empty', function () {
                return '  ';
            })
            ->addColumn('actions', function ($Clients) {
                return '<input class="form-check-input" type="radio" name="Clients" id="Guest_' . $Clients->id . '" value="' . $Clients->id . '">';
            })
            ->addColumn('identification', function ($Clients) {
                return $Clients->typeID . " - " . $Clients->numID;
            })
            ->rawColumns(['empty', 'identification', 'actions'])
            ->make(true);
    }

    // Función paralenar tabla de modal Proveedores

    public function getDataManyProvider($data)
    {
        $parameter = $data; // Second Option: Search for name

        $parameter = strtoupper(str_replace("  ", " ", $parameter));
        $Provider = providers::searchByName($parameter);

        return datatables($Provider)
            ->addColumn('empty', function () {
                return '  ';
            })
            ->addColumn('actions', function ($Provider) {
                return '<input class="form-check-input" type="radio" name="Provider" id="Guest_' . $Provider->id . '" value="' . $Provider->id . '">';
            })
            ->rawColumns(['empty', 'actions'])
            ->make(true);
    }

    public function getDataQoutes(Request $request)
    {

        $cotizacion = cotizacion::select('id','nombreCotizacion','num_cotizacion', 'array', 'cant', 'ref',  'marca', 'created_at')
        ->orderBy('id', 'desc');
        $datatables =  app('datatables')->of($cotizacion)
           
            ->addColumn('date_created', function ($cotizacion) {
                $timestamp = strtotime($cotizacion->created_at);
                $newDate = date("m-d-Y", $timestamp);
                return $newDate;
            })
            ->addColumn('cliente_cotizacion', function ($cotizacion) {
                $id_cliente=cotizacion::find($cotizacion->id)->client_id;
                $cliente="";
                if($id_cliente!=null){
                    $cliente=clients::find($id_cliente)->name;
                }
                return $cliente;
            })
            ->addColumn('cliente_id_num', function ($cotizacion) {
                $id_user=cotizacion::find($cotizacion->id)->created_by;
                $cliente=User::fullname($id_user); 
                return $cliente;
            })
            ->addColumn('export', function ($cotizacion) {
                return '<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25.8px, 0px);">
                            <a href="'.route('cotizacion.preview', ['id' => $cotizacion->id]).'" >
                                <button type="button" class="dropdown-item"">Previsualizar</button></a>   
                                <a href="'.url('cotizacion', [$cotizacion->id,'edit']).'" >
                                <button type="button" class="dropdown-item"">Editar</button></a>   
                            <a href="'.route('cotizacion.pdf', ['id' => $cotizacion->id]).'" >
                                <button type="button" class="dropdown-item"">Exportar PDF</button></a>
                        </div>';

                return '
                ';
            })
            ->addColumn('hidden', function ($cotizacion) {
                $cadena = str_replace('"','',$cotizacion->ref);
                $separador = ",";
                $separada = explode($separador, $cadena);
                $r="";
                foreach ($separada as $key ) {
                   $r.='<span>'.$key.'</span>';
                }
                return $r;
            })
            ->rawColumns(['date_created', 'cliente_cotizacion','export','cliente_id_num','hidden']);

        return $datatables->make(true);
    }
    public function exportPdf($id){
        $data=cotizacion::where('id',$id)->first();
        $array=json_decode($data->array);
        $info_contacto=$data->client;
        
        $numero=$data->num_cotizacion;
        $fecha=$data->created_at;
        //    return view('cotizacion.export_pdf',compact('info_contacto','array','data'));
        $pdf = PDF::loadView('cotizacion.export_pdf',compact('info_contacto','array','data'));
        return $pdf->download($numero.'_'.$fecha.'.pdf');
    }
    public function PreviewQoute($id){
        $data=cotizacion::where('id',$id)->first();
        $array=json_decode($data->array);
        $info_contacto=$data->client;
        
        $numero=$data->num_cotizacion;
        $fecha=$data->created_at;
        return view('cotizacion.preview_pdf',compact('info_contacto','array','data'));
    }
    
    
}
