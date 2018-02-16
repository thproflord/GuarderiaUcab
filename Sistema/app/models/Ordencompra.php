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
 * Modelo Ordencompra
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Ordencompra extends Models implements IModels {

    use DBModel;

    private $numero_orden;//clave autoincrementable

    private $monto=0;
    private $rif_proveedor;
    private $codigo_sede;

    /*Arrays con la misma longitud*/
    private $productos;
    private $cantidades;
    private $precios;

    private $fecha_pago;
    private $ref_bancaria;
    
    


    /*Revisa los errores al momento de editar y crear*/
    final private function errors(int $edit) {
        global $http;
       
        if($edit == 0){
        /*Atributos usados para crear la oc*/

        $this->rif_proveedor = $http->request->get('rif_proveedor');
        $this->codigo_sede = $http->request->get('codigo_sede');

        /* Arrays */
        $this->productos = $http->request->get('lista_productos');
        $this->cantidades = $http->request->get('cantidades_pago');
        $this->precios = $http->request->get('precios_pago');


        if($this->functions->e($this->rif_proveedor)){
          throw new ModelsException('El campo rif proveedor es obligatorio');
        }
        if($this->functions->e($this->codigo_sede)){
          throw new ModelsException('El campo codigo de la sede es obligatorio');
        }

         if(empty($this->productos)){
          throw new ModelsException('No se puede crear una oc sin productos');
        }

          if( count($this->cantidades)!=count($this->productos)  or count($this->cantidades)!=count($this->precios) or count($this->productos)!=count($this->precios)){
            throw new ModelsException('La cantidad de productos , precios y cantidades debe ser igual');
          }

          for ($i=0; $i < count($this->cantidades) ; $i++) { 
            if($this->cantidades[$i]<1){
              throw new ModelsException('Ninguna cantidad puede ser menor a 1');
            }
          }
          for ($i=0; $i < count($this->precios) ; $i++) { 
            if($this->precios[$i]<1){
              throw new ModelsException('Ningun precio puede ser menor a 1');
            }
          }



        }else 
          /* Si se esta editando*/
        if($edit==1){
        $this->numero_orden = $http->request->get('numero_orden');//autoincrement
        $this->fecha_pago = $http->request->get('fecha_pago');//null al crear
        }else{
          
          /*Atributos usados para pagar la oc*/
          $this->ref_bancaria = $http->request->get('ref_bancaria');
          $this->numero_orden = $http->request->get('numero_orden_pago');

          if($this->functions->e($this->ref_bancaria)){
            throw new ModelsException('La referencia bancaria es obligatoria');
          }

        }

        

        }
            
  
      /** 
        * Crea un elemento de la tabla "ordenes_compras_4"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function add() {
        try {
          global $http;
                    
          # Controlar errores de entrada en el formulario
          $this->errors(0);

          
          /*Calcula el monto total*/
          for ($i = 0; $i < count( $this->cantidades ); $i++) {
            $this->monto+=$this->cantidades[$i]*$this->precios[$i];
          }

          $time = time();

          # Insertar elementos
          $this->db->query(
          "INSERT INTO ordenes_compras_4
          (monto,rif_proveedor,codigo_sede,fecha_compra)
          VALUES ($this->monto,'$this->rif_proveedor',$this->codigo_sede,$time);");

            $id=$this->db->lastInsertId();

          /*Crea todas las ordenes de productos por esta oc*/
          for ($i = 0; $i < count( $this->productos ); $i++) {
          
            $a=$this->productos[$i];
            $b=$this->cantidades[$i];
            $c=$this->precios[$i];

            $this->db->query(
            "INSERT INTO ordenes_productos_4
            (codigo_producto,numero_orden,cantidad,precio)
            VALUES ($a,$id,$b,$c)
            ;");
        
            }

  
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            
      /** 
        * Edita un elemento de la tabla "orden_compra_4"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function edit() : array {
        try {
          global $http;
          
          # Controlar errores de entrada en el formulario
          $this->errors(true);
          $time = time();

          # Actualizar elementos
          $this->db->query("UPDATE ordenes_compras_4
          SET monto = $this->monto,ref_bancaria ='$this->ref_bancaria',
          fecha_pago =  $time
          WHERE numero_orden = $this->numero_orden");
  
          return array('success' => 1, 'message' => 'Editado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }


      final public function pagar() : array {
        try {
          global $http;
          
          # Controlar errores de entrada en el formulario
          $this->errors(2);
          $time = time();

          /*Paga la OC*/
          $this->db->query("UPDATE ordenes_compras_4
          SET ref_bancaria ='$this->ref_bancaria',fecha_pago =  $time
          WHERE numero_orden = $this->numero_orden");

          /**/
          $entrada = $this->db->query_select(
          "SELECT op4.codigo_producto AS codigo_producto , op4.cantidad AS cantidad 
           FROM ordenes_productos_4 op4
           INNER JOIN ordenes_compras_4 oc4 ON oc4.numero_orden = op4.numero_orden
           WHERE op4.numero_orden=$this->numero_orden
          ;");



          /*Suma al inventario fisico por cada producto de la oc*/
          for($i=0 ; $i< count($entrada);$i++){
            
          $c = $entrada[$i]["cantidad"];
          $cp = $entrada[$i]["codigo_producto"];

            $this->db->query(
            "UPDATE productos_4
            SET cantidad=cantidad+$c
            WHERE codigo_producto=$cp
            ;");
          }

          return array('success' => 1, 'message' => 'Editado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
  

      /** 
        * Borra un elemento de la tabla "ordenes_compras_4"
        * y luego redirecciona a personal/&success=true
        *
        * @return void
      */
      final public function delete($id) {
        global $config;
        # Borrar el elemento de la base de datos
        $this->db->query("DELETE FROM ordenes_compras_4 WHERE numero_orden = $id");
        # Redireccionar a la página principal del controlador
        $this->functions->redir($config['site']['url'] . 'ordencompra/&success=true');
      }
  


      /**
          * Obtiene elementos de la tabla "ordenes_compras_4"
          *
          *
          * @return false|array: false si no hay datos.
          *                      array con los datos.
          */
      final public function get() {
      return $this->db->query_select(
      "SELECT oc4.numero_orden AS numero_orden,oc4.fecha_compra AS fecha_compra , oc4.monto AS monto , oc4.fecha_pago AS fecha_pago,
       oc4.ref_bancaria AS ref_bancaria,oc4.rif_proveedor AS rif_proveedor , p4.nombre AS nombre_proveedor ,oc4.codigo_sede AS codigo_sede,
       s4.nombre AS nombre_sede
       FROM ordenes_compras_4 oc4
       INNER JOIN sedes_4 s4 ON oc4.codigo_sede=s4.codigo_sede
       INNER JOIN proveedores_4 p4 ON p4.rif=oc4.rif_proveedor
      ;");
      }


      /**
       * Trae elementos de la tabla ordenes_productos_4 que contengan al numero de oc pasado por parametro
       * 
       * @integer $numero = numero oc
       */
      final public function getOP($numero){

        return $this->db->query_select(
          "SELECT op4.cantidad AS cantidad , p4.descripcion AS descripcion
           FROM ordenes_productos_4 op4
           INNER JOIN productos_4 p4 ON p4.codigo_producto=op4.codigo_producto
           WHERE op4.numero_orden=$numero
          ;");

      }


      final public function getByCriterios() {
          global $http;
          
          $a = $http->query->get('criterio_ordencompra_1');
          $b = $http->query->get('criterio_ordencompra_2');
          $c = $http->query->get('criterio_ordencompra_3');
          $cri1="s4.nombre IS NOT NULL";
          $cri2="p4.nombre IS NOT NULL";
          $cri3="pp4.descripcion IS NOT NULL";

          if (!$this->functions->e($a)){
            $cri1="s4.nombre = '$a'";
          }
          if (!$this->functions->e($b)){
            $cri2 = "p4.nombre = '$b'";
          }
          if (!$this->functions->e($c)){
            $cri3 = "pp4.descripcion LIKE '%$c%'";
          }


          return $this->db->query_select(
          "SELECT oc4.numero_orden AS numero_orden,FROM_UNIXTIME(oc4.fecha_compra,'%d %m %Y') AS fecha_compra , oc4.monto AS monto , FROM_UNIXTIME(oc4.fecha_pago,'%d %m %Y') AS fecha_pago,
            oc4.ref_bancaria AS ref_bancaria,oc4.rif_proveedor AS rif_proveedor , p4.nombre AS nombre_proveedor ,oc4.codigo_sede AS codigo_sede,
            s4.nombre AS nombre_sede
            FROM ordenes_compras_4 oc4
            INNER JOIN sedes_4 s4 ON oc4.codigo_sede=s4.codigo_sede
            INNER JOIN proveedores_4 p4 ON p4.rif=oc4.rif_proveedor
            INNER JOIN ordenes_productos_4 op4 ON op4.numero_orden=oc4.numero_orden
            INNER JOIN productos_4 pp4 ON pp4.codigo_producto=op4.codigo_producto
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