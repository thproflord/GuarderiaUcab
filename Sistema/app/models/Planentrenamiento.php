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
 * Modelo Planentrenamiento
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Planentrenamiento extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $nombre;
    private $tipo;
    private $horario;
    private $entrenador;
    private $duracion;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      $this->nombre = $http->request->get('nombre');
      $this->tipo = $http->request->get('tipo');
      $this->horario = $http->request->get('horario');
      $this->entrenador = $http->request->get('entrenador');
      $this->duracion = $http->request->get('duracion');

      if($this->functions->e($this->nombre,$this->tipo,$this->horario,$this->entrenador,$this->duracion)){
        throw new ModelsException('Todos los campos son obligatorios!');
      }
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Planentrenamiento en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();
        $horario = $this->db->query_select("SELECT *
        FROM horarios_4
        WHERE id_horario = $this->horario
        LIMIT 1");
        # Se simplifica el resultado
        $horario = $horario[0];
        $anio_ini = $horario['anio_ini_horario'];
        $anio_fin = $horario['anio_fin_horario'];
        $sede = $horario['codigo_sede'];
        $dia = $horario['dia'];

        # Insertar elementos
        $this->db->query_select("INSERT INTO planes_entrenamientos_4
        (nombre,tipo,duracion,anio_ini,anio_fin,codigo_sede,dia,ci_entrenador)
        VALUES ('$this->nombre','$this->tipo',$this->duracion,$anio_ini,$anio_fin,$sede,$dia,$this->entrenador)");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Planentrenamiento en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;

        # Obtener el id del elemento que se está editando y asignarlo en $this->id
        $this->setId($http->request->get('id_plan')); 
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Actualizar elementos
        $this->db->query_select("UPDATE planes_entrenamientos_4
        SET nombre = '$this->nombre', duracion = $this->duracion, ci_entrenador = $this->entrenador, tipo = '$this->tipo'
        WHERE id_entrenamiento = $this->id");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Planentrenamiento en la tabla ``
      * y luego redirecciona a planentrenamiento/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query_select("DELETE FROM planes_entrenamientos_4
      WHERE id_entrenamiento = $this->id");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'planentrenamiento/');
    }

    /**
      * Obtiene elementos de Planentrenamiento en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(bool $multi = true, string $select = '*') {
      return $this->db->query_select("SELECT planes_entrenamientos_4.$select, sedes_4.nombre AS nombre_sede, empleados_4.nombre AS nombre_entrenador, horarios_4.id_horario
      FROM planes_entrenamientos_4
      INNER JOIN sedes_4 ON sedes_4.codigo_sede = planes_entrenamientos_4.codigo_sede
      INNER JOIN empleados_4 ON empleados_4.cedula_empleado = planes_entrenamientos_4.ci_entrenador
      INNER JOIN horarios_4 ON horarios_4.anio_ini_horario = planes_entrenamientos_4.anio_ini AND horarios_4.anio_fin_horario = planes_entrenamientos_4.anio_fin
      AND horarios_4.dia = planes_entrenamientos_4.dia AND horarios_4.codigo_sede = planes_entrenamientos_4.codigo_sede");
    }

    final public function getTres(){
      global $http;
      $sede = $http->query->get('sede_criterio');
      $posicion = $http->query->get('posicion_criterio');
      $categoria = $http->query->get('categoria_criterio');
      $crit1 ='1=1';
      $crit2 ='1=1';
      $crit3 ='1=1';
      if (!$this->functions->e($sede)){
        $crit1="horarios_4.codigo_sede = $sede";
      }
      if (!$this->functions->e($posicion)){
        $crit2 = "posiciones_4.descripcion = '$posicion'";
      }
      if (!$this->functions->e($categoria)){
        $crit3 = "planes_semanales_4.nombre_categoria = '$categoria'";
      }

      return $this->db->query_select(
      "SELECT DISTINCT planes_entrenamientos_4.*, sedes_4.nombre AS nombre_sede, empleados_4.nombre AS nombre_entrenador, horarios_4.id_horario
      FROM planes_entrenamientos_4
      INNER JOIN sedes_4 ON sedes_4.codigo_sede = planes_entrenamientos_4.codigo_sede
      INNER JOIN empleados_4 ON empleados_4.cedula_empleado = planes_entrenamientos_4.ci_entrenador
      INNER JOIN horarios_4 ON horarios_4.anio_ini_horario = planes_entrenamientos_4.anio_ini AND horarios_4.anio_fin_horario = planes_entrenamientos_4.anio_fin
      AND horarios_4.dia = planes_entrenamientos_4.dia AND horarios_4.codigo_sede = planes_entrenamientos_4.codigo_sede
      INNER JOIN planes_semanales_4 ON planes_semanales_4.id_plan_entrenamiento = planes_entrenamientos_4.id_entrenamiento
      LEFT JOIN posiciones_4 ON posiciones_4.codigo_posicion = planes_semanales_4.codigo_posicion
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