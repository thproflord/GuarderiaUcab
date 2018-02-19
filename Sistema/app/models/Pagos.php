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
 * Modelo Pagos
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Pagos extends Models implements IModels {
    

    use DBModel;

    private $id_inscripcion;
    private $id_mensualidad;
    private $numero;
    private $fechapago;
    private $concepto;
    private $tipo_pago;
    private $monto;
    private $numero_cheque;
    private $numero_tarjeta;
    private $monto_debito;

    /*Esto es solo para los pagos de facturas , para validar que tipo de uniforme se esta pagando para hacer el ajuste en el inventario*/
    private $tipo_uniforme;


    /*Revisa los errores al momento de editar y crear*/
    final private function errors(bool $edit = false) {
        global $http;
          
        $this->id_inscripcion = $http->request->get('id_inscripcion');
        $this->id_mensualidad = $http->request->get('id_mensualidad');
        $this->numero = $http->request->get('numero');
        $this->fechapago = $http->request->get('fechapago');
        $this->concepto = $http->request->get('concepto');
        $this->tipo_pago = $http->request->get('tipo_pago');
        $this->monto = $http->request->get('monto');
        $this->numero_cheque = $http->request->get('numero_cheque');
        $this->numero_tarjeta = $http->request->get('numero_tarjeta');
        $this->monto_debito = $http->request->get('monto_debito');

        /*Si esto es falso entonces debo hacer un balance de inventario*/
        if( !($this->functions->e()) ){
          throw new ModelsException('La referencia bancaria es obligatoria');
        }


      }
  
      /** 
        * Crea un elemento de la tabla "pagos_4"
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function add() {
        try {
          global $http;

          # Controlar errores de entrada en el formulario
          $this->errors();

          $time = time();
          $abono=0;
          /*Agrega la comision de 10% por pagar con credito*/
          if($this->metodo_pago=="credito"){
          $abono=(10*$this->monto_pago)/100;
          $this->monto_pago+=$abono;
          }


          /*Inserta el pago de una factura*/
          
          if(!$this->functions->e($this->numero_factura)){

              /*Trae la suma de todos los montos de dicha factura para validar si se ha pagado almenos la mitad y para validar si esta pagando de mas*/
              $suma_montos = $this->db->query_select(
              "SELECT SUM(monto_pago) AS suma_montos
              FROM pagos_4
              WHERE numero_factura = $this->numero_factura
              GROUP BY numero_factura            
              ;");

              /*Traigo el costo de los uniformes general para validar si se ha pagado almenos la mitad y para luego colocarselo a la orden de compra*/
              $costouniforme=$this->db->query_select(
              "SELECT costouniforme
              FROM costos_4
              WHERE clave=1
              ;");

              /*Traigo la cantidad de elementos en la factura para validar multiplicando por el precio si se ha pagado la factura completa*/
              $cantidad_factura=$this->db->query_select(
              "SELECT cantidad
              FROM facturas_4
              WHERE numero_factura=$this->numero_factura
              ;");

              /*Multiplica el costo del uniforme por la cantidad de uniformes de la factura y obtengo el monto total*/
              $costo_total_factura = $costouniforme[0]["costouniforme"]*$cantidad_factura[0]["cantidad"];

              /*Valida que no este pagando de mas*/
              if(   ($suma_montos[0]["suma_montos"]+$this->monto_pago) > ($costo_total_factura)   ) {
                throw new ModelsException('Esta pagando de mas');
              }


              $this->db->query("INSERT INTO pagos_4
              (fecha_pago,monto_pago,ref_bancaria,cedula_representante,id_jugador,metodo_pago,numero_factura)
              VALUES ($time,$this->monto_pago,'$this->ref_bancaria','$this->cedula_representante','$this->id_jugador','$this->metodo_pago',$this->numero_factura);");

            
              /*Valida que la suma de los pagos hechos este completa*/
              if(  ($suma_montos[0]["suma_montos"]+$this->monto_pago) < ( $costo_total_factura )  ){
                return array('success' => 1, 'message' => 'Se ha pagado una porcion de la factura , debe pagar todo para que se le pueda entregar y se descuente del inventario');
              }


            /*A partir de aqui hace el reajuste al invetario fisico y luego valida si es necesario hacer una OC automaticamente*/

             $uniforme;
              if($this->tipo_uniforme==1){
              $uniforme="practica";
              }else{
              $uniforme="partido";
              }


            /*Esta query pregunta por el codigo de la sede que contiene la factura($this->numero_factura) y trae info de el tipo de uniforme especificado
            * Traigo la cantidad para hacer la resta al inventario fisico
            * Traigo el codigo sede para restarle al inventario fisico del producto
            * Traigo la cantidad_producto para hacer la resta al inventario fisico y luego de restar validar si es necesario generar OC
            * Traigo la cantidad_producto_minima para validar si debo hacer un reajuste luego de restar
            * Traigo el codigo_producto porque la orden de producto la necesita(en el caso de que se vaya a generar una OC automaticamente)
            * Traigo un array de un solo elemento
            */
             $datos = $this->db->query_select(
              "SELECT f4.cantidad AS cantidad, f4.codigo_sede AS codigo_sede , 
               p4.cantidad AS cantidad_producto ,p4.cantidad_minima AS cantidad_producto_minima , p4.codigo_producto AS codigo_producto
               FROM facturas_4 f4
               INNER JOIN productos_4 p4 ON p4.codigo_sede=f4.codigo_sede AND p4.descripcion LIKE ('%$uniforme')
               WHERE f4.numero_factura = $this->numero_factura
               ;");

              $sede_del_producto = $datos[0]["codigo_sede"];
              $cantidad_de_la_factura = $datos[0]["cantidad"];
              $cantidad_minima_producto = $datos[0]["cantidad_producto_minima"];
              $cantidad_fisica_producto = $datos[0]["cantidad_producto"];
              $codigo_producto_op = $datos[0]["codigo_producto"]; 
              $nueva_cantidad_fisica = $cantidad_fisica_producto - $cantidad_de_la_factura;
              


                /*Esto lo hago porque si hay dos facturas creedas y una de las dos se acaba todo el inventario , cuando vaya a pagar la otra
                * la cantidad ya no sera la misma y puede ser menor a cero , si es menor a cero
                */
                if($nueva_cantidad_fisica<0){

                  /*Borro el ultimo pago hecho*/

                  $this->db->query(
                    "DELETE FROM  pagos_4
                      WHERE numero_factura = $this->numero_factura
                    ;");
                  throw new ModelsException('Esta factura no se puede pagar pues no hay suficiente inventario para descontar');
                }else{

                /*Le resta a la cantidad fisica */
                $this->db->query(
                  "UPDATE productos_4
                  SET cantidad = $nueva_cantidad_fisica
                  WHERE codigo_producto = $codigo_producto_op
                  ;");

               }



                /*En el caso de que el nuevo stock fisico sea menor la cantidad minima debo generar un OC*/
                if($nueva_cantidad_fisica<$cantidad_minima_producto){

                    /*Traigo los rif de los proveedores*/
                    $rif_proveedor=$this->db->query_select(
                    "SELECT rif
                    FROM proveedores_4
                    ;");

                    /*En el caso de que no existan proveedores no se generara la orden de compra automaticamente*/
                    if(empty($rif_proveedor[0]["rif"])){
                      throw new ModelsException('No hay proveedores para crear una orden de compra automatica');
                    }
                  

                    $costo_uniforme_op = $costouniforme[0]["costouniforme"];
                    $monto_orden_compra = $costo_uniforme_op*10;
                    $rif_proveedor_oc = $rif_proveedor[0]["rif"];

                    /*Creo la OC */
                    $this->db->query(
                    "INSERT INTO ordenes_compras_4
                    (monto,fecha_compra,rif_proveedor,codigo_sede)
                    VALUES ($monto_orden_compra,$time,'$rif_proveedor_oc',$sede_del_producto)
                    ;");

                    $id_oc=$this->db->lastInsertId();

                    /*Creo la orden de producto a asociada a la orden de compra automatica(acabada de crear)*/
                      $this->db->query(
                      "INSERT INTO ordenes_productos_4
                      (codigo_producto,numero_orden,cantidad,precio)
                      VALUES ($codigo_producto_op,$id_oc,10,$costo_uniforme_op)
                      ;");

              return array('success' => 1, 'message' => 'Creado con Exito . Ademas se ha generado una nueva orden de compra , pagar para que se sume al inventario');
                }



          }else  
          /*Inserta el pago de una mensualidad*/
          if(!$this->functions->e($this->codigo_mensualidad)){
            $this->monto_pago-=$abono;
            $this->db->query("INSERT INTO pagos_4
            (fecha_pago,monto_pago,ref_bancaria,cedula_representante,id_jugador,metodo_pago,codigo_mensualidad,abono_credito)
            VALUES ($time,$this->monto_pago,'$this->ref_bancaria','$this->cedula_representante','$this->id_jugador','$this->metodo_pago','$this->codigo_mensualidad',$abono);");
          }else
          /*Inserta el pago de una inscripcion*/
          if(!$this->functions->e($this->anio_ini)){  
            $this->db->query("INSERT INTO pagos_4
            (fecha_pago,monto_pago,ref_bancaria,cedula_representante,id_jugador,metodo_pago,anio_ini,anio_fin)
            VALUES ($time,$this->monto_pago,'$this->ref_bancaria','$this->cedula_representante','$this->id_jugador','$this->metodo_pago',$this->anio_ini,$this->anio_fin);");
          }

  
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            

  


    /**
        * Obtiene elementos de la tabla "pagos_4"
        *
        * Trae los distintos tipos de pagos dependiendo de la variable recibida
        *
        * @return false|array: false si no hay datos.
        *                      array con los datos.
        */
    final public function getPagos(string $select='*') {

        
          return $this->db->query_select(
            "SELECT * FROM pago_insc_mens_2
            WHERE concepto = 1;"
          );


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