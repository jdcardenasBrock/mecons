<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosMunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            "Amazonas" => ["Leticia", "Puerto Nariño", "El Encanto", "La Chorrera", "La Pedrera", "Mirití-Paraná", "Puerto Alegría", "Puerto Arica", "Puerto Santander", "Tarapacá"],
            "Antioquia" => ["Medellín", "Bello", "Envigado", "Itagüí", "Apartadó", "Turbo", "Caucasia", "Rionegro", "Sabaneta", "La Ceja"],
            "Arauca" => ["Arauca", "Arauquita", "Saravena", "Tame", "Fortul", "Cravo Norte", "Puerto Rondón"],
            "Atlántico" => ["Barranquilla", "Soledad", "Malambo", "Puerto Colombia", "Sabanalarga", "Galapa", "Baranoa", "Polonuevo", "Luruaco", "Santo Tomás"],
            "Bogotá D.C." => ["Bogotá"],
            "Bolívar" => ["Cartagena", "Magangué", "Turbaco", "Arjona", "El Carmen de Bolívar", "Mompós", "Santa Rosa del Sur", "San Juan Nepomuceno", "Villanueva", "María la Baja"],
            "Boyacá" => ["Tunja", "Duitama", "Sogamoso", "Chiquinquirá", "Puerto Boyacá", "Moniquirá", "Paipa", "Villa de Leyva", "Soatá", "Miraflores"],
            "Caldas" => ["Manizales", "La Dorada", "Chinchiná", "Riosucio", "Aguadas", "Anserma", "Villamaría", "Pácora", "Neira", "Pensilvania"],
            "Caquetá" => ["Florencia", "San Vicente del Caguán", "Puerto Rico", "El Doncello", "La Montañita", "Belén de los Andaquíes", "Curillo", "Morelia", "Solano", "Valparaíso"],
            "Casanare" => ["Yopal", "Aguazul", "Villanueva", "Tauramena", "Monterrey", "Orocué", "Paz de Ariporo", "Hato Corozal", "Nunchía", "Sabanalarga"],
            "Cauca" => ["Popayán", "Santander de Quilichao", "Puerto Tejada", "Miranda", "Patía", "Timbío", "El Tambo", "Piendamó", "Balboa", "Toribío"],
            "Cesar" => ["Valledupar", "Aguachica", "Codazzi", "La Jagua de Ibirico", "Bosconia", "Curumaní", "Pailitas", "San Alberto", "Río de Oro", "Becerril"],
            "Chocó" => ["Quibdó", "Istmina", "Condoto", "Tadó", "Bahía Solano", "Riosucio", "Bagadó", "Lloró", "Unguía", "Acandí"],
            "Córdoba" => ["Montería", "Lorica", "Sahagún", "Cereté", "Montelíbano", "Tierralta", "Planeta Rica", "Chinú", "Puerto Escondido", "San Pelayo"],
            "Cundinamarca" => ["Soacha", "Facatativá", "Zipaquirá", "Fusagasugá", "Girardot", "Chía", "Mosquera", "Funza", "Madrid", "Cajicá"],
            "Guainía" => ["Inírida", "Barrancominas"],
            "Guaviare" => ["San José del Guaviare", "Calamar", "El Retorno", "Miraflores"],
            "Huila" => ["Neiva", "Pitalito", "Garzón", "La Plata", "Campoalegre", "San Agustín", "Yaguará", "Isnos", "Gigante", "Tarqui"],
            "La Guajira" => ["Riohacha", "Maicao", "Uribia", "Fonseca", "Villanueva", "San Juan del Cesar", "Dibulla", "Manaure", "Barrancas", "Hatonuevo"],
            "Magdalena" => ["Santa Marta", "Ciénaga", "Fundación", "El Banco", "Aracataca", "Pivijay", "Plato", "Zona Bananera", "Tenerife", "San Sebastián de Buenavista"],
            "Meta" => ["Villavicencio", "Acacías", "Granada", "Puerto López", "Cumaral", "San Martín", "Restrepo", "Guamal", "Castilla la Nueva", "Lejanías"],
            "Nariño" => ["Pasto", "Tumaco", "Ipiales", "Túquerres", "Samaniego", "La Unión", "El Charco", "Cumbal", "Francisco Pizarro", "Mallama"],
            "Norte de Santander" => ["Cúcuta", "Ocaña", "Pamplona", "Villa del Rosario", "Los Patios", "Ábrego", "Tibú", "Toledo", "El Tarra", "Chinácota"],
            "Putumayo" => ["Mocoa", "Puerto Asís", "Orito", "La Hormiga", "Sibundoy", "Villagarzón", "San Francisco", "Valle del Guamuez", "Puerto Guzmán"],
            "Quindío" => ["Armenia", "Calarcá", "Montenegro", "La Tebaida", "Circasia", "Quimbaya", "Salento", "Filandia", "Buenavista", "Génova"],
            "Risaralda" => ["Pereira", "Dosquebradas", "Santa Rosa de Cabal", "La Virginia", "Belén de Umbría", "Quinchía", "Marsella", "Mistrató", "Apía", "Santuario"],
            "San Andrés y Providencia" => ["San Andrés", "Providencia"],
            "Santander" => ["Bucaramanga", "Floridablanca", "Girón", "Piedecuesta", "Barrancabermeja", "Socorro", "San Gil", "Málaga", "Rionegro", "Sabana de Torres"],
            "Sucre" => ["Sincelejo", "Corozal", "San Marcos", "Sampués", "Tolú", "San Onofre", "Galeras", "Caimito", "Buenavista", "Chalán"],
            "Tolima" => ["Ibagué", "Espinal", "Melgar", "Honda", "Líbano", "Chaparral", "Mariquita", "Guamo", "Rovira", "Coyaima"],
            "Valle del Cauca" => ["Cali", "Palmira", "Buenaventura", "Tuluá", "Cartago", "Buga", "Yumbo", "Jamundí", "Candelaria", "Sevilla"],
            "Vaupés" => ["Mitú", "Carurú", "Taraira", "Papunahua"],
            "Vichada" => ["Puerto Carreño", "La Primavera", "Santa Rosalía", "Cumaribo"]
        ];
        foreach ($data as $departamento => $municipios) {
            $departamentoId = DB::table('departamentos')->insertGetId([
                'nombre' => $departamento
            ]);

            foreach ($municipios as $municipio) {
                DB::table('municipios')->insert([
                    'nombre' => $municipio,
                    'departamento_id' => $departamentoId
                ]);
            }
        }
    }
}
