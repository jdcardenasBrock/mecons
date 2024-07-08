<?php
 function format_number($n) {

    if (!is_null($n) && is_numeric($n)) {
        return number_format($n, 2, ',', '.');
    } else {
        // Manejar el caso cuando $n no es un número válido
        return '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Mecons</title>

</head>
<body style="height: 842px; width: 795px;margin-left: auto; margin-right: auto;">
 
    <div class="row invoice" id="qoute_content" style="display: block" >
        <div class="col-12">
            <table cellspacing="0" style="border-collapse:collapse; width:100.0%">
                
                <tbody>
                    <tr>
                        <td style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;float:left" valign="left" align="left">
                            <img src="https://inversionesmecons.com/logos/black.jpeg" alt="" style="width: 178px;height: 68px;">
                        </td>
                        <td style="padding-left:25px; padding-top:5px; border-top:0;width:100% !important;float:center" valign="left" align="left">
                            <p style="color: #242128; font-weight: 500; line-height: 1.2; font-size: 12px;text-align:center">
                                <strong>MECONS INGENIERIA Y CONSTRUCCIÓN SAS</strong><br> NIT901480317-6
                            </p>
                        </td>
                        <td style="padding-bottom:15px; padding-top:15px; border-top:0;width:100% !important;" valign="center" align="right">
                            <p style="color: #8f8f8f; font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                                3142277964<br> WWW.MECONS.COM.CO<br>diego.cardenas@mecons.com.co<br> CRA. 73 # 3 - 69 - Bogotá D.C.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding-top:30px; border-top:1px solid #f1f0f0">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="text-align:left; font-size: 13px; color:#8f8f8f; padding-bottom: 15px;">
                                            Cotización
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white;">
                                            <p style="color:#303030; font-size: 13px;  line-height: 1.6; margin:0; padding:0;" id="contact_client">
                                                
                                                {{$info_contacto->name}}<br>
                                                {{$info_contacto->typeID}} - {{$info_contacto->numID}}<br>
                                                {{$info_contacto->direccion}}<br>
                                                {{$info_contacto->telefono}}<br>

                                                </p>
                                        </td>

                                        <td style="text-align: center; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:10px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white;">
                                            <p style="color:#D95C00; font-size: 14px; padding: 0; line-height: 1.6; margin:0; " id="contact_qoute">
                                                Cotización No. {{$data->num_cotizacion}}
                                            </p>
                                            <p style="font-size: 14px; padding: 0; line-height: 1.6; margin:0; ">
                                                <?php
                                                    \Carbon\Carbon::setLocale('es');
                                                    echo \Carbon\Carbon::parse($data->created_at)->isoFormat('DD/MM/YYYY');
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width: 100%; margin-top:40px;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            ITEM
                                        </th>
                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            CANTIDAD
                                        </th>
                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            REFERENCIA
                                        </th>
                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            DESCRIPCIÓN
                                        </th>
                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            MARCA
                                        </th>
                                        <th style="text-align:center; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            DIAS ENTREGA
                                        </th>
                                        <th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            PRECIO UNITARIO
                                        </th>
                                        <th style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                            TOTAL
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="content_items_qoute">
                                    
                                        @php
                                        $array_aux=json_decode($data->array);
                                        $array_final=explode(',',$array_aux);
                                        $cant_aux=json_decode($data->cant);
                                        $cant_final=explode(',',$cant_aux);
                                        $ref_aux=json_decode($data->ref);
                                        $ref_final=explode(',',$ref_aux);
                                        $desc_aux=json_decode($data->desc);
                                        $desc_final=explode(',',$desc_aux);
                                        $marca_aux=json_decode($data->marca);
                                        $marca_final=explode(',',$marca_aux);
                                        $dias_aux=json_decode($data->dias);
                                        $dias_final=explode(',',$dias_aux);
                                        $unit_aux=json_decode($data->precioVentaUnitarioXItem);
                                        $unit_final=explode(',',$unit_aux);
                                        $total_aux=json_decode($data->precioVentaTotalXItem);
                                        $total_final=explode(',',$total_aux);
                                        @endphp
                                        
                                            @foreach ( $array_final as $iterador => $clave) 
                                            <tr>
                                                <td style="padding-top:0px; padding-bottom:5px;">
                                                <p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;"> {{$clave}}</p></td>
                                                <td><p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">{{$cant_final[$iterador]}}</p></td> 
                                                <td><p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">{{$ref_final[$iterador]}}</p></td>
                                                <td><p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">{{$desc_final[$iterador]}}</p></td> 
                                                <td><p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">{{$marca_final[$iterador]}}</p></td> 
                                                <td><p style="font-size: 13px; text-align: center; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">{{$dias_final[$iterador]}}</p></td>
                                                <td><p style="font-size: 13px; text-align: right; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">$ {{format_number($unit_final[$iterador])}}</p></td>
                                                <td><p style="font-size: 13px; text-align: right; line-height: 1; color:#303030; margin-top:0px; margin-bottom:0;">$ {{format_number($total_final[$iterador])}}</p></td> 
                                            </tr> 
                                            @endforeach
                                                    
                                
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12" style="position:absolute; bottom:0; width: 795px">
            <table cellspacing="0" style="border-collapse:collapse; width: 795px" >
                <tbody>
                    <tr>
                        <td style="width: 100%" colspan="3">
                            <p id="numerosLetras" style="font-size: 13px; text-decoration: uppercase; line-height: 1.6; color:black; margin-top:0px; margin-bottom:0; text-align: left; background-color:#cccbcb;">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%" colspan="1">
                            <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: left;">
                                Observaciones</p>
                        </td>
                        <td style="padding-top:0px; text-align: right;">
                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                Subtotal</p>
                        </td>
                        <td style="padding-top:0px; text-align: right;">
                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px" id="SubtotalPrev">
                                $ {{format_number($data->precioGranTotalVenta)}}
                                </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%" colspan="1">
                            <p  style="font-size: 9px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: left;">
                                {{$data->notas}}  
                            </p>
                        </td>
                        <td style="padding-top:0px; text-align: right;">
                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                IVA (19%)</p>
                        </td>
                        <td style="padding-top:0px; text-align: right;">
                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px" id="valIvaSubtotal">
                                $ {{format_number($data->ivaFinal)}}   
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%" colspan="1">
                            <p href="#" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: left;">
                                </p>
                        </td>
                        <td style="padding-top:0px; text-align: right;">
                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                Total</p>
                        </td>
                        <td style="padding-top:0px; text-align: right;">
                            <p style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; font-weight:800; vertical-align:top; white-space:nowrap; margin-left:15px" id="totalCotizacion">
                                $ {{format_number($data->GranTotal)}}    
                            </p>
                        </td>
                    </tr>
                        <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            <p style="color: #909090; font-size:11px; text-align:center;">Invoice was created
                                on a computer and
                                is valid without the signature and seal. </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    let granTotal=@json($data->GranTotal);
    let NumerosLetrasTotal=NumeroALetras(granTotal);
    $("#numerosLetras").html(NumerosLetrasTotal);
});


function Unidades(num){

switch(num)
{
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
}

return "";
}//Unidades()

function Decenas(num){

decena = Math.floor(num/10);
unidad = num - (decena * 10);

switch(decena)
{
    case 1:
        switch(unidad)
        {
            case 0: return "DIEZ";
            case 1: return "ONCE";
            case 2: return "DOCE";
            case 3: return "TRECE";
            case 4: return "CATORCE";
            case 5: return "QUINCE";
            default: return "DIECI" + Unidades(unidad);
        }
    case 2:
        switch(unidad)
        {
            case 0: return "VEINTE";
            default: return "VEINTI" + Unidades(unidad);
        }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
}
}//Unidades()

function DecenasY(strSin, numUnidades) {
if (numUnidades > 0)
return strSin + " Y " + Unidades(numUnidades)

return strSin;
}//DecenasY()

function Centenas(num) {
centenas = Math.floor(num / 100);
decenas = num - (centenas * 100);

switch(centenas)
{
    case 1:
        if (decenas > 0)
            return "CIENTO " + Decenas(decenas);
        return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
}

return Decenas(decenas);
}//Centenas()

function Seccion(num, divisor, strSingular, strPlural) {
cientos = Math.floor(num / divisor)
resto = num - (cientos * divisor)

letras = "";

if (cientos > 0)
    if (cientos > 1)
        letras = Centenas(cientos) + " " + strPlural;
    else
        letras = strSingular;

if (resto > 0)
    letras += "";

return letras;
}//Seccion()

function Miles(num) {
divisor = 1000;
cientos = Math.floor(num / divisor)
resto = num - (cientos * divisor)

strMiles = Seccion(num, divisor, "UN MIL", "MIL");
strCentenas = Centenas(resto);

if(strMiles == "")
    return strCentenas;

return strMiles + " " + strCentenas;
}//Miles()

function Millones(num) {
divisor = 1000000;
cientos = Math.floor(num / divisor)
resto = num - (cientos * divisor)

strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
strMiles = Miles(resto);

if(strMillones == "")
    return strMiles;

return strMillones + " " + strMiles;
}//Millones()

function NumeroALetras(num) {
var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
    letrasMonedaPlural: 'PESOS',//"PESOS", 'Dólares', 'Bolívares', 'etcs'
    letrasMonedaSingular: 'PESO', //"PESO", 'Dólar', 'Bolivar', 'etc'

    letrasMonedaCentavoPlural: "CENTAVOS",
    letrasMonedaCentavoSingular: "CENTAVO"
};

if (data.centavos > 0) {
    data.letrasCentavos = "CON " + (function (){
        if (data.centavos == 1)
            return Millones(data.centavos) + " " + data.letrasMonedaCentavoSingular;
        else
            return Millones(data.centavos) + " " + data.letrasMonedaCentavoPlural;
        })();
};

if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()

</script>