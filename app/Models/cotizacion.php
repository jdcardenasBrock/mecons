<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\clients;

class cotizacion extends Model
{
    use HasFactory;

    protected $fillable =[
        'array',
        'prov',
        'marca',
        'cant',
        'ref',
        'desc',
        'peso',
        'cosl',
        'cosc',
        'dias',
        'rentabilidad_calc',
        'trm_dia_calc',
        'flete_usd_calc',
        'flete_cop_calc',
        'arancel_calc',
        'comision_banco_transf_exterior_calc',
        'nacionalizacion_calc',
        'transportadora_calc',
        'porcPeso',
        'pesoTotalXItem',
        'sumaPesoTotal',
        'costo_libra_calc',
        'costoTotalXPeso',
        'porcPesoXItem',
        'costoTotalAntePeso',
        'costoValorImportXPeso',
        'costoValFleteInternoIntUSD',
        'CostoTotal',
        'CostoTotalPesosPartsImpor',
        'costoTotalEnPesos',
        'costoTotalPartes',
        'costoTotalPFN',
        'costoTotalSinAdc',
        'GranTotalEnPesosPartsImport',
        'GranTotalCostoPesos',
        'CostoUnitPesosPartsImpor',
        'PorcPesosAcuerdoPesos',
        'Res_costoGranTotalPesosconAdc',
        'costoTotalPesosImporMasNal',
        'precioVentaTotalXItem',
        'precioVentaUnitarioXItem',
        'precioGranTotalVenta',
        'rentabilidadFinal',
        'rentabilidadFinalPorc',
        'dolarRealCalc',
        'client_id',
        'created_by',
        'modified_by',
        'rel_qoute','nombreCotizacion'
    ];

    /**
     * Get the user associated with the cotizacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(clients::class, 'id', 'client_id');
    }
  
}
