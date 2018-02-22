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
    private $guarderia;
    private $telefono;
    private $direccion;
    private $estudio;
    private $sueldo;
    private $codigo;
    private $actividad = [];


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
      $this->guarderia = $http->request->get('guarderia');
      $this->telefono = $http->request->get('tlf');
      $this->direccion = $http->request->get('direccion');
      $this->estudio = $http->request->get('tipo_empleado');
      $this->sueldo = $http->request->get('sueldo');

      if(null !== $http->request->get('actividad')){
        foreach ($http->request->get('actividad') as $act ) {
          $actividad[] = $act;
        }
      }

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->apellido)){
        throw new ModelsException('El campo apellido es obligatorio');
      }
      if($this->functions->e($this->cedula)){
        throw new ModelsException('El campo cedula es obligatorio');
      }
      if($this->functions->e($this->sueldo)){
        throw new ModelsException('Debe tener un sueldo');
      }



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
        $this->db->query("INSERT INTO personal_2
        (nombre,apellidos,cedula,id_guarderia,direccion,telefono,nivel_estudio,sueldo)
        VALUES ('$this->nombre','$this->apellido','$this->cedula',$this->guarderia,'$this->direccion','$this->telefono',
        '$this->estudio', $this->sueldo);");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /**
      * Obtiene el personal de la guarderia
      *
      * @param string $c: codigo de la guarderia que se buscara los empleados
      *
      * @return array: devuelve el personal de la guarderia
    **/

    final public function getPersonal($c) : array {

    }

    /**
      * Edita un elemento de Personal en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;
        $this->codigo = $http->request->get('codigo');
        # Controlar errores de entrada en el formulario
        $this->errors(true);

        # Actualizar elementos
        $this->db->query("UPDATE personal_2
        SET nombre = '$this->nombre', apellidos = '$this->apellido', cedula ='$this->cedula',
        id_guarderia = '$this->guarderia', telefono = '$this->telefono', direccion = '$this->direccion',
        nivel_estudio = '$this->estudio', sueldo = $this->sueldo
        WHERE id_personal = $this->codigo ");

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
    final public function delete($emp) {
      global $config;

      global $http;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM personal_2 WHERE id_personal = $emp");
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
        return $this->db->query_select("SELECT * FROM personal_2;");
    /*Busqueda general
      if($criterio=="-"){
      return $this->db->query_select("SELECT * FROM empleados_4;");
    }

     if($criterio=="nacionalidad"){
      /*Busqueda personalizada
      $like=$select.'%';
    return $this->db->query_select("SELECT * FROM empleados_4 WHERE $criterio LIKE '$like';");
     }

     return $this->db->query_select("SELECT * FROM empleados_4 WHERE $criterio='$select';");*/

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
