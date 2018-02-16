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
 * Modelo Inscripciones
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Inscripciones extends Models implements IModels {
    
    use DBModel;


    private $anio_ini_inscripcion;
    private $anio_fin_inscripcion;
    private $descuento;
    private $id_jugador;
    private $dias_inscripcion;
    private $costo_5dias;
    private $costo_3dias;
    private $codigo_sede;

    /*Lleva la cantidad de dias inscritos*/
    private $count;

    /*Revisa los errores al momento de editar y crear*/
    final private function errors(bool $edit = false) {
        global $http;
       
        $this->anio_ini_inscripcion = $http->request->get('anio_ini_inscripcion');
        $this->anio_fin_inscripcion = $http->request->get('anio_fin_inscripcion');
        $this->descuento = $http->request->get('descuento');
        $this->precio = $http->request->get('precio');
        $this->id_jugador = $http->request->get('id_jugador');
        $this->dias_inscripcion = $http->request->get('dias_inscripcion');
        $this->costo_3dias = $http->request->get('costo_3dias');
        $this->costo_5dias = $http->request->get('costo_5dias');
        $this->codigo_sede = $http->request->get('codigo_sede');

        if($this->functions->e($this->anio_ini_inscripcion)){
          throw new ModelsException('El inicio de temporada es obligatorio');
        }
        if($this->functions->e($this->anio_fin_inscripcion)){
          throw new ModelsException('El fin de temporada es obligatorio');
        }

        if($this->functions->e($this->descuento)){
            throw new ModelsException('El descuento es obligatorio');
        }
        if($this->functions->e($this->id_jugador)){
        throw new ModelsException('El id del jugador es obligatorio');
        }
        if($this->functions->e($this->codigo_sede)){
          throw new ModelsException('La sede es obligatoria');
          }
        $e = $this->db->query_select("SELECT * FROM inscripciones_4 WHERE id_jugador = '$this->id_jugador' AND anio_ini_inscripcion=$this->anio_ini_inscripcion ");
          if(false!==$e){
            throw new ModelsException('El jugador ya esta inscrito en esta temporada');
          }
        $this->count = count($this->dias_inscripcion);
        if( $this->count==1 or $this->count==2 or $this->count==4 ){
          throw new ModelsException('El jugador debe estar inscrito en tres o en 5 dias');
          }


      }
  
      /** 
        * Crea un elemento de la tabla "inscripciones_4"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function add() {
        try {
          global $http;
                    
          # Controlar errores de entrada en el formulario
          $this->errors();


          /*Trae la morosidad del jugador*/
          $morosidad =  $this->db->query_select(
            "SELECT morosidad
            FROM jugadores_4 
            WHERE id_jugador='$this->id_jugador'
            ;"
          );

          
          /*Si la morosidad es de 30(mas de dos meses sin pagor) esta expulsado(no se puede inscribir)*/
          if($morosidad[0]["morosidad"]==30){
            throw new ModelsException('El jugador no se puede inscribir por un año');
          }

          $time = time();

          /*Asigna precios dependiendo de la modalidad inscrita*/
          if($this->count==3){
            $precio=$this->costo_3dias;
          }else{
            $precio=$this->costo_5dias;
          }
          
          /*Descuenta el % de hermanos*/
          $this->descuento=($this->descuento*$precio)/100;
          $precio-=$this->descuento;

          # Insertar elementos
          $this->db->query("INSERT INTO inscripciones_4
          (anio_ini_inscripcion,anio_fin_inscripcion,precio,descuento,id_jugador,fecha_inscripcion,codigo_sede)
          VALUES ($this->anio_ini_inscripcion,$this->anio_fin_inscripcion,$precio,$this->descuento,'$this->id_jugador',$time,$this->codigo_sede);");
  
          foreach($this->dias_inscripcion as &$dia){

            $this->db->query("INSERT INTO dias_inscritos_4
            (anio_ini,anio_fin,dia,id_jugador)
            VALUES ($this->anio_ini_inscripcion,$this->anio_fin_inscripcion,$dia,'$this->id_jugador');");

          }

          



          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            

  


    /**
        * Obtiene elementos de la tabla "inscripciones_4"
        *
        *
        * @return false|array: false si no hay datos.
        *                      array con los datos.
        */
    final public function get(string $select = '*') {


    return $this->db->query_select(
      "SELECT i4.anio_ini_inscripcion AS ini , i4.anio_fin_inscripcion AS fin , i4.fecha_inscripcion AS fecha , i4.descuento AS descuento , i4.precio AS precio,s4.nombre AS nombre_sede,
       j4.nombre AS nombre,j4.apellido AS apellido ,j4.id_jugador AS id_jugador,
       r4.nombre AS nombrer,r4.apellido AS apellidor ,r4.cedula_representante AS cedula_representante
       FROM inscripciones_4 i4
       INNER JOIN jugadores_4 j4 ON i4.id_jugador=j4.id_jugador
       INNER JOIN representantes_4 r4 ON r4.cedula_representante=j4.cedula_representante
       INNER JOIN sedes_4 s4 ON s4.codigo_sede=i4.codigo_sede 
      ;");

    }

    final public function getByJugador(string $id) {


      return $this->db->query_select(
        "SELECT i4.codigo_sede AS codigo_sede, s4.nombre AS nombre_sede
        FROM inscripciones_4 i4       
        INNER JOIN sedes_4 s4 ON s4.codigo_sede=i4.codigo_sede
        INNER JOIN (SELECT MAX(anio_ini_inscripcion) AS maximo FROM inscripciones_4 WHERE id_jugador='$id' GROUP BY id_jugador) ii4
         ON ii4.maximo=i4.anio_ini_inscripcion
         WHERE i4.id_jugador='$id'
        ;");


      }



    final public function getDiasInscritos(){

      return $this->db->query_select(
        "SELECT dia ,id_jugador ,anio_ini
        FROM dias_inscritos_4 
        ;"
    
      );

    }



    final public function getByCriterios() {
      global $http;
      
      $a = $http->query->get('criterio_inscripciones_1');
      $b = $http->query->get('criterio_inscripciones_2');
      $c = $http->query->get('criterio_inscripciones_3');
      $cri1="s4.nombre IS NOT NULL";
      $cri2="r4.nombre IS NOT NULL";
      $cri3="j4.nombre IS NOT NULL";

      if (!$this->functions->e($a)){
        $cri1="s4.nombre = '$a'";
      }
      if (!$this->functions->e($b)){
        $cri2 = "p4.metodo_pago = '$b'";
      }
      if (!$this->functions->e($c)){
        $cri3 = "j4.nombre_categoria = '$c'";
      }


      return $this->db->query_select(
      "SELECT i4.anio_ini_inscripcion AS ini , i4.anio_fin_inscripcion AS fin , FROM_UNIXTIME(i4.fecha_inscripcion,'%d %m %Y') AS fecha , i4.descuento AS descuento , i4.precio AS precio,s4.nombre AS nombre_sede,
       j4.nombre AS nombre,j4.apellido AS apellido ,j4.id_jugador AS id_jugador,p4.anio_ini AS ljoin,
       r4.nombre AS nombrer,r4.apellido AS apellidor ,r4.cedula_representante AS cedula_representante
       FROM inscripciones_4 i4
       INNER JOIN jugadores_4 j4 ON i4.id_jugador=j4.id_jugador
       INNER JOIN representantes_4 r4 ON r4.cedula_representante=j4.cedula_representante
       INNER JOIN sedes_4 s4 ON s4.codigo_sede=i4.codigo_sede 
       LEFT JOIN pagos_4 p4 ON p4.anio_ini=i4.anio_ini_inscripcion AND p4.id_jugador=i4.id_jugador
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