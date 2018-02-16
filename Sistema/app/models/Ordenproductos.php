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
 * Modelo Ordenproductos
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Ordenproductos extends Models implements IModels {
    
 /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    final public function get() {
      return $this->db->query_select(
      "SELECT o4.* , s4.nombre AS nombre_sede , p4.descripcion AS descripcion
      FROM ordenes_productos_4 o4
      INNER JOIN productos_4 p4 ON p4.codigo_producto = o4.codigo_producto 
      INNER JOIN sedes_4 s4 ON p4.codigo_sede = s4.codigo_sede
      ");
    }


    final public function getByCriterios() {
      global $http;
      
      $criterios= $http->query->get('tipo_criterio_ordenproductos');
      $a = $http->query->get('criterio_ordenproductos_1');
      $b = $http->query->get('criterio_ordenproductos_2');
      $c = $http->query->get('criterio_ordenproductos_3');



        if($criterios=="uno" AND is_string($a)){

          /**/
          return $this->db->query_select(
            "SELECT o4.* , s4.nombre AS nombre_sede , p4.descripcion AS descripcion
            FROM ordenes_productos_4 o4
            INNER JOIN productos_4 p4 ON p4.codigo_producto = o4.codigo_producto 
            INNER JOIN sedes_4 s4 ON p4.codigo_sede = s4.codigo_sede
            INNER JOIN ordenes_compras_4 oc4 ON o4.numero_orden=oc4.numero_orden AND oc4.rif_proveedor='$a'
            ;");

        }else
        if($criterios=="dos" AND is_string($b) AND is_string($a) ){

          /**/
          return $this->db->query_select(
            "SELECT o4.* , s4.nombre AS nombre_sede , p4.descripcion AS descripcion
            FROM ordenes_productos_4 o4
            INNER JOIN productos_4 p4 ON p4.codigo_producto = o4.codigo_producto AND p4.descripcion LIKE ('$a%')
            INNER JOIN sedes_4 s4 ON p4.codigo_sede = s4.codigo_sede AND s4.nombre='$b'
            ;");


        }else
        
        if($criterios=="tres" AND is_string($a) AND is_string($b) AND is_string($c)){

          return $this->db->query_select(
            "SELECT o4.* , s4.nombre AS nombre_sede , p4.descripcion AS descripcion
            FROM ordenes_productos_4 o4
            INNER JOIN productos_4 p4 ON p4.codigo_producto = o4.codigo_producto AND p4.descripcion LIKE ('$b%')
            INNER JOIN sedes_4 s4 ON p4.codigo_sede = s4.codigo_sede
            INNER JOIN ordenes_compras_4 oc4 ON o4.numero_orden=oc4.numero_orden AND FROM_UNIXTIME(oc4.fecha_compra) LIKE ('$c%') AND
            oc4.rif_proveedor='$a'
            ;");



        }

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