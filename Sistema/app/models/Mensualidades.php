<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;

/**
 * Modelo Mensualidades
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Mensualidades extends Models implements IModels {
    
    use DBModel;


    private $codigo_consecutivo;
    private $precio_mensualidad;
    private $ci_representante;
    private $id_jugador;


    /*Revisa los errores al momento de editar y crear*/
    final private function errors(bool $edit = false) {
        global $http;
       
        $this->codigo_consecutivo = $http->request->get('codigo_consecutivo');
        $this->precio_mensualidad = $http->request->get('precio_mensualidad');
        $this->ci_representante = $http->request->get('ci_representante');
        $this->id_jugador = $http->request->get('id_jugador');

        if($this->functions->e($this->codigo_consecutivo)){
          throw new ModelsException('El codigo es obligatorio');
        }
        if($this->functions->e($this->precio_mensualidad)){
          throw new ModelsException('El precio es obligatorio');
        }
        if($this->functions->e($this->ci_representante)){
          throw new ModelsException('El campo representante es obligatorio');
        }
        if($this->functions->e($this->id_jugador)){
          throw new ModelsException('El campo id del jugador es obligatorio');
        }

        $e = $this->db->query_select("SELECT * FROM mensualidades_4 WHERE id_jugador = '$this->id_jugador' AND codigo_consecutivo='$this->codigo_consecutivo'  ");
          if(false!==$e){
            throw new ModelsException('El jugador ya creo esta mensualidad');
          }

      }
  
      /** 
        * Crea un elemento de la tabla "facturas_4"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function add() {
 
        try {
          global $http;

          # Controlar errores de entrada en el formulario
          $this->errors();

          /*Verifica si el jugador esta inscrito para poder pagar mensualidad*/
          $inscripcion =  $this->db->query_select(
            "SELECT *
            FROM inscripciones_4 i4
            INNER JOIN  pagos_4 p4 ON p4.id_jugador=i4.id_jugador AND p4.anio_ini=i4.anio_ini_inscripcion
            WHERE i4.id_jugador='$this->id_jugador' AND p4.anio_ini IS NOT NULL
            ;"
          );

          /*Valido si la query trajo algo*/
          if(empty($inscripcion[0])){
            throw new ModelsException('El jugador no ha pagado la inscripcion');
          }

          /*Esto elimina los dos ultimos caracteres de codig_consecutivo y los mete en $c*/
          $c=substr($this->codigo_consecutivo,0,-2);
          
          /*Traigo la suma de los pagos del mes actual de el jugador*/
          $monto_mensualidades = $this->db->query_select(
            "SELECT SUM(monto_pago) AS monto
            FROM pagos_4            
            WHERE codigo_mensualidad LIKE '$c%' AND id_jugador='$this->id_jugador'
            ;");

          /*Traigo el precio de la mensualidad*/
          $mensualidad =  $this->db->query_select(
            "SELECT mensualidad
            FROM costos_4
            WHERE clave=1
            ;"); 
           $deuda = $mensualidad[0]["mensualidad"];


          /*Trae la morosidad del jugador*/
          $morosidad =  $this->db->query_select(
            "SELECT morosidad
            FROM jugadores_4 
            WHERE id_jugador='$this->id_jugador'
            ;");

              /*Si la morosidad es 20 entonces debe dos meses los cuales debe pagar a la vez antes de los primeros 5 dias de ese tercer mes*/
              if($morosidad[0]["morosidad"]==20){
                $deuda=$deuda*2;
              }


          /*Valida los pagos de dicha mensualidad para saber si ya la cancelo completa*/
          /*Uso mayor o igual porque despues del ultimo pago se agrega la morosidad*/
          if( ($monto_mensualidades[0]["monto"]) >= ( $deuda )   ){
            throw new ModelsException('No puede crear esta mensualidad porque ya ha pagado la mensualidad completa');
          }

          if( ($monto_mensualidades[0]["monto"]+$this->precio_mensualidad) >  ( $deuda )   ){
            throw new ModelsException('No puede crear esta mensualidad porque excede el precio ');
          }

          /*En el caso de que se este completando la totalidad del pago se le agrega la morosidad a este ultimo pago*/
          if( ($monto_mensualidades[0]["monto"]+$this->precio_mensualidad) ==  ( $deuda )){

            /*Le suma el porcentaje de morosidad al precio de la mensualidad*/
            $this->precio_mensualidad+=($morosidad[0]["morosidad"]*$deuda)/100;
          
             /*Elimina la morosidad ya que se completo el pago*/
             $this->db->query(
              "UPDATE jugadores_4
              SET morosidad=0
              WHERE id_jugador='$this->id_jugador'
              ;"
            );

           }
          

          $this->db->query("INSERT INTO mensualidades_4
          (codigo_consecutivo,precio_mensualidad,ci_representante,id_jugador)
          VALUES ('$this->codigo_consecutivo',$this->precio_mensualidad,'$this->ci_representante','$this->id_jugador');");
  
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            

  


    /**
        * Obtiene elementos de la tabla "mensualidades_4"
        *
        *
        * @return false|array: false si no hay datos.
        *                      array con los datos.
        */
    final public function get(string $select = '*') {


    return $this->db->query_select(
      "SELECT m4.codigo_consecutivo AS codigo_consecutivo , m4.precio_mensualidad AS precio_mensualidad,
       r4.nombre AS nombre,r4.apellido AS apellido ,r4.cedula_representante AS cedula_representante,
       j4.id_jugador AS id_jugador , j4.nombre AS nombrej , j4.apellido AS apellidoj 
       FROM mensualidades_4 m4
       INNER JOIN representantes_4 r4 ON r4.cedula_representante=m4.ci_representante
       INNER JOIN jugadores_4 j4 ON j4.id_jugador=m4.id_jugador
      ;");


    }


    final public function getByCriterios() {
      global $http;
      
      $a = $http->query->get('criterio_mensualidades_1');
      $b = $http->query->get('criterio_mensualidades_2');
      $c = $http->query->get('criterio_mensualidades_3');
      $cri1="1=1";
      $cri2="1=1";
      $cri3="1=1";

      if (!$this->functions->e($a)){
        $cri1="r4.cedula_representante = '$a'";
      }
      if (!$this->functions->e($b)){
        $cri2 = "j4.id_jugador = '$b'";
      }
      if (!$this->functions->e($c)){
        $cri3 = "m4.codigo_consecutivo LIKE  '$c%'";
      }

      $inner_select="";

      return $this->db->query_select(
      "SELECT m4.codigo_consecutivo AS codigo_consecutivo , m4.precio_mensualidad AS precio_mensualidad,
       r4.nombre AS nombre,r4.apellido AS apellido ,r4.cedula_representante AS cedula_representante,
       j4.id_jugador AS id_jugador , j4.nombre AS nombrej , j4.apellido AS apellidoj , pp.m AS pagado
       FROM mensualidades_4 m4
       INNER JOIN representantes_4 r4 ON r4.cedula_representante=m4.ci_representante
       INNER JOIN jugadores_4 j4 ON j4.id_jugador=m4.id_jugador 
       LEFT JOIN (SELECT p4.monto_pago AS m , p4.codigo_mensualidad AS c , p4.id_jugador AS j FROM pagos_4 p4 ) pp ON pp.c=m4.codigo_consecutivo AND pp.j=m4.id_jugador
       WHERE $cri1 AND $cri2 AND $cri3
      ;");

      }
    
    /**
      * __construct()
    */
    public function __construct(IRouter $router = null) {
        parent::__construct($router);
        $this->startDBConexion();
    }

    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
        $this->endDBConexion();
    }
}