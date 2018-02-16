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
 * Modelo Horarios
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Horarios extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $anio_ini;
    private $anio_fin;
    private $hora_ini;
    private $hora_fin;
    private $sede;
    private $categoria;
    private $dia;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      $this->anio_ini = $http->request->get('anio_ini');
      $this->anio_fin = $http->request->get('anio_fin');
      $this->hora_ini = $http->request->get('hora_ini');
      $this->hora_fin = $http->request->get('hora_fin');
      $this->dia = $http->request->get('dia');
      $this->sede = $http->request->get('sede');
      $this->categoria = $http->request->get('categoria');
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Horarios en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query_select("INSERT INTO horarios_4
        (anio_ini_horario,anio_fin_horario,hora_ini,hora_fin,dia,codigo_sede,nombre_categoria) 
        VALUES ($this->anio_ini,$this->anio_fin,$this->hora_ini,$this->hora_fin,$this->dia,$this->sede,'$this->categoria')");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Horarios en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Actualizar elementos
        $this->db->query_select("UPDATE horarios_4
        SET hora_ini = $this->hora_ini, hora_fin = $this->hora_fin, nombre_categoria = '$this->categoria'
        WHERE anio_ini_horario = $this->anio_ini AND anio_fin_horario = $this->anio_fin AND dia = $this->dia AND codigo_sede = $this->sede");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Horarios en la tabla ``
      * y luego redirecciona a horarios/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->delete('',"id_='$this->id'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'horarios/&success=true');
    }

    /**
      * Obtiene elementos de Horarios en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(int $id=0, string $select = '*') {
      if($id == 0){
        return $this->db->query_select("SELECT horarios_4.$select, sedes_4.nombre AS nombre_sede
        FROM horarios_4
        INNER JOIN sedes_4 ON horarios_4.codigo_sede = sedes_4.codigo_sede");
      }

      return $this->db->query_select("SELECT horarios_4.$select, sedes_4.nombre AS nombre_sede
        FROM horarios_4
        INNER JOIN sedes_4 ON horarios_4.codigo_sede = sedes_4.codigo_sede
        WHERE horarios_4.codigo_sede = $id");
      
    }

    final public function getTres(){
      global $http;
      $inicio = $http->query->get('inicio_criterio');
      $dia = $http->query->get('dia_criterio');
      $ejercicios = $http->query->get('ejercicio_criterio');
      $crit1 ='1=1';
      $crit2 ='1=1';
      $crit3 ='1=1';
      if (!$this->functions->e($inicio)){
        $crit1="horarios_4.hora_ini = $inicio";
      }
      if (!$this->functions->e($ejercicios)){
        $crit2 = "ejercicios_4.descripcion = '$ejercicios'";
      }
      if (!$this->functions->e($dia)){
        $crit3 = "horarios_4.dia = STR_TO_DATE('$dia','%m/%d/%Y')";
      }

      return $this->db->query_select(
        "SELECT DISTINCT horarios_4.*, sedes_4.nombre AS nombre_sede
        FROM horarios_4
        INNER JOIN sedes_4 ON sedes_4.codigo_sede = horarios_4.codigo_sede 
        INNER JOIN planes_entrenamientos_4 ON planes_entrenamientos_4.anio_ini = horarios_4.anio_ini_horario AND planes_entrenamientos_4.anio_fin = horarios_4.anio_fin_horario AND planes_entrenamientos_4.dia = horarios_4.dia AND planes_entrenamientos_4.codigo_sede = horarios_4.codigo_sede
        INNER JOIN planes_semanales_4 ON planes_entrenamientos_4.id_entrenamiento = planes_semanales_4.id_plan_entrenamiento
        INNER JOIN ejercicios_4 ON planes_semanales_4.id_ejercicio = ejercicios_4.id_ejercicio
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