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
 * Modelo Ventas
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Ventas extends Models implements IModels {
    

    use DBModel;
  
    private $fecha;
  
    private $cantidad;
    private $tipo_uniforme;
    private $id_representante;
    private $id_jugador;
    private $sede;
    private $stock;
    private $stock_minimo;

    /*Revisa los errores al momento de editar y crear*/
    final private function errors(bool $edit = false) {
        global $http;
       
        
        $this->cantidad = $http->request->get('cantidad');
        $this->tipo_uniforme = $http->request->get('tipo_uniforme');
        $this->id_representante = $http->request->get('id_representante');
        $this->id_jugador = $http->request->get('id_jugador');
        $this->sede = $http->request->get('sede');
        $this->stock = $http->request->get('stock');
        $this->stock_minimo = $http->request->get('stock_minimo');

        if($this->functions->e($this->tipo_uniforme)){
          throw new ModelsException('El campo tipo de uniforme es obligatorio');
        }
        if( ($this->functions->e($this->cantidad)) or ($this->cantidad<1) ){
          throw new ModelsException('El campo cantidad es obligatorio');
        }
        if($this->functions->e($this->id_representante)){
          throw new ModelsException('El campo id del representante es obligatorio');
        }
        if($this->functions->e($this->id_jugador)){
          throw new ModelsException('El campo id del jugador es obligatorio');
        }
        if($this->functions->e($this->sede)){
          throw new ModelsException('La sede es obligatoria');
        }
        if(  $this->cantidad >  $this->stock  ){
          throw new ModelsException('No hay esa cantidad disponible');
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

          $time = time();


          # Insertar elementos
          $this->db->query("INSERT INTO facturas_4
          (cantidad,tipo_uniforme,id_representante,fecha,id_jugador,codigo_sede)
          VALUES ($this->cantidad,$this->tipo_uniforme,'$this->id_representante',$time,'$this->id_jugador',$this->sede);");
       

          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            

  


    /**
        * Obtiene elementos de la tabla "facturas_4"
        *
        *
        * @return false|array: false si no hay datos.
        *                      array con los datos.
        */
    final public function get(string $select = '*') {

    return $this->db->query_select(
      "SELECT f4.numero_factura AS numero_factura , f4.fecha AS fecha , f4.cantidad AS cantidad,f4.tipo_uniforme AS tipo_uniforme,
       r4.nombre AS nombre,r4.apellido AS apellido ,r4.cedula_representante AS cedula_representante,
       j4.id_jugador AS id_jugador , j4.nombre AS nombrej , j4.apellido AS apellidoj , s4.nombre AS nombresede
       FROM facturas_4 f4
       INNER JOIN representantes_4 r4 ON r4.cedula_representante=f4.id_representante
       INNER JOIN jugadores_4 j4 ON j4.id_jugador=f4.id_jugador
       INNER JOIN sedes_4 s4 ON s4.codigo_sede=f4.codigo_sede 
      ;");


    }

    final public function getByCriterios() {
      global $http;
      
      $a = $http->query->get('criterio_ventas_1');
      $b = $http->query->get('criterio_ventas_2');
      $c = $http->query->get('criterio_ventas_3');
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
        $cri3 = "s4.nombre = '$c'";
      }

      $inner_select="";

      return $this->db->query_select(
      "SELECT f4.numero_factura AS numero_factura , FROM_UNIXTIME(f4.fecha) AS fecha , f4.cantidad AS cantidad,f4.tipo_uniforme AS tipo_uniforme,
       r4.nombre AS nombre,r4.apellido AS apellido ,r4.cedula_representante AS cedula_representante,
       j4.id_jugador AS id_jugador , j4.nombre AS nombrej , j4.apellido AS apellidoj ,
       pp.m AS pagado ,pp.t AS total , c4.costouniforme AS costouniforme , s4.nombre AS nombresede
       FROM facturas_4 f4
       INNER JOIN representantes_4 r4 ON r4.cedula_representante=f4.id_representante
       INNER JOIN jugadores_4 j4 ON j4.id_jugador=f4.id_jugador 
       INNER JOIN sedes_4 s4 ON s4.codigo_sede=f4.codigo_sede 
       INNER JOIN costos_4 c4 ON c4.clave=1    
       LEFT JOIN (SELECT SUM(p4.monto_pago) AS m ,COUNT(*) AS t , p4.numero_factura AS f FROM pagos_4 p4 GROUP BY  p4.numero_factura ) pp ON pp.f=f4.numero_factura
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



