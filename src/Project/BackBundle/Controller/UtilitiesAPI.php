<?php

namespace Project\BackBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;


class UtilitiesAPI extends Controller {
		
	public static function getFriendlyName($title,$class){
		$friendlyName = strtolower($title);
		$friendlyName =  str_replace("á", "a", $friendlyName);
		$friendlyName =  str_replace("é", "e", $friendlyName);
		$friendlyName =  str_replace("í", "i", $friendlyName);
		$friendlyName =  str_replace("ó", "o", $friendlyName);
		$friendlyName =  str_replace("ú", "u", $friendlyName);
		$friendlyName =  str_replace("'", "", $friendlyName);
		$friendlyName =  str_replace('"', "", $friendlyName);
		$friendlyName =  str_replace("ñ", "n", $friendlyName);
		$friendlyName =  str_replace("_", " ", $friendlyName);
		$friendlyName =  str_replace(".", " ", $friendlyName);
		$friendlyName =  str_replace(":", " ", $friendlyName);
		$friendlyName =  str_replace("-", " ", $friendlyName);
		$friendlyName =  str_replace("           ", " ", $friendlyName);
		$friendlyName =  str_replace("          ", " ", $friendlyName);
		$friendlyName =  str_replace("         ", " ", $friendlyName);
		$friendlyName =  str_replace("        ", " ", $friendlyName);
		$friendlyName =  str_replace("       ", " ", $friendlyName);
		$friendlyName =  str_replace("      ", " ", $friendlyName);
		$friendlyName =  str_replace("     ", " ", $friendlyName);
		$friendlyName =  str_replace("    ", " ", $friendlyName);
		$friendlyName =  str_replace("   ", " ", $friendlyName);
		$friendlyName =  str_replace("  ", " ", $friendlyName);
		$friendlyName =  str_replace(" ", "-", $friendlyName);
		$friendlyName =  str_replace("/", "", $friendlyName);
		
		return $friendlyName;
	}
	public static function getRank($locale, $class){

        $em = $class->getDoctrine()->getManager();
       
        $qbCount = $em
			->createQueryBuilder()
			->select('count(g)')
			->from('ProjectUserBundle:Page','g')
        ;
        
        $recordCount = $qbCount
			->getQuery()
			->getSingleScalarResult()
        ;
		
		return $recordCount + 1;
	}
	public static function getRankItem($menu, $class){

        $em = $class->getDoctrine()->getManager();
       
        $qbCount = $em
			->createQueryBuilder()
			->select('count(g)')
			->from('ProjectUserBundle:MenuItem','g')
			->where('ProjectUserBundle:MenuItem','g')
            ->where('g.menu = :menu')
            ->setParameter('menu', $menu);
        ;
        
        $recordCount = $qbCount
			->getQuery()
			->getSingleScalarResult()
        ;
		
		return $recordCount + 1;
	}
	public static function getLocale($class){
		
		$request = $class->getRequest();
		$locale = $request->getLocale();
		if($locale=='es')return 0;
		else return 1;
		
	}
	public static function generaTrans($class){
		echo"<div>\n";
		for ($i=43; $i < 300; $i++) { 
			echo "            <trans-unit id=".$i.">\n                <source></source>\n                <target></target>\n            </trans-unit>\n";
		}
		echo"\n</div>";
		exit;
	}
	public static function getFilter($clase,$class) {
		$data = $class -> getDoctrine() -> getRepository('ProjectUserBundle:'.$clase) -> findAll();

		$array = array();
		for ($i = 0; $i < count($data); $i++) {
			$array[$data[$i] -> getId()] = $data[$i] -> getName();
		}
		return $array;
	}
	public static function getFilterData($data,$class) {
		$array = array();
		for ($i = 0; $i < count($data); $i++) {
			$array[$data[$i] -> getId()] = $data[$i] -> getName();
		}
		return $array;
	}

	public static function getActiveUser($class) {

		$user = $class -> getUser();

		if ($user != NULL && false === $class -> get('security.context') -> isGranted('ROLE_USER')) {
			$user = null;
		}

		return $user;
	}

	public static function getNotifications($user) {

		$notifications = null;

		if ($user != NULL) {
			$notifications = array();
			$notifications[0]['texto'] = 'Espacio reducido';
			$notifications[0]['numero'] = '40%';
		}

		return $notifications;
	}

	public static function convertirFechaNormal($fechaOriginal, $class) {
		
		$fechaOriginal = trim($fechaOriginal);
		$arreglo1 = explode(" ", $fechaOriginal);
		$arreglo = explode("-", $arreglo1[0]);
		$fecha = new \DateTime();
		$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
		$arreglo = explode(":", $arreglo1[1]);
		$fecha -> setTime ( $arreglo[0], $arreglo[1], $arreglo[2] );
		
		return $fecha;
	}

	 public static function convertirAFechaNormal($fechaOriginal, $class) {

	 $fechaOriginal = new \DateTime($fechaOriginal);
	 return date_format($fechaOriginal, 'd/m/Y'); ;
	 }
	 public static function fechaHoy($class) {
	 	$hoy = getdate();
		$fecha = $hoy['year'] . '-' . $hoy['mon'] . '-'.$hoy['mday'];
		
	 	return $fecha;
	 }
	/*

	 public static function obtenerFechaSistema($class) {
	 $hoy = getdate();
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $anio = $hoy['year'];
	 $mes = intval($hoy['mon']) - 1;
	 $dia = $hoy['mday'];
	 $hora = $hoy['hours'];
	 $minuto = $hoy['minutes'];

	 $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
	 $dsemana = $hoy['wday'];

	 $fecha = $dias[$dsemana] . ", " . $dia . " de " . $meses[$mes] . ' de ' . $anio;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada($class) {
	 $hoy = getdate();
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $anio = $hoy['year'];
	 $mes = intval($hoy['mon']) - 1;
	 $dia = $hoy['mday'];
	 $hora = $hoy['hours'];
	 $minuto = $hoy['minutes'];
	 $fecha = $dia . " de " . $meses[$mes] . ' del ' . $anio;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada2($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $mes = intval($arreglo[1]) - 1;
	 $fecha = $arreglo[0] . " de " . $meses[$mes] . ' del ' . $arreglo[2];

	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada3($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $mes = intval($arreglo[1]) - 1;
	 $fecha = $meses[$mes] . ' del ' . $arreglo[2];

	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada4($fechaOriginal, $class) {

	 $arreglo = explode("/", $fechaOriginal);
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $mes = intval($arreglo[1]) - 1;
	 $fecha = $arreglo[0] . " de " . $meses[$mes] . ' del ' . $arreglo[2];

	 return $fecha;
	 }

	 public static function obtenerNombreMes($fecha, $class) {
	 $hoy = getdate();
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

	 $mes = intval($fecha['mon']) - 1;
	 return $mes;
	 }

	 public static function obtenerFechaNormal($class) {
	 $hoy = getdate();
	 $anio = $hoy['year'];
	 $mes = $hoy['mon'];
	 $dia = $hoy['mday'];
	 $fecha = $dia . "/" . $mes . '/' . $anio;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerFechaNormal2($class) {
	 $hoy = getdate();
	 $anio = $hoy['year'];
	 $mes = $hoy['mon'];
	 $dia = $hoy['mday'];
	 $fecha = $dia . "-" . $mes . '-' . $anio;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerFechaNormal3($class) {
	 $hoy = getdate();
	 $anio = $hoy['year'];
	 $mes = $hoy['mon'];
	 $dia = $hoy['mday'];
	 $fecha = $anio . "-" . $mes . '-' . $dia;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerMesYAnio($class) {
	 $hoy = getdate();
	 return array($hoy['year'], $hoy['mon']);
	 }

	 public static function convertirFechaNormal($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $fecha = new \DateTime();
	 $fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
	 return $fecha;
	 }

	 public static function convertirFechaNormal3($fechaOriginal, $class) {
	 $arreglo = explode("/", $fechaOriginal);
	 $fecha = new \DateTime();
	 $fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
	 return $fecha;
	 }

	 public static function convertirFechaNormal2($fechaOriginal, $class) {
	 $fechaOriginal = trim($fechaOriginal);
	 $arreglo1 = explode(" ", $fechaOriginal);
	 $arreglo = explode("-", $arreglo1[0]);
	 $fecha = new \DateTime();
	 $fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
	 return $fecha;
	 }

	 public static function convertirAFechaNormal($fechaOriginal, $class) {

	 $fechaOriginal = new \DateTime($fechaOriginal);
	 return date_format($fechaOriginal, 'd/m/Y'); ;
	 }

	 public static function convertirAFormatoSQL($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 if ($arreglo[1] < 10)
	 $arreglo[1] = '0' . $arreglo[1];
	 if ($arreglo[0] < 10)
	 $arreglo[0] = '0' . $arreglo[0];
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0] . ' 00:00:00';

	 return $fecha;

	 }

	 public static function obtenerFechasFormatoSQL($anio, $mes, $class) {

	 if ($mes < 10)
	 $mes = '0' . $mes;
	 $dia = '01';

	 $fechaInicial = $anio . '-' . $mes . '-' . $dia . ' 00:00:00';
	 $dia = '31';
	 $fechaFinal = $anio . '-' . $mes . '-' . $dia . ' 00:00:00';

	 $arreglo = array($fechaInicial, $fechaFinal);

	 return $arreglo;

	 }

	 public static function convertirAFormatoSQL2($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 if ($arreglo[1] < 10)
	 $arreglo[1] = '0' . $arreglo[1];
	 if ($arreglo[0] < 10)
	 $arreglo[0] = '0' . $arreglo[0];
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0];

	 return $fecha;

	 }

	 public static function convertirAFormatoSQL3($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);

	 $fecha = $arreglo[2] . '/' . $arreglo[1] . '/' . $arreglo[0];

	 return $fecha;

	 }

	 public static function convertirAFormatoSQL4($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0] . ' 00:00:00';

	 return $fecha;

	 }

	 public static function primerDiaMes($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-01 00:00:00';

	 return $fecha;

	 }

	 public static function primerDiaMesSiguiente($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $mes = intval($arreglo[1]);
	 $anio = intval($arreglo[2]);

	 if ($mes == 12) {
	 $mes = "01";
	 $anio++;
	 } else {
	 $mes++;
	 if ($mes < 9)
	 $mes = "0" . $mes;
	 }

	 $fecha = $anio . '-' . $mes . '-01 00:00:00';

	 return $fecha;

	 }

	 public static function sumarTiempo($fechaOriginal, $dia, $mes, $anio, $class) {

	 $arreglo = explode("-", $fechaOriginal);

	 $fecha = new \DateTime();
	 $fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
	 $fecha -> setTime(0, 0, 0);
	 $periodo = 'P' . $anio . 'Y' . $mes . 'M' . $dia . 'D';
	 $fecha -> add(new \DateInterval($periodo));

	 $fecha = date_format($fecha, 'Y-m-d H:i:s'); ;
	 return $fecha;

	 }
	 */
}
