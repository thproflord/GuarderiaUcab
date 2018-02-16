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
 * Modelo Productos
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Productos extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $descripcion;
    private $cantidad_minima;
    private $cantidad;
    private $cantidad_teorica;
    private $codigo_sede;
    private $precio;
    private $tipo;
    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $a=false) {
      global $http;
      $this->descripcion = $http->request->get('descripcion');
      $this->cantidad = $http->request->get('cantidad');
      $this->cantidad_teorica = $http->request->get('cantidad_teorica');
      $this->cantidad_minima = $http->request->get('cantidad_minima');
      $this->codigo_sede = $http->request->get('sede');
      $this->precio = $http->request->get('precio');
      $this->tipo = $http->request->get('tipo');

      if($this->functions->e($this->descripcion)){
        throw new ModelsException('Debe introducir una descripcion!');
      }
      if($this->functions->e($this->cantidad_minima)){
        throw new ModelsException('Debe introducir una cantidad minima!');
      }
      if($this->functions->e($this->cantidad)){
        throw new ModelsException('Debe introducir una cantidad!');
      }
      if($this->functions->e($this->cantidad_teorica)){
        throw new ModelsException('Debe introducir una cantidad teórica!');
      }
      if($this->functions->e($this->codigo_sede)){
        throw new ModelsException('Debe seleccionar una sede!');
      }
      if($this->functions->e($this->precio)){
        throw new ModelsException('Debe colocar un precio de venta!');
      }
      if($this->functions->e($this->tipo) and $a==true){
        throw new ModelsException('Debe seleccionar un tipo!');
      }
      if(!is_numeric($this->cantidad_minima) || $this->cantidad_minima < 0){
        throw new ModelsException('El valor la cantidad minima no es valido');
      }
      if(!is_numeric($this->cantidad) || $this->cantidad < 0){
        throw new ModelsException('El valor la cantidad no es valido');
      }
      if($this->cantidad < $this->cantidad_minima){
        throw new ModelsException('La cantidad no puede ser menor a la cantidad mínima');
      }
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Productos en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors(true);

        $t=0;
        if($this->tipo=="Uniforme"){
          $t=0;
        }else
        {
          $t=1;
        }


        # Insertar elementos
        $this->db->query("INSERT INTO productos_4
        (descripcion,cantidad,cantidad_teorica,cantidad_minima,codigo_sede,numero_factura,tipo,precio)
        VALUES ('$this->descripcion',$this->cantidad,$this->cantidad_teorica, $this->cantidad_minima, $this->codigo_sede,0,$t,$this->precio);");


        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Productos en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;
        
        # Obtener el id del elemento que se está editando y asignarlo en $this->id
        $codigo = $http->request->get('codigo'); 
                          
        # Controlar errores de entrada en el formulario
        $this->errors();
        
        # Actualizar elementos
        $this->db->query("UPDATE productos_4
        SET descripcion = '$this->descripcion', cantidad = $this->cantidad, cantidad_minima = $this->cantidad_minima,
        codigo_sede = $this->codigo_sede, cantidad_teorica = $this->cantidad_teorica,precio =  $this->precio
        WHERE codigo_producto = $codigo");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Productos en la tabla ``
      * y luego redirecciona a productos/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM productos_4 WHERE codigo_producto = $this->id");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'productos/&success=true');
    }

/**
      * Obtiene elementos de la tabla "Productos"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function get(string $criterio="-" ,$select = '*') {

    /*Busqueda general*/
      if($criterio=="-"){
      return $this->db->query_select("SELECT * FROM productos_4;");
    }

      /*Busqueda personalizada*/
      $like='%'.$select.'%';
    return $this->db->query_select("SELECT * FROM productos_4 WHERE $criterio LIKE '$like';");

    }

/**
      * Obtiene elementos de la tabla "Productos"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function getInt(string $criterio="-" ,$select = '*') {

    return $this->db->query_select("SELECT * FROM productos_4 WHERE $criterio=$select;");

    }

    /**
      * Obtiene elementos de Productos en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function getUniformes(bool $multi = true, string $select = '*') {
      if($multi) {
        return $this->db->query_select("SELECT productos_4.*, sedes_4.nombre 
        FROM productos_4
        INNER JOIN sedes_4 ON productos_4.codigo_sede = sedes_4.codigo_sede 
        WHERE productos_4.tipo = 0");
      }
    }

    final public function getUniformesBy(int $sede,int $select){

          /*Usado para restarle a la cantidad fisica del producto*/
         $uniforme;
          if($select==1){
          $uniforme="practica";
          }else{
          $uniforme="partido";
          }

          return $this->db->query_select(
          "SELECT cantidad, cantidad_minima
           FROM productos_4 p4
           WHERE codigo_sede = $sede AND descripcion LIKE ('%$uniforme')
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