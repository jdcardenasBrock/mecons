                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @extends('layouts.app_dash')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Maestro de Proveedores</h1>
                
                <div class="top-right-button-container">
                    @can('crear_proveedor')
                    <button type="button" class="btn btn-outline-primary btn-lg top-right-button  mr-1" data-toggle="modal" data-backdrop="static" data-target="#addProvidersModal">Agregar Nuevo Registro</button>
                    @endcan
                    <div class="modal fade modal-right" id="addProvidersModal" tabindex="-1" role="dialog" aria-labelledby="addProvidersModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProvidersModalLabel">Formulario Nuevo Proveedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_providers" name="form_providers"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('proveedores')}}">
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" id="id_user_create" name="id_user_create" value="{{ Auth::user()->id }}" >
                                        @csrf
                                       
                                       
                                        <div class="form-group">
                                            <label>Nombre completo del proveedor</label>
                                            <input type="text" class="form-control"  id="fullnameProvider" name="fullnameProvider" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Pais de Origen</label>
                                            <select id="countryProvider" name="countryProvider" class="form-control">
                                                <option value="" selected>Seleccionar...</option>
                                                <option value="AFG">Afganistán </option>
                                                <option value="ALB">Albania</option>
                                                <option value="DEU">Alemania</option>
                                                <option value="AND">Andorra</option>
                                                <option value="AGO">Angola</option>
                                                <option value="ATG">Antigua y Barbuda</option>
                                                <option value="SAU">Arabia Saudita </option>
                                                <option value="DZA">Argelia</option>
                                                <option value="ARG">Argentina </option>
                                                <option value="ARM">Armenia</option>
                                                <option value="AUS">Australia</option>
                                                <option value="AUT">Austria</option>
                                                <option value="AZE">Azerbaiyán</option>
                                                <option value="BHS">Bahamas </option>
                                                <option value="BHR">Bahrein</option>
                                                <option value="BGD">Bangladesh</option>
                                                <option value="BRB">Barbados</option>
                                                <option value="BLR">Belarús</option>
                                                <option value="BEL">Bélgica</option>
                                                <option value="BLZ">Belice</option>
                                                <option value="BEN"> Benin</option>
                                                <option value="BTN"> Bhután</option>
                                                <option value="BOL"> Bolivia </option>
                                                <option value="BIH"> Bosnia y Herzegovina</option>
                                                <option value="BWA"> Botswana</option>
                                                <option value="BRA"> Brasil </option>
                                                <option value="BRN"> Brunei Darussalam</option>
                                                <option value="BGR"> Bulgaria</option>
                                                <option value="BFA"> Burkina Faso</option>
                                                <option value="BDI"> Burundi</option>
                                                <option value="CPV"> Cabo Verde</option>
                                                <option value="KHM"> Camboya</option>
                                                <option value="CMR"> Camerún </option>
                                                <option value="CAN"> Canadá </option>
                                                <option value="TCD"> Chad </option>
                                                <option value="CZE"> Chequia	</option>
                                                <option value="CHL"> Chile</option>
                                                <option value="CHN"> China</option>
                                                <option value="CYP"> Chipre</option>
                                                <option value="COL"> Colombia</option>
                                                <option value="COM" >Comoras </option>
                                                <option value="COG" >Congo </option>
                                                <option value="CRI" >Costa Rica</option>
                                                <option value="CIV" >Côte d’Ivoire</option>
                                                <option value="HRV" >Croacia</option>
                                                <option value="CUB" >Cuba</option>
                                                <option value="DNK" >Dinamarca</option>
                                                <option value="DJI" >Djibouti</option>
                                                <option value="DMA" >Dominica</option>
                                                <option value="ECU" >Ecuador </option>
                                                <option value="EGY" >Egipto</option>
                                                <option value="SLV" >El Salvador</option>
                                                <option value="ARE" >Emiratos Árabes Unidos </option>
                                                <option value="ERI" >Eritrea</option>
                                                <option value="SVK" >Eslovaquia</option>
                                                <option value="SVN" >Eslovenia</option>
                                                <option value="ESP" >España</option>
                                                <option value="USA" >Estados Unidos de América </option>
                                                <option value="EST" >Estonia</option>
                                                <option value="SWZ" >Eswatini</option>
                                                <option value="ETH">Etiopía</option>
                                                <option value="RUS">Federación de Rusia </option>
                                                <option value="FJI">Fiji</option>
                                                <option value="PHL">Filipinas</option>
                                                <option value="FIN">Finlandia</option>
                                                <option value="FRA">Francia</option>
                                                <option value="GAB">Gabón </option>
                                                <option value="GMB">Gambia</option>
                                                <option value="GEO">Georgia</option>
                                                <option value="GHA">Ghana</option>
                                                <option value="GRD">Granada</option>
                                                <option value="GRC">Grecia</option>
                                                <option value="GTM">Guatemala</option>
                                                <option value="GIN">Guinea</option>
                                                <option value="GNQ">Guinea Ecuatorial</option>
                                                <option value="GNB">Guinea-Bissau</option>
                                                <option value="GUY">Guyana</option>
                                                <option value="HTI">Haití</option>
                                                <option value="HND">Honduras</option>
                                                <option value="HUN">Hungría</option>
                                                <option value="IND">India </option>
                                                <option value="IDN">Indonesia</option>
                                                <option value="IRN">Irán </option>
                                                <option value="IRQ">Iraq </option>
                                                <option value="IRL">Irlanda</option>
                                                <option value="ISL">Islandia</option>
                                                <option value="COK">Islas Cook 	</option>
                                                <option value="MHL">Islas Marshall </option>
                                                <option value="SLB">Islas Salomón </option>
                                                <option value="ISR">Israel</option>
                                                <option value="ITA">Italia</option>
                                                <option value="JAM">Jamaica</option>
                                                <option value="JPN">Japón </option>
                                                <option value="JOR">Jordania</option>
                                                <option value="KAZ">Kazajstán</option>
                                                <option value="KEN">Kenya</option>
                                                <option value="KGZ">Kirguistán</option>
                                                <option value="KIR">Kiribati</option>
                                                <option value="KWT">Kuwait</option>
                                                <option value="LSO">Lesotho</option>
                                                <option value="LVA">Letonia</option>
                                                <option value="LBN">Líbano </option>
                                                <option value="LBR">Liberia</option>
                                                <option value="LBY">Libia</option>
                                                <option value="LIE">Liechtenstein</option>
                                                <option value="LTU">Lituania</option>
                                                <option value="LUX">Luxemburgo</option>
                                                <option value="MDG">Madagascar</option>
                                                <option value="MYS">Malasia</option>
                                                <option value="MWI">Malawi</option>
                                                <option value="MDV">Maldivas</option>
                                                <option value="MLI">Malí</option>
                                                <option value="MLT">Malta</option>
                                                <option value="MAR">Marruecos</option>
                                                <option value="MUS">Mauricio</option>
                                                <option value="MRT">Mauritania</option>
                                                <option value="MEX">México</option>
                                                <option value="FSM">Micronesia</option>
                                                <option value="MCO">Mónaco</option>
                                                <option value="MNG">Mongolia</option>
                                                <option value="MNE">Montenegro</option>
                                                <option value="MOZ">Mozambique</option>
                                                <option value="MMR">Myanmar</option>
                                                <option value="NAM">Namibia</option>
                                                <option value="NRU">Nauru</option>
                                                <option value="NPL">Nepal</option>
                                                <option value="NIC">Nicaragua</option>
                                                <option value="NER">Níger </option>
                                                <option value="NGA">Nigeria</option>
                                                <option value="NIU">Niue	</option>
                                                <option value="NOR">Noruega</option>
                                                <option value="NZL">Nueva Zelandia</option>
                                                <option value="OMN">Omán</option>
                                                <option value="NLD">Países Bajos </option>
                                                <option value="PAK">Pakistán </option>
                                                <option value="PLW">Palau</option>
                                                <option value="PAN">Panamá</option>
                                                <option value="PNG">Papua Nueva Guinea</option>
                                                <option value="PRY">Paraguay </option>
                                                <option value="PER">Perú </option>
                                                <option value="POL">Polonia</option>
                                                <option value="PRT">Portugal</option>
                                                <option value="QAT">Qatar</option>
                                                <option value="GBR">Reino Unido de Gran Bretaña e Irlanda del Norte </option>
                                                <option value="SYR">República Árabe Siria </option>
                                                <option value="CAF">República Centroafricana </option>
                                                <option value="KOR">República de Corea </option>
                                                <option value="MKD">República de Macedonia del Norte </option>
                                                <option value="MDA">República de Moldova</option>
                                                <option value="COD">República Democrática del Congo </option>
                                                <option value="LAO">República Democrática Popular Lao </option>
                                                <option value="DOM">República Dominicana </option>
                                                <option value="PRK">República Popular Democrática de Corea</option>
                                                <option value="TZA">República Unida de Tanzanía </option>
                                                <option value="ROU">Rumania</option>
                                                <option value="RWA">Rwanda</option>
                                                <option value="KNA">Saint Kitts y Nevis</option>
                                                <option value="WSM">Samoa</option>
                                                <option value="SMR">San Marino</option>
                                                <option value="VCT">San Vicente y las Granadinas</option>
                                                <option value="LCA">Santa Lucía</option>
                                                <option value="VAT">Santa Sede 	</option>
                                                <option value="STP">Santo Tomé y Príncipe</option>
                                                <option value="SEN">Senegal </option>
                                                <option value="SRB">Serbia</option>
                                                <option value="SYC">Seychelles</option>
                                                <option value="SLE">Sierra Leona</option>
                                                <option value="SGP">Singapur</option>
                                                <option value="SOM">Somalia</option>
                                                <option value="LKA">Sri Lanka</option>
                                                <option value="ZAF">Sudáfrica</option>
                                                <option value="SDN">Sudán </option>
                                                <option value="SSD">Sudán del Sur	</option>
                                                <option value="SWE">Suecia</option>
                                                <option value="CHE">Suiza</option>
                                                <option value="SUR">Suriname</option>
                                                <option value="THA">Tailandia</option>
                                                <option value="TJK">Tayikistán</option>
                                                <option value="TLS">Timor-Leste</option>
                                                <option value="TGO">Togo </option>
                                                <option value="TON">Tonga</option>
                                                <option value="TTO">Trinidad y Tabago</option>
                                                <option value="TUN">Túnez</option>
                                                <option value="TKM">Turkmenistán</option>
                                                <option value="TUR">Turquía</option>
                                                <option value="TUV">Tuvalu</option>
                                                <option value="UKR">Ucrania</option>
                                                <option value="UGA">Uganda</option>
                                                <option value="URY">Uruguay </option>
                                                <option value="UZB">Uzbekistán</option>
                                                <option value="VUT">Vanuatu</option>
                                                <option value="VEN">Venezuela </option>
                                                <option value="VNM">Viet Nam</option>
                                                <option value="YEM">Yemen </option>
                                                <option value="ZMB">Zambia</option>
                                                <option value="ZWE">Zimbabwe</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" placeholder="" id="directionProvider" name="directionProvider">
                                        </div>
                                        <div class="form-group">
                                            <label>Correo</label>
                                            <input type="email" class="form-control"  id="mailProvider" name="mailProvider" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" placeholder="" id="phoneProvider" name="phoneProvider">
                                        </div>
                                        <div class="form-group">
                                            <label>Pagina Web</label>
                                            <input type="text" class="form-control" placeholder="" id="pageWebProvider" name="pageWebProvider">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal para edicion --}}
                    <div class="modal fade modal-right" id="EditProviders" tabindex="-1" role="dialog" aria-labelledby="EditProvidersLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditProvidersLabel">Formulario Edición de Registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="form_edit_providers" name="form_edit_providers"  accept-charset="UTF-8" >
                                        <input type="hidden" id="_url"  name="_url" value="{{url('proveedores')}}">
                                        <input type="hidden" id="_edit_id"  name="_edit_id" value="{{url('proveedores')}}">
                                        <input type="hidden" id="id_user_edit" name="id_user_edit" value="{{ Auth::user()->id }}" >
                                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nombre completo del proveedor *</label>
                                            <input type="text" class="form-control"  id="edit_fullnameProvider" name="edit_fullnameProvider" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Pais de Origen *</label>
                                            <select id="edit_countryProvider" name="edit_countryProvider" class="form-control">
                                                <option value="" selected>Seleccionar...</option>
                                                <option value="AFG">Afganistán </option>
                                                <option value="ALB">Albania</option>
                                                <option value="DEU">Alemania</option>
                                                <option value="AND">Andorra</option>
                                                <option value="AGO">Angola</option>
                                                <option value="ATG">Antigua y Barbuda</option>
                                                <option value="SAU">Arabia Saudita </option>
                                                <option value="DZA">Argelia</option>
                                                <option value="ARG">Argentina </option>
                                                <option value="ARM">Armenia</option>
                                                <option value="AUS">Australia</option>
                                                <option value="AUT">Austria</option>
                                                <option value="AZE">Azerbaiyán</option>
                                                <option value="BHS">Bahamas </option>
                                                <option value="BHR">Bahrein</option>
                                                <option value="BGD">Bangladesh</option>
                                                <option value="BRB">Barbados</option>
                                                <option value="BLR">Belarús</option>
                                                <option value="BEL">Bélgica</option>
                                                <option value="BLZ">Belice</option>
                                                <option value="BEN"> Benin</option>
                                                <option value="BTN"> Bhután</option>
                                                <option value="BOL"> Bolivia </option>
                                                <option value="BIH"> Bosnia y Herzegovina</option>
                                                <option value="BWA"> Botswana</option>
                                                <option value="BRA"> Brasil </option>
                                                <option value="BRN"> Brunei Darussalam</option>
                                                <option value="BGR"> Bulgaria</option>
                                                <option value="BFA"> Burkina Faso</option>
                                                <option value="BDI"> Burundi</option>
                                                <option value="CPV"> Cabo Verde</option>
                                                <option value="KHM"> Camboya</option>
                                                <option value="CMR"> Camerún </option>
                                                <option value="CAN"> Canadá </option>
                                                <option value="TCD"> Chad </option>
                                                <option value="CZE"> Chequia	</option>
                                                <option value="CHL"> Chile</option>
                                                <option value="CHN"> China</option>
                                                <option value="CYP"> Chipre</option>
                                                <option value="COL"> Colombia</option>
                                                <option value="COM" >Comoras </option>
                                                <option value="COG" >Congo </option>
                                                <option value="CRI" >Costa Rica</option>
                                                <option value="CIV" >Côte d’Ivoire</option>
                                                <option value="HRV" >Croacia</option>
                                                <option value="CUB" >Cuba</option>
                                                <option value="DNK" >Dinamarca</option>
                                                <option value="DJI" >Djibouti</option>
                                                <option value="DMA" >Dominica</option>
                                                <option value="ECU" >Ecuador </option>
                                                <option value="EGY" >Egipto</option>
                                                <option value="SLV" >El Salvador</option>
                                                <option value="ARE" >Emiratos Árabes Unidos </option>
                                                <option value="ERI" >Eritrea</option>
                                                <option value="SVK" >Eslovaquia</option>
                                                <option value="SVN" >Eslovenia</option>
                                                <option value="ESP" >España</option>
                                                <option value="USA" >Estados Unidos de América </option>
                                                <option value="EST" >Estonia</option>
                                                <option value="SWZ" >Eswatini</option>
                                                <option value="ETH">Etiopía</option>
                                                <option value="RUS">Federación de Rusia </option>
                                                <option value="FJI">Fiji</option>
                                                <option value="PHL">Filipinas</option>
                                                <option value="FIN">Finlandia</option>
                                                <option value="FRA">Francia</option>
                                                <option value="GAB">Gabón </option>
                                                <option value="GMB">Gambia</option>
                                                <option value="GEO">Georgia</option>
                                                <option value="GHA">Ghana</option>
                                                <option value="GRD">Granada</option>
                                                <option value="GRC">Grecia</option>
                                                <option value="GTM">Guatemala</option>
                                                <option value="GIN">Guinea</option>
                                                <option value="GNQ">Guinea Ecuatorial</option>
                                                <option value="GNB">Guinea-Bissau</option>
                                                <option value="GUY">Guyana</option>
                                                <option value="HTI">Haití</option>
                                                <option value="HND">Honduras</option>
                                                <option value="HUN">Hungría</option>
                                                <option value="IND">India </option>
                                                <option value="IDN">Indonesia</option>
                                                <option value="IRN">Irán </option>
                                                <option value="IRQ">Iraq </option>
                                                <option value="IRL">Irlanda</option>
                                                <option value="ISL">Islandia</option>
                                                <option value="COK">Islas Cook 	</option>
                                                <option value="MHL">Islas Marshall </option>
                                                <option value="SLB">Islas Salomón </option>
                                                <option value="ISR">Israel</option>
                                                <option value="ITA">Italia</option>
                                                <option value="JAM">Jamaica</option>
                                                <option value="JPN">Japón </option>
                                                <option value="JOR">Jordania</option>
                                                <option value="KAZ">Kazajstán</option>
                                                <option value="KEN">Kenya</option>
                                                <option value="KGZ">Kirguistán</option>
                                                <option value="KIR">Kiribati</option>
                                                <option value="KWT">Kuwait</option>
                                                <option value="LSO">Lesotho</option>
                                                <option value="LVA">Letonia</option>
                                                <option value="LBN">Líbano </option>
                                                <option value="LBR">Liberia</option>
                                                <option value="LBY">Libia</option>
                                                <option value="LIE">Liechtenstein</option>
                                                <option value="LTU">Lituania</option>
                                                <option value="LUX">Luxemburgo</option>
                                                <option value="MDG">Madagascar</option>
                                                <option value="MYS">Malasia</option>
                                                <option value="MWI">Malawi</option>
                                                <option value="MDV">Maldivas</option>
                                                <option value="MLI">Malí</option>
                                                <option value="MLT">Malta</option>
                                                <option value="MAR">Marruecos</option>
                                                <option value="MUS">Mauricio</option>
                                                <option value="MRT">Mauritania</option>
                                                <option value="MEX">México</option>
                                                <option value="FSM">Micronesia</option>
                                                <option value="MCO">Mónaco</option>
                                                <option value="MNG">Mongolia</option>
                                                <option value="MNE">Montenegro</option>
                                                <option value="MOZ">Mozambique</option>
                                                <option value="MMR">Myanmar</option>
                                                <option value="NAM">Namibia</option>
                                                <option value="NRU">Nauru</option>
                                                <option value="NPL">Nepal</option>
                                                <option value="NIC">Nicaragua</option>
                                                <option value="NER">Níger </option>
                                                <option value="NGA">Nigeria</option>
                                                <option value="NIU">Niue	</option>
                                                <option value="NOR">Noruega</option>
                                                <option value="NZL">Nueva Zelandia</option>
                                                <option value="OMN">Omán</option>
                                                <option value="NLD">Países Bajos </option>
                                                <option value="PAK">Pakistán </option>
                                                <option value="PLW">Palau</option>
                                                <option value="PAN">Panamá</option>
                                                <option value="PNG">Papua Nueva Guinea</option>
                                                <option value="PRY">Paraguay </option>
                                                <option value="PER">Perú </option>
                                                <option value="POL">Polonia</option>
                                                <option value="PRT">Portugal</option>
                                                <option value="QAT">Qatar</option>
                                                <option value="GBR">Reino Unido de Gran Bretaña e Irlanda del Norte </option>
                                                <option value="SYR">República Árabe Siria </option>
                                                <option value="CAF">República Centroafricana </option>
                                                <option value="KOR">República de Corea </option>
                                                <option value="MKD">República de Macedonia del Norte </option>
                                                <option value="MDA">República de Moldova</option>
                                                <option value="COD">República Democrática del Congo </option>
                                                <option value="LAO">República Democrática Popular Lao </option>
                                                <option value="DOM">República Dominicana </option>
                                                <option value="PRK">República Popular Democrática de Corea</option>
                                                <option value="TZA">República Unida de Tanzanía </option>
                                                <option value="ROU">Rumania</option>
                                                <option value="RWA">Rwanda</option>
                                                <option value="KNA">Saint Kitts y Nevis</option>
                                                <option value="WSM">Samoa</option>
                                                <option value="SMR">San Marino</option>
                                                <option value="VCT">San Vicente y las Granadinas</option>
                                                <option value="LCA">Santa Lucía</option>
                                                <option value="VAT">Santa Sede 	</option>
                                                <option value="STP">Santo Tomé y Príncipe</option>
                                                <option value="SEN">Senegal </option>
                                                <option value="SRB">Serbia</option>
                                                <option value="SYC">Seychelles</option>
                                                <option value="SLE">Sierra Leona</option>
                                                <option value="SGP">Singapur</option>
                                                <option value="SOM">Somalia</option>
                                                <option value="LKA">Sri Lanka</option>
                                                <option value="ZAF">Sudáfrica</option>
                                                <option value="SDN">Sudán </option>
                                                <option value="SSD">Sudán del Sur	</option>
                                                <option value="SWE">Suecia</option>
                                                <option value="CHE">Suiza</option>
                                                <option value="SUR">Suriname</option>
                                                <option value="THA">Tailandia</option>
                                                <option value="TJK">Tayikistán</option>
                                                <option value="TLS">Timor-Leste</option>
                                                <option value="TGO">Togo </option>
                                                <option value="TON">Tonga</option>
                                                <option value="TTO">Trinidad y Tabago</option>
                                                <option value="TUN">Túnez</option>
                                                <option value="TKM">Turkmenistán</option>
                                                <option value="TUR">Turquía</option>
                                                <option value="TUV">Tuvalu</option>
                                                <option value="UKR">Ucrania</option>
                                                <option value="UGA">Uganda</option>
                                                <option value="URY">Uruguay </option>
                                                <option value="UZB">Uzbekistán</option>
                                                <option value="VUT">Vanuatu</option>
                                                <option value="VEN">Venezuela </option>
                                                <option value="VNM">Viet Nam</option>
                                                <option value="YEM">Yemen </option>
                                                <option value="ZMB">Zambia</option>
                                                <option value="ZWE">Zimbabwe</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Dirección *</label>
                                            <input type="text" class="form-control" placeholder="" id="edit_directionProvider" name="edit_directionProvider">
                                        </div>
                                        <div class="form-group">
                                            <label>Correo *</label>
                                            <input type="email" class="form-control"  id="edit_mailProvider" name="edit_mailProvider" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefono *</label>
                                            <input type="text" class="form-control" placeholder="" id="edit_phoneProvider" name="edit_phoneProvider">
                                        </div>
                                        <div class="form-group">
                                            <label>Pagina Web</label>
                                            <input type="text" class="form-control" placeholder="" id="edit_pageWebProvider" name="edit_pageWebProvider">
                                        </div>
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Editar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="separator mb-5"></div>
          
     
        @can('visualizar_proveedor')
            <table class="table table-bordered" id="providers_table">
                <thead>
                    <tr>
                        
                        <th>Nombre completo del proveedor</th>
                        <th>Pais de Origen</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Pagina Web</th>
                        <th>Fecha de Creación</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            @endcan
        </div>
    </div>
</div>


@endsection
@push('scripts')
    <script src="{{asset('js/providers.js')}}"></script>
   <script>
       

        
      
    var ProvidersTable= $('#providers_table').DataTable({
                "language": {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                responsive: true,
                processing: true,
                serverSide: true,
                Search:true,
                ajax: {
                    url: '{!! route('Providers.data') !!}',
                },
                
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'country', name: 'country',orderable:false, searchable:false },
                    { data: 'direction', name: 'direction'},
                    { data: 'email', name: 'email' , orderable:false, searchable:false},
                    { data: 'phone', name: 'phone' , orderable:false, searchable:false},
                    {data: 'pageWeb', name:'pageWeb'},
                    { data: 'date_created', name: 'date_created', orderable:false, searchable:false },
                    { data: 'actions', name: 'actions', orderable:false, searchable:false },
                ]
        });
    $('#search-form').on('submit', function(e) {
        ProvidersTable.draw();
        e.preventDefault();
    });
    //metodo para eliminar registro
    function drop(event){
        var ID =event.id;
        let confirmacion=confirm("¿Esta seguro de eliminar? No puede reversar esta accion.");
        if(confirmacion){
            $.ajax({
                url: $("#form_providers #_url").val() +"/"+ ID,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'DELETE',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#references_table').DataTable().ajax.reload();
                    alert('Referencia eliminada exitosamente');
                    location.href=$("#_url").val();
                    }else{
                    alert(json.data);
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : No se puede Eliminar - Este registro hace parte de otro modulo!' );
            });
            return false;
                
        }
    }
    function vaciarEditInputs(){
            $("#_edit_id").val("");
            $('#edit_fullnameProvider').val("");
            $('#edit_countryProvider').val("");
            $('#edit_directionProvider').val("");
            $('#edit_mailProvider').val("");
            $('#edit_phoneProvider').val("");
            $('#edit_pageWebProvider').val("");
        }

    function edit(event){
        vaciarEditInputs();
        var ID =event.id;
            $.ajax({
                url: $("#form_providers #_url").val() +"/"+ID+"/edit" ,
                headers: {'X-CSRF-TOKEN': $('#_token').val()},
                type: 'GET',
                success: function (response) {
                  var json = $.parseJSON(response);
                  if(json.success){
                    $('#EditProviders').modal('show');
                    $("#_edit_id").val(json.data.id);
                    $('#edit_fullnameProvider').val(json.data.name);
                    $('#edit_countryProvider').val(json.data.country);
                    $('#edit_directionProvider').val(json.data.direction);
                    $('#edit_mailProvider').val(json.data.email);
                    $('#edit_phoneProvider').val(json.data.phone);
                    $('#edit_pageWebProvider').val(json.data.pageWeb);
                    }else{
                    alert(json.data);
                    }
                }
              }).fail( function( response ) {
                alert( 'Error 101-1 : Ha ocurrido un error!' );
            });
            return false;
    }

   
    </script>
@endpush