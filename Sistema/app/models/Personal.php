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
 * Modelo Personal
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Personal extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $nombre;
    private $apellido;
    private $cedula;
    private $nacionalidad;
    private $tipo;
    private $tlf_casa;
    private $tlf_oficina;
    private $tlf_celular;
    private $fecha_nacimiento;
    private $profesion;
    private $sexo;
    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->apellido = $http->request->get('apellido');
      $this->cedula = $http->request->get('cedula');
      $this->nacionalidad = $http->request->get('nacionalidad');
      $this->tlf_casa = $http->request->get('tlf_casa');
      $this->tlf_oficina = $http->request->get('tlf_oficina');
      $this->tlf_celular = $http->request->get('tlf_celular');
      $this->fecha_nacimiento = $http->request->get('fecha_nacimiento');
      $this->tipo = $http->request->get('tipo_empleado');
      $this->sexo = $http->request->get('sexo');
      $this->profesion = $http->request->get('profesion');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->apellido)){
        throw new ModelsException('El campo apellido es obligatorio');
      }
      if($this->functions->e($this->cedula)){
        throw new ModelsException('El campo cedula es obligatorio');
      }
      if($this->functions->e($this->nacionalidad)){
        throw new ModelsException('El campo nacionalida es obligatorio');
      }
      if($this->functions->e($this->fecha_nacimiento)){
        throw new ModelsException('El campo fecha de nacimiento es obligatorio');
      }

      if($this->functions->e($this->sexo)){
        throw new ModelsException('Por favor seleccione un sexo');
      }

      if($this->functions->e($this->profesion) && $this->tipo == 2){
        throw new ModelsException('Indique una profesión');
      }

      $cedula_exist = $this->db->query_select("SELECT * FROM empleados_4 WHERE cedula_empleado = '$this->cedula'");
      if(false!==$cedula_exist && !$edit){
        throw new ModelsException('El numero de cedula ya existe');
      }

     // throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Personal en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO empleados_4
        (nombre,apellido,cedula_empleado,nacionalidad,telefono_casa,telefono_oficina,telefono_celular,fecha_nacimiento,tipo,sexo,profesion)
        VALUES ('$this->nombre','$this->apellido','$this->cedula','$this->nacionalidad',$this->tlf_casa,$this->tlf_oficina,
        $this->tlf_celular,'$this->fecha_nacimiento',$this->tipo,'$this->sexo','$this->profesion');");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Personal en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;
        
        # Controlar errores de entrada en el formulario
        $this->errors(true);

        # Actualizar elementos
        $this->db->query("UPDATE empleados_4
        SET nombre = '$this->nombre', apellido = '$this->apellido', telefono_casa ='$this->tlf_casa',
        telefono_oficina = '$this->tlf_oficina', telefono_celular = '$this->tlf_celular', nacionalidad = '$this->nacionalidad',
        tipo = '$this->tipo', fecha_nacimiento = '$this->fecha_nacimiento', sexo = '$this->sexo', profesion = '$this->profesion'
        WHERE cedula_empleado = '$this->cedula'");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Personal en la tabla ``
      * y luego redirecciona a personal/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM empleados_4 WHERE cedula_empleado = '$this->id'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'personal/&success=true');
    }

/**
      * Obtiene elementos de la tabla "Empleado"
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
      return $this->db->query_select("SELECT * FROM empleados_4;");
    }

     if($criterio=="nacionalidad"){
      /*Busqueda personalizada*/
      $like=$select.'%';
    return $this->db->query_select("SELECT * FROM empleados_4 WHERE $criterio LIKE '$like';");
     }

     return $this->db->query_select("SELECT * FROM empleados_4 WHERE $criterio='$select';");

    }

    /**
      * Obtiene elementos de la tabla "Empleado"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function getFnac(string $criterio="-" ,string $select = '*') {

      /*Busqueda personalizada*/
      $like='%'.$select;
    return $this->db->query_select("SELECT * FROM empleados_4 WHERE $criterio LIKE '$like';");
    }

    /**
      * Obtiene a todos los coordinadores tecnicos de la tabla 'Personal'
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function getCoordTec(bool $multi = true, string $select = '*') {
      if($multi) {
        return $this->db->query_select("SELECT *
        FROM empleados_4
        WHERE tipo = 1;");
      }
    }

    /**
      * Obtiene a todos los entrenadores de la tabla 'Personal'
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function getEntrenadores(string $select = '*') {
        return $this->db->query_select("SELECT *
        FROM empleados_4
        WHERE tipo = 0;");

    }

    /**
      * Obtiene a todos los coordinadores administrativos de la tabla 'Personal'
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function getCoordAdmin(bool $multi = true, string $select = '*') {
      if($multi) {
        return $this->db->query_select("SELECT *
        FROM empleados_4
        WHERE tipo = 2;");
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