<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Institucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('institucion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('siglas')->nullable();
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
        Schema::dropIfExists('institucion');
    }
}

// INSERT INTO `institucion` (`created_at`, `updated_at`, `deleted_at`, `nombre`) VALUES
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Aseguramiento de la Calidad de los Servicios de Salud y Medicina Prepagada'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control de Electricidad'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control de la Bioseguridad y Cuarentena para Galápagos'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control de las Telecomunicaciones'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control del Agua'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control Fito y Zoosanitario'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control Hidrocarburífero'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control Minero'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia de Regulación y Control Postal'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia Nacional de Regulación y Control de Transporte Terrestre, Tránsito y Seguridad Vial'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Agencia Nacional de Regulación, Control y Vigilancia Sanitaria'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Autoridad Portuaria de Esmeraldas'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Autoridad Portuaria de Manta'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Autoridad Portuaria de Puerto Bolívar'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Banco Central del Ecuador'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Banco del Instituto Ecuatoriano de Seguridad Social'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Banco Público BANECUADOR BP'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Centro Interamericano de Artesanías y Artes Populares'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Centros de Entrenamiento para el Alto Rendimiento'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Comando Conjunto de las Fuerzas Armadas'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Comisión de Tránsito del Ecuador'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Consejo Nacional para la Igualdad de Género'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Corporación de Seguro de Depósitos, Fondo de Liquidez y Seguros Privados'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Corporación Financiera Nacional BP'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Corporación Nacional de Electricidad Empresa Eléctrica Pública Estratégica'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Corporación Nacional de Finanzas Populares y Solidarias'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Dirección General de Aviación Civil'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Dirección General de Registro Civil, Identificación y Cedulación'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Dirección Nacional de Registro de Datos Públicos'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública Corporación Nacional de Telecomunicaciones'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública Correos del Ecuador'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública de Desarrollo Estratégico Ecuador Estratégico EP'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública de Exploración y Explotación de Hidrocarburos (Petroamazonas EP)'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública del Agua'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública Estratégica Corporación Eléctrica del Ecuador'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública TAME Línea Aérea del Ecuador'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Empresa Pública YACHAY (Yachay EP)'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Antártico Ecuatoriano'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto de Cine y Creación Audiovisual'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto de Economía Popular y Solidaria'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto de Fomento al Talento Humano'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto de Promoción de Exportaciones e Inversiones'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto de Seguridad Social de las Fuerzas Armadas'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Ecuatoriano de Seguridad Social'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Espacial Ecuatoriano'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Geográfico Militar'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Biodiversidad'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Donación y Trasplante de Órganos, Tejidos y Células'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Estadísticas y Censos'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Evaluación Educativa'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Investigación en Salud Pública Doctor Leopoldo Izquieta Pérez'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Investigación Geológico y Energético'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Investigaciones Agropecuarias'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Meteorología e Hidrología'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Patrimonio Cultural'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Nacional de Pesca'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Instituto Oceanográfico de la Armada'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Acuacultura y Pesca'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Agricultura y Ganadería'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Ambiente'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Cultura y Patrimonio'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Defensa'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Desarrollo Urbano y Vivienda'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Educación'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Energía y Recursos Naturales No Renovables'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Inclusión Económica y Social'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Industrias y Productividad'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Justicia, Derechos Humanos y Cultos'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Producción, Comercio Exterior e Inversiones'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Relaciones Exteriores y Movilidad Humana'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Salud Pública'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Transportes y Obras Públicas'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio de Turismo'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio del Interior'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Ministerio del Trabajo'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Operador Nacional de Electricidad'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Policía Nacional'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría de Educación Superior, Ciencia, Tecnología e Innovación'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría de Gestión de Riesgos'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría del Agua'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría del Deporte'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría Nacional de Gestión Política'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría Técnica de la Circunscripción Territorial Especial Amazónica'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría Técnica de Prevención de Asentamientos Humanos Irregulares'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Secretaría Técnica Plan para toda una Vida'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio de Acreditación Ecuatoriano'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio de Gestión Inmobiliaria del Sector Público'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio de Rentas Internas'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Ecuatoriano de Capacitación Profesional'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Ecuatoriano de Normalización'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Integrado de Seguridad ECU-911'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Nacional de Aduana del Ecuador'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Nacional de Contratación Pública'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Nacional de Derechos Intelectuales'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Nacional de Medicina Legal y Ciencias Forenses'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Servicio Público para Pago de Accidentes de Tránsito'),
// ('2019-02-19 19:50:00', NULL, NULL, 'Unidad de Análisis Financiero y Económico');
