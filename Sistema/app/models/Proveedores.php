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
 * Modelo Proveedores
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Proveedores extends Models implements IModels {
    
    use DBModel;

    private $rif;
    private $nombre;
    private $direccion;
    private $persona_contacto;
    private $telefono;


    /*Revisa los errores al momento de editar y crear*/
    final private function errors(bool $edit = false) {
        global $http;

        $this->rif = $http->request->get('rif');
        $this->nombre = $http->request->get('nombre');
        $this->direccion = $http->request->get('direccion');
        $this->persona_contacto = $http->request->get('persona_contacto');
        $this->telefono = $http->request->get('telefono');



        if($this->functions->e($this->nombre)){
          throw new ModelsException('El campo nombre es obligatorio');
        }
        if($this->functions->e($this->rif)){
          throw new ModelsException('El campo rif es obligatorio');
        }
        if($this->functions->e($this->direccion)){
          throw new ModelsException('El campo direccion es obligatorio');
        }
        if($this->functions->e($this->persona_contacto)){
          throw new ModelsException('El campo persona de contacto es obligatorio');
        }
        if($this->functions->e($this->telefono)){
          throw new ModelsException('El campo telefono obligatorio');
        }

  
        if($edit==false){
            $rif_exist = $this->db->query_select("SELECT * FROM proveedores_4 WHERE rif = '$this->rif'");
            if(false!==$rif_exist && !$edit){
            throw new ModelsException('El codigo rif ya existe');
            }
       }
 
      }
  
      /** 
        * Crea un elemento de la tabla "Proveedores"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function add() {
        try {
          global $http;
                    
          # Controlar errores de entrada en el formulario
          $this->errors();
  

          # Insertar elementos
          $this->db->query("INSERT INTO proveedores_4
          (rif,nombre,direccion,telefono,persona_contacto)
          VALUES ('$this->rif','$this->nombre','$this->direccion','$this->telefono','$this->persona_contacto');");
  
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            
      /** 
        * Edita un elemento de la tabla "Proveedores"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function edit() : array {
        try {
          global $http;
          
          # Controlar errores de entrada en el formulario
          $this->errors(true);
  
          # Actualizar elementos
          $this->db->query("UPDATE proveedores_4
          SET nombre = '$this->nombre',telefono ='$this->telefono',
          direccion = '$this->direccion',persona_contacto = '$this->persona_contacto'
          WHERE rif = '$this->rif'");
  
          return array('success' => 1, 'message' => 'Editado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
  

      /** 
        * Borra un elemento de la tabla "Proveedores"
        * y luego redirecciona a personal/&success=true
        *
        * @return void
      */
      final public function delete($id) {
        global $config;
        # Borrar el elemento de la base de datos
        $this->db->query("DELETE FROM proveedores_4 WHERE rif = '$id'");
        # Redireccionar a la página principal del controlador
        $this->functions->redir($config['site']['url'] . 'proveedores/&success=true');
      }
  


    /**
        * Obtiene elementos de la tabla "Proveedores"
        *
        * @param $select: Elementos de a seleccionar
        *
        * @return false|array: false si no hay datos.
        *                      array con los datos.
        */
    final public function get(string $select = '*') {
    return $this->db->query_select("SELECT * FROM proveedores_4;");
    }

         /**
        * Obtiene elementos de la tabla "Proveedores"
        *
        *
        */
        final public function getByCriterios() {
          global $http;
          
          $criterios= $http->query->get('tipo_criterio_proveedores');
          $a = $http->query->get('criterio_proveedores_1');
          $b = $http->query->get('criterio_proveedores_2');
          $c = $http->query->get('criterio_proveedores_3');




            if($criterios=="uno" AND is_numeric($a) ){

              /*Trae los datos del proveedor que tiene dicha orden de compra(numero_orden)*/
              return $this->db->query_select(
                "SELECT DISTINCT p4.* 
                FROM proveedores_4 p4
                INNER JOIN ordenes_compras_4 oc4 ON oc4.rif_proveedor=p4.rif AND oc4.numero_orden=$a
                ;");

            }else
            if($criterios=="dos" AND is_numeric($b) AND is_string($a) ){

              /*Trae los datos del proveedor que vende $a producto con menor precio a $b*/
              return $this->db->query_select(
                "SELECT DISTINCT p4.* 
                FROM proveedores_4 p4
                INNER JOIN ordenes_compras_4 oc4 ON oc4.rif_proveedor=p4.rif
                INNER JOIN ordenes_productos_4 op4 ON op4.numero_orden=oc4.numero_orden AND op4.precio<=$b
                INNER JOIN productos_4 pd4 ON pd4.codigo_producto=op4.codigo_producto AND pd4.descripcion LIKE ('%$a%')
                ;");


            }else
            
            if($criterios=="tres" AND is_string($a) AND is_string($b) AND is_string($c)){

              //$c=strtotime(str_replace('/', '-', $c));
              //$c=substr($c,0,-6);
              //año-mes-dia
              
              /*Proveedores que hicieron una venta de $a producto a la $b sede la $c fecha*/
              return $this->db->query_select(
                "SELECT DISTINCT p4.* 
                FROM proveedores_4 p4   
                INNER JOIN ordenes_compras_4 oc4 ON oc4.rif_proveedor=p4.rif AND FROM_UNIXTIME(oc4.fecha_compra) LIKE ('$c%')
                INNER JOIN ordenes_productos_4 op4 ON op4.numero_orden=oc4.numero_orden
                INNER JOIN productos_4 pd4 ON pd4.codigo_producto=op4.codigo_producto AND pd4.descripcion LIKE ('%$a%')
                INNER JOIN sedes_4 s4 ON s4.codigo_sede=oc4.codigo_sede AND s4.nombre='$b'
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