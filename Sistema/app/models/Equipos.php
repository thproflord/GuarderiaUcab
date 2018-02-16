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

class Equipos extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $nombre;
    private $categoria;
    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre_equipo');
      $this->categoria = $http->request->get('categoria');

      if($this->functions->e($this->nombre,$this->categoria)){
        throw new ModelsException('Todos los campos son obligatorios');
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
        $this->db->query("INSERT INTO equipos_4
        (nombre_equipo,nombre_categoria)
        VALUES ('$this->nombre','$this->categoria');");

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
        $this->codigo = $http->request->get('codigo');
        
        # Controlar errores de entrada en el formulario
        $this->errors(true);

        # Actualizar elementos
        $this->db->query("UPDATE colegios_4
        SET nombre = '$this->nombre'
        WHERE codigo_colegio = $this->codigo;");

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
      $this->db->query("DELETE FROM equipos_4 WHERE nombre = '$nombre'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'equipos/mostrar');
    }

    /**
      * Obtiene elementos de la tabla "Colegios"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
      final public function get(string $select = '*') {
        return $this->db->query_select(
          "SELECT equipos_4.$select, x.tot_jugadores 
          FROM equipos_4
          LEFT JOIN (SELECT equipos_4.nombre_equipo, COUNT(id_jugador) AS tot_jugadores
                      FROM equipos_4
                      LEFT JOIN jugadores_4 ON jugadores_4.nombre_equipo = equipos_4.nombre_equipo
                      GROUP BY equipos_4.nombre_equipo) AS x ON x.nombre_equipo = equipos_4.nombre_equipo;");
      }

      /**
      * Obtiene los jugadores de un equipos
      *
      * @param string $equipo: nombre del equipo 
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
      final public function getJugadores(string $nombre) {
        return $this->db->query_select(
          "SELECT jugadores_4.*, posiciones_4.descripcion AS nombre_posicion
          FROM jugadores_4
          INNER JOIN equipos_4 ON equipos_4.nombre_equipo = jugadores_4.nombre_equipo
          INNER JOIN posiciones_4 ON posiciones_4.codigo_posicion = jugadores_4.codigo_posicion
          WHERE jugadores_4.nombre_equipo = '$nombre'");
      }

      /**
      * Obtiene eequipos por categoria
      *
      * @param string $categoria: categoria a buscar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
      final public function getByCategoria(string $categoria) {
        return $this->db->query_select(
          "SELECT *
           FROM equipos_4
           WHERE nombre_categoria = '$categoria'");
      }

      /**
     * Busqueda por tres criterios
     * 
    */

    final public function getTres(){
      global $http;
      $jugadores = $http->query->get('jugadores_criterio');
      $partidos = $http->query->get('partidos_criterio');
      $posicion = $http->query->get('posicion_criterio');
      $crit1 ='1=1';
      $crit2 ='1=1';
      $crit3 ='1=1';
      if (!$this->functions->e($jugadores)){
        $crit1="x.tot_jugadores > $jugadores";
      }
      if (!$this->functions->e($partidos)){
        $crit2 = "y.tot_partidos = $partidos";
      }
      if (!$this->functions->e($posicion)){
        $crit3 = "posiciones_4.descripcion NOT IN ('$posicion')";
      }

      return $this->db->query_select(
        "SELECT DISTINCT equipos_4.*, x.tot_jugadores 
        FROM equipos_4
        LEFT JOIN (SELECT equipos_4.nombre_equipo, COUNT(id_jugador) AS tot_jugadores
                    FROM equipos_4
                    LEFT JOIN jugadores_4 ON jugadores_4.nombre_equipo = equipos_4.nombre_equipo
                    GROUP BY equipos_4.nombre_equipo) AS x ON x.nombre_equipo = equipos_4.nombre_equipo
        LEFT JOIN (SELECT equipos_4.nombre_equipo, COUNT(partidos_4.id_partido) AS tot_partidos
                    FROM equipos_4
                    LEFT JOIN partidos_4 ON partidos_4.nombre_local = equipos_4.nombre_equipo OR partidos_4.nombre_visitante = equipos_4.nombre_equipo
                    GROUP BY equipos_4.nombre_equipo) AS y ON y.nombre_equipo = equipos_4.nombre_equipo
        LEFT JOIN jugadores_4 ON equipos_4.nombre_equipo = jugadores_4.nombre_equipo
        LEFT JOIN posiciones_4 ON posiciones_4.codigo_posicion = jugadores_4.codigo_posicion
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