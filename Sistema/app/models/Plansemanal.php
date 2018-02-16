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
 * Modelo Plansemanal
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Plansemanal extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $duracion;
    private $plan;
    private $categoria;
    private $posicion;
    private $ejercicio;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      $this->plan = $http->request->get('plan');
      $this->duracion = $http->request->get('duracion');
      $this->categoria = $http->request->get('categoria');
      $this->posicion = $http->request->get('posicion');
      $this->ejercicio = $http->request->get('ejercicio');

      if($this->functions->e($this->plan,$this->duracion,$this->categoria,$this->posicion, $this->ejercicio)){
        throw new ModelsException('Todos los campos son obligatorios!');
      }
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Plansemanal en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query_select("INSERT INTO planes_semanales_4
        (id_plan_entrenamiento, id_ejercicio, nombre_categoria, codigo_posicion, duracion)
        VALUES ($this->plan,$this->ejercicio,'$this->categoria',$this->posicion,$this->duracion);");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Plansemanal en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;

        # Obtener el id del elemento que se está editando y asignarlo en $this->id
        $this->setId($http->request->get('id_'),'No se puede editar el elemento.'); 
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Actualizar elementos
        $this->db->update('',array(

        ),"id_='$this->id'",'LIMIT 1');

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Plansemanal en la tabla ``
      * y luego redirecciona a plansemanal/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->delete('',"id_='$this->id'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'plansemanal/&success=true');
    }

    /**
      * Obtiene elementos de Plansemanal en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(bool $multi = true, string $select = '*') {
      return $this->db->query_select("SELECT planes_semanales_4.$select, posiciones_4.descripcion AS posicion, ejercicios_4.descripcion AS ejercicio, planes_entrenamientos_4.nombre AS nombre_plan
      FROM planes_semanales_4
      LEFT JOIN posiciones_4 ON planes_semanales_4.codigo_posicion = posiciones_4.codigo_posicion
      INNER JOIN ejercicios_4 ON planes_semanales_4.id_ejercicio = ejercicios_4.id_ejercicio
      INNER JOIN planes_entrenamientos_4 ON planes_semanales_4.id_plan_entrenamiento = planes_entrenamientos_4.id_entrenamiento");
    }

    final public function getTres(){
      global $http;
      $plan = $http->query->get('plan_criterio');
      $nacionalidad = $http->query->get('nacionalidad_criterio');
      $jugadores = $http->query->get('jugadores_criterio');
      $crit1 ='1=1';
      $crit2 ='1=1';
      $crit3 ='1=1';
      if (!$this->functions->e($plan)){
        $crit1="planes_entrenamientos_4.nombre = '$plan'";
      }
      if (!$this->functions->e($nacionalidad)){
        $crit2 = "empleados_4.nacionalidad = '$nacionalidad'";
      }
      if (!$this->functions->e($jugadores)){
        $crit3 = "x.tot = $jugadores";
      }

      return $this->db->query_select(
      "SELECT planes_semanales_4.*, posiciones_4.descripcion AS posicion, ejercicios_4.descripcion AS ejercicio, planes_entrenamientos_4.nombre AS nombre_plan
      FROM planes_semanales_4
      LEFT JOIN posiciones_4 ON planes_semanales_4.codigo_posicion = posiciones_4.codigo_posicion
      INNER JOIN ejercicios_4 ON planes_semanales_4.id_ejercicio = ejercicios_4.id_ejercicio
      INNER JOIN planes_entrenamientos_4 ON planes_semanales_4.id_plan_entrenamiento = planes_entrenamientos_4.id_entrenamiento
      INNER JOIN empleados_4 ON empleados_4.cedula_empleado = planes_entrenamientos_4.ci_entrenador
      INNER JOIN (SELECT nombre_categoria, COUNT(id_jugador) AS tot
                  FROM jugadores_4
                  GROUP BY nombre_categoria) AS x ON x.nombre_categoria = planes_semanales_4.nombre_categoria
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