<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Canton extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('canton', function (Blueprint $table) {
            $table->integer('id');
            $table->primary('id');
            $table->integer('provincia_id')->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincia')->onDelete('SET NULL');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('canton');
    }
}

// INSERT INTO `canton` (`provincia_id`, `id`, `nombre`) VALUES
// (01,0101,'Cuenca'),
// (01,0102,'Giron'),
// (01,0103,'Gualaceo'),
// (01,0104,'Nabon'),
// (01,0105,'Paute'),
// (01,0106,'Pucara'),
// (01,0107,'San Fernando'),
// (01,0108,'Santa Isabel'),
// (01,0109,'Sigsig'),
// (01,0110,'Oña'),
// (01,0111,'Chordeleg'),
// (01,0112,'El Pan'),
// (01,0113,'Sevilla De Oro'),
// (01,0114,'Guachapala'),
// (01,0115,'Camilo Ponce Enriquez'),
// (02,0201,'Guaranda'),
// (02,0202,'Chillanes'),
// (02,0203,'Chimbo'),
// (02,0204,'Echeandia'),
// (02,0205,'San Miguel'),
// (02,0206,'Caluma'),
// (02,0207,'Las Naves'),
// (03,0301,'Azogues'),
// (03,0302,'Biblian'),
// (03,0303,'Cañar'),
// (03,0304,'La Troncal'),
// (03,0305,'El Tambo'),
// (03,0306,'Deleg'),
// (03,0307,'Suscal'),
// (04,0401,'Tulcan'),
// (04,0402,'Bolivar'),
// (04,0403,'Espejo'),
// (04,0404,'Mira'),
// (04,0405,'Montufar'),
// (04,0406,'San Pedro De Huaca'),
// (05,0501,'Latacunga'),
// (05,0502,'La Mana'),
// (05,0503,'Pangua'),
// (05,0504,'Pujili'),
// (05,0505,'Salcedo'),
// (05,0506,'Saquisili'),
// (05,0507,'Sigchos'),
// (06,0601,'Riobamba'),
// (06,0602,'Alausi'),
// (06,0603,'Colta'),
// (06,0604,'Chambo'),
// (06,0605,'Chunchi'),
// (06,0606,'Guamote'),
// (06,0607,'Guano'),
// (06,0608,'Pallatanga'),
// (06,0609,'Penipe'),
// (06,0610,'Cumanda'),
// (07,0701,'Machala'),
// (07,0702,'Arenillas'),
// (07,0703,'Atahualpa'),
// (07,0704,'Balsas'),
// (07,0705,'Chilla'),
// (07,0706,'El Guabo'),
// (07,0707,'Huaquillas'),
// (07,0708,'Marcabeli'),
// (07,0709,'Pasaje'),
// (07,0710,'Piñas'),
// (07,0711,'Portovelo'),
// (07,0712,'Santa Rosa'),
// (07,0713,'Zaruma'),
// (07,0714,'Las Lajas'),
// (08,0801,'Esmeraldas'),
// (08,0802,'Eloy Alfaro'),
// (08,0803,'Muisne'),
// (08,0804,'Quininde'),
// (08,0805,'San Lorenzo'),
// (08,0806,'Atacames'),
// (08,0807,'Rio Verde'),
// (09,0901,'Guayaquil'),
// (09,0902,'Alfredo Baquerizo Moreno'),
// (09,0903,'Balao'),
// (09,0904,'Balzar'),
// (09,0905,'Colimes'),
// (09,0906,'Daule'),
// (09,0907,'Duran'),
// (09,0908,'El Empalme'),
// (09,0909,'El Triunfo'),
// (09,0910,'Milagro'),
// (09,0911,'Naranjal'),
// (09,0912,'Naranjito'),
// (09,0913,'Palestina'),
// (09,0914,'Pedro Carbo'),
// (09,0916,'Samborondon'),
// (09,0918,'Santa Lucia'),
// (09,0919,'Salitre'),
// (09,0920,'San Jacinto De Yaguachi'),
// (09,0921,'Playas (General Villamil)'),
// (09,0922,'Simon Bolivar'),
// (09,0923,'Coronel Marcelino Maridueña'),
// (09,0924,'Lomas De Sargentillo'),
// (09,0925,'Nobol (Vicente Piedrahita)'),
// (09,0927,'General Antonio Elizalde'),
// (09,0928,'Isidro Ayora'),
// (10,1001,'Ibarra'),
// (10,1002,'Antonio Ante'),
// (10,1003,'Cotacachi'),
// (10,1004,'Otavalo'),
// (10,1005,'Pimampiro'),
// (10,1006,'San Miguel De Urcuqui'),
// (11,1101,'Loja'),
// (11,1102,'Calvas'),
// (11,1103,'Catamayo'),
// (11,1104,'Celica'),
// (11,1105,'Chahuarpamba'),
// (11,1106,'Espindola'),
// (11,1107,'Gonzanama'),
// (11,1108,'Macara'),
// (11,1109,'Paltas'),
// (11,1110,'Puyango'),
// (11,1111,'Saraguro'),
// (11,1112,'Sozoranga'),
// (11,1113,'Zapotillo'),
// (11,1114,'Pindal'),
// (11,1115,'Quilanga'),
// (11,1116,'Olmedo'),
// (12,1201,'Babahoyo'),
// (12,1202,'Baba'),
// (12,1203,'Montalvo'),
// (12,1204,'Pueblo Viejo'),
// (12,1205,'Quevedo'),
// (12,1206,'Urdaneta'),
// (12,1207,'Ventanas'),
// (12,1208,'Vinces'),
// (12,1209,'Palenque'),
// (12,1210,'Buena Fe'),
// (12,1211,'Valencia'),
// (12,1212,'Mocache'),
// (12,1213,'Quinsaloma'),
// (13,1301,'Portoviejo'),
// (13,1302,'Bolivar'),
// (13,1303,'Chone'),
// (13,1304,'El Carmen'),
// (13,1305,'Flavio Alfaro'),
// (13,1306,'Jipijapa'),
// (13,1307,'Junin'),
// (13,1308,'Manta'),
// (13,1309,'Montecristi'),
// (13,1310,'Pajan'),
// (13,1311,'Pichincha'),
// (13,1312,'Rocafuerte'),
// (13,1313,'Santa Ana'),
// (13,1314,'Sucre'),
// (13,1315,'Tosagua'),
// (13,1316,'24 De Mayo'),
// (13,1317,'Pedernales'),
// (13,1318,'Olmedo'),
// (13,1319,'Puerto Lopez'),
// (13,1320,'Jama'),
// (13,1321,'Jaramijo'),
// (13,1322,'San Vicente'),
// (14,1401,'Morona'),
// (14,1402,'Gualaquiza'),
// (14,1403,'Limon - Indanza'),
// (14,1404,'Palora'),
// (14,1405,'Santiago'),
// (14,1406,'Sucua'),
// (14,1407,'Huamboya'),
// (14,1408,'San Juan Bosco'),
// (14,1409,'Taisha'),
// (14,1410,'Logroño'),
// (14,1411,'Pablo Sexto'),
// (14,1412,'Tiwintza'),
// (15,1501,'Tena'),
// (15,1503,'Archidona'),
// (15,1504,'El Chaco'),
// (15,1507,'Quijos'),
// (15,1509,'Carlos Julio Arosemena T.'),
// (16,1601,'Pastaza'),
// (16,1602,'Mera'),
// (16,1603,'Santa Clara'),
// (16,1604,'Arajuno'),
// (17,1701,'Quito'),
// (17,1702,'Cayambe'),
// (17,1703,'Mejia'),
// (17,1704,'Pedro Moncayo'),
// (17,1705,'Rumiñahui'),
// (17,1707,'San Miguel De Los Bancos'),
// (17,1708,'Pedro Vicente Maldonado'),
// (17,1709,'Puerto Quito'),
// (18,1801,'Ambato'),
// (18,1802,'Baños De Agua Santa'),
// (18,1803,'Cevallos'),
// (18,1804,'Mocha'),
// (18,1805,'Patate'),
// (18,1806,'Quero'),
// (18,1807,'San Pedro De Pelileo'),
// (18,1808,'Santiago De Pillaro'),
// (18,1809,'Tisaleo'),
// (19,1901,'Zamora'),
// (19,1902,'Chinchipe'),
// (19,1903,'Nangaritza'),
// (19,1904,'Yacuambi'),
// (19,1905,'Yantzaza'),
// (19,1906,'El Pangui'),
// (19,1907,'Centinela Del Condor'),
// (19,1908,'Palanda'),
// (19,1909,'Paquisha'),
// (20,2001,'San Cristobal'),
// (20,2002,'Isabela'),
// (20,2003,'Santa Cruz'),
// (21,2101,'Lago Agrio'),
// (21,2102,'Gonzalo Pizarro'),
// (21,2103,'Putumayo'),
// (21,2104,'Shushufindi'),
// (21,2105,'Sucumbios'),
// (21,2106,'Cascales'),
// (21,2107,'Cuyabeno'),
// (22,2201,'Francisco De Orellana'),
// (22,2202,'Aguarico'),
// (22,2203,'La Joya De Los Sachas'),
// (22,2204,'Loreto'),
// (23,2301,'Santo Domingo'),
// (23,2302,'La Concordia'),
// (24,2401,'Santa Elena'),
// (24,2402,'La Libertad'),
// (24,2403,'Salinas');
