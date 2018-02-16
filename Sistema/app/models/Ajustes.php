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
 * Modelo Ajustes
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Ajustes extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Ajustes en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
        
        $cant_teorica = $http->request->get('cantidad_teorica');
        $cant_fisica = $http->request->get('cantidad_fisica');
        $codigo_producto = $http->request->get('codigo_producto');
        $fecha = time();

        if($cant_teorica<$cant_fisica){
          $cantidad = $cant_fisica - $cant_teorica;
          $this->db->query("INSERT INTO ajustes_4(codigo_producto,fecha,cantidad,tipo)
          VALUES ($codigo_producto,$fecha,$cantidad,1)");

          $this->db->query("UPDATE productos_4 SET cantidad_teorica = $cant_fisica WHERE codigo_producto = $codigo_producto");
        }
        else if($cant_teorica>$cant_fisica){
          $cantidad = $cant_teorica - $cant_fisica;
          $this->db->query("INSERT INTO ajustes_4(codigo_producto,fecha,cantidad,tipo)
          VALUES ($codigo_producto,$fecha,$cantidad,0)");

          $this->db->query("UPDATE productos_4 SET cantidad_teorica = $cant_fisica WHERE codigo_producto = $codigo_producto");
        }
        else throw new ModelsException('Las cantidades coinciden, no hay ajuste que realizar');

        return array('success' => 1, 'message' => 'Ajuste realizado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    final public function dañado(){
      try{
        global $http;
        $cantidad = $http->request->get('cantidad');
        $equipo = $http->request->get('equipo');
        $cantidad = $cantidad - $equipo;
        $codigo = $http->request->get('id_producto');
        $fecha = date('Y-d-m');
        
        if($this->functions->e($equipo)){
          throw new ModelsException('Por favor introduzca una cantidad');
        }
        if(!is_numeric($equipo) || $equipo<0){
          throw new ModelsException('Valor no validoo');
        }
      
        $this->db->query("INSERT INTO ajustes_4 (cantidad,tipo,codigo_producto,fecha)
        VALUES ($equipo,2,$codigo,'$fecha')");
        $this->db->query("UPDATE productos_4 SET cantidad = $cantidad 
        WHERE codigo_producto = $codigo");

        return array('success' => 1, 'message' => 'Ajuste de equipos dañados realizado con éxito.');
      }
      catch (ModelsException $e){
        return array('success' => 0, 'message' => $e->getMessage());
      }
      }
          
    /** 
      * Edita un elemento de Ajustes en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;


        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Ajustes en la tabla ``
      * y luego redirecciona a ajustes/&success=true
      *
      * @return void
    */
    final public function delete() {

    }

    /**
      * Obtiene elementos de Ajustes en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get() {
      return $this->db->query_select(
      "SELECT ajustes_4.*, productos_4.codigo_sede, productos_4.descripcion
      FROM ajustes_4
      INNER JOIN productos_4 ON ajustes_4.codigo_producto = productos_4.codigo_producto
      ");
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