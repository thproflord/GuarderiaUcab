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
 * Modelo Sedes
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Sedes extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $nombre;
    private $direccion;
    private $costo_3dias;
    private $costo_5dias;
    private $fecha_apertura;
    private $calle;
    private $urbanizacion;
    private $coord_tecnico;
    private $coord_admin;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->direccion = $http->request->get('direccion');
      $this->costo_3dias = $http->request->get('costo_3dias');
      $this->costo_5dias = $http->request->get('costo_5dias');
      $this->fecha_apertura = $http->request->get('fecha_apertura');
      $this->calle = $http->request->get('calle');
      $this->urbanizacion = $http->request->get('urbanizacion'); 
      $this->coord_tecnico = $http->request->get('coord_tecnico');
      $this->coord_admin = $http->request->get('coord_admin');  

      if($this->functions->e($this->nombre)){
        throw new ModelsException('Por favor introduzca un nombre!');
      }
      if($this->functions->e($this->direccion)){
        throw new ModelsException('Por favor introduzca una dirección!');
      }
      if($this->functions->e($this->costo_3dias,$this->costo_5dias)){
        throw new ModelsException('Los campos costo para 3 y 5 días son abligatorios');
      }
      if($this->functions->e($this->fecha_apertura)){
        throw new ModelsException('Por favor introduzca una fecha de apertura!');
      }
      if($this->functions->e($this->calle)){
        throw new ModelsException('Por favor introduzca una calle!');
      }
      if($this->functions->e($this->urbanizacion)){
        throw new ModelsException('Por favor introduzca una urbanización!');
      }
      if($this->functions->e($this->coord_admin,$this->coord_tecnico)){
        throw new ModelsException('Debe elegir un coordinador tecnico y uno administrativo');
      }
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Sedes en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO sedes_4
        (nombre,direccion,costo_3dias,costo_5dias,fecha_apertura,calle,urbanizacion,ci_coord_tecni,ci_coord_admin,codigo_ciudad)
        VALUES ('$this->nombre','$this->direccion',$this->costo_3dias,$this->costo_5dias,'$this->fecha_apertura','$this->calle',
        '$this->urbanizacion','$this->coord_tecnico','$this->coord_admin',1);");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Sedes en la tabla ``
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
        $this->db->query("UPDATE sedes_4
        SET nombre = '$this->nombre', direccion = '$this->direccion', costo_3dias =$this->costo_3dias,
        costo_5dias = $this->costo_5dias, calle = '$this->calle', urbanizacion = '$this->urbanizacion',
        fecha_apertura = '$this->fecha_apertura', ci_coord_tecni = '$this->coord_tecnico', ci_coord_admin = '$this->coord_admin'
        WHERE codigo_sede = $codigo");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Sedes en la tabla ``
      * y luego redirecciona a sedes/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM sedes_4 WHERE codigo_sede = $this->id");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'sedes/&success=true');
    }

    /**
      * Obtiene elementos de la tabla "Sedes"
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
      return $this->db->query_select("SELECT * FROM sedes_4;");
    }
      /*Busqueda personalizada*/
    return $this->db->query_select("SELECT * FROM sedes_4  WHERE $criterio='$select';");
    }

    /**
      * Obtiene elementos de la tabla "Sedes"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function getCosto(string $criterio="-" ,$select = '*') {

      /*Busqueda personalizada*/
    return $this->db->query_select("SELECT * FROM sedes_4  WHERE $criterio<=$select;");
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