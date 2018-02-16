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
 * Modelo Ejercicios
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Ejercicios extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    /**
     * 
     * Descripcion de un ejercicio
     * 
     */
    private $descripcion;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;

      $this->descripcion = $http->request->get('descripcion');

      if($this->functions->e($this->descripcion)){
        throw new ModelsException('¡Debe introducir una descripcion!');
      }
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Ejercicios en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query_select("INSERT INTO ejercicios_4
        (descripcion) VALUES ('$this->descripcion')");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Ejercicios en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;

        # Obtener el id del elemento que se está editando y asignarlo en $this->id
        $this->setId($http->request->get('id_ejercicio')); 
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Actualizar elementos
        $this->db->query_select("UPDATE ejercicios_4
        SET descripcion = '$this->descripcion'
        WHERE id_ejercicio = $this->id");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Ejercicios en la tabla ``
      * y luego redirecciona a ejercicios/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query_select("DELETE FROM ejercicios_4
      WHERE id_ejercicio = $this->id");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'ejercicios/');
    }

    /**
      * Obtiene elementos de Ejercicios en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(string $select = '*') {
      return $this->db->query_select("SELECT $select
      FROM ejercicios_4");
    }

    /**
     * Busqueda por tres criterios
     * 
    */

    final public function getTres(){
      global $http;
      $codigo = $http->query->get('sede_criterio');
      $nombre = $http->query->get('nombre_criterio');
      $entrenador = $http->query->get('entrenador_criterio');
      $crit1 ='1=1';
      $crit2 ='1=1';
      $crit3 ='1=1';
      if (!$this->functions->e($codigo)){
        $crit1="sedes_4.codigo_sede = $codigo";
      }
      if (!$this->functions->e($nombre)){
        $crit2 = "ejercicios_4.descripcion = '$nombre'";
      }
      if (!$this->functions->e($entrenador)){
        $crit3 = "empleados_4.nombre = '$entrenador'";
      }

      return $this->db->query_select(
        "SELECT DISTINCT ejercicios_4.*
        FROM ejercicios_4
        INNER JOIN planes_semanales_4 ON planes_semanales_4.id_ejercicio = ejercicios_4.id_ejercicio
        INNER JOIN planes_entrenamientos_4 ON planes_entrenamientos_4.id_entrenamiento = planes_semanales_4.id_plan_entrenamiento
        INNER JOIN sedes_4 ON planes_entrenamientos_4.codigo_sede = sedes_4.codigo_sede
        INNER JOIN empleados_4 ON empleados_4.cedula_empleado = planes_entrenamientos_4.ci_entrenador
        WHERE $crit1 AND $crit2 AND $crit3");
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