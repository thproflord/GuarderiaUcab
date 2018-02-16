<?php


namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;

/**
 * Modelo Categoria
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Partidos extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $local;
    private $visitante;
    private $anio_ini;
    private $anio_fin;
    private $goles_local;
    private $goles_visitante;
    private $duracion;
    private $fecha;
    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->local = $http->request->get('local');
      $this->visitante = $http->request->get('visitante');
      $this->anio_ini = $http->request->get('anio_ini');
      $this->anio_fin = $http->request->get('anio_fin');
      $this->fecha = $http->request->get('fecha');

      if($this->functions->e($this->anio_ini,$this->anio_fin)){
        throw new ModelsException('Todos los campos son obligatorios');
      }
    }

    /**
      * Controla los errores de entrada del formulario al editar
      *
      * @throws ModelsException
    */
    final private function errorsEdit(bool $edit = false) {
      global $http;

      $this->goles_local = $http->request->get('goles_local');
      $this->goles_visitante = $http->request->get('goles_visitante');
      $this->duracion = $http->request->get('duracion');

      if($this->functions->e($this->goles_local,$this->goles_visitante,$this->duracion)){
        throw new ModelsException('Todos los campos son obligatorios');
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
        $query = $this->db->prepare("INSERT INTO partidos_4
        (anio_ini_partido,anio_fin_partido,nombre_local,nombre_visitante,goles_visitante,goles_local,duracion,ronda,fecha)
        VALUES ($this->anio_ini,$this->anio_fin,?,?,0,0,0,0,STR_TO_DATE(?,'%m/%d/%y'));");

        for ($i = 0; $i < count($this->local); $i++){
          $query->execute(array($this->local[$i],$this->visitante[$i],$this->fecha[$i]));
        }

        $query->closeCursor();

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
        $this->errorsEdit();
        $id = $http->request->get('id_partido');
        $goles = $http->request->get('goles');
        $tipo = $http->request->get('tipo');

        //
        $query = $this->db->prepare("INSERT INTO goles_4
        (id_jugador,id_partido,codigo_posicion,tipo)
        VALUES (?,$id,?,?)");

        for($i = 0; $i < count($goles);$i++){
          $jugador = $this->db->query_select("SELECT * FROM jugadores_4 WHERE id_jugador = '$goles[$i]' LIMIT 1");
          $query->execute(array($goles[$i],$jugador[0]['codigo_posicion'],$tipo[$i]));
        }

        $query->closeCursor();
        
        # Actualizar elementos
        $this->db->query("UPDATE partidos_4
        SET goles_local  =  $this->goles_local, goles_visitante  =  $this->goles_visitante, duracion = $this->duracion
        WHERE id_partido = $id ");

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
    final public function delete($nombre_categoria) {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM partidos_4 WHERE nombre_categoria ='$nombre_categoria'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'partidos/mostrar');
    }

    /**
      * Obtiene elementos de Personal en la tabla ``
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(bool $multi = true, string $select = '*') {
      if($multi) {
        return $this->db->query_select("SELECT *
                                        FROM partidos_4;");
      }

    }

    /**
     * Busqueda por tres criterios
     * 
    */

    final public function getTres(){
      global $http;
      $equipo = $http->query->get('equipo_criterio');
      $jugador = $http->query->get('jugador_criterio');
      $promedio = $http->query->get('promedio_criterio');
      $crit1 ='1=1';
      $crit2 ='1=1';
      $crit3 ='1=1';
      if (!$this->functions->e($jugador)){
        $crit1="(jugadores_4.nombre = '$jugador' OR jugadores_4.apellido = '$jugador')";
      }
      if (!$this->functions->e($equipo)){
        $crit2 = "(partidos_4.nombre_local = '$equipo' OR partidos_4.nombre_visitante = '$equipo')";
      }
      if (!$this->functions->e($promedio)){
        $crit3 = "records_academicos_4.promedio > $promedio";
      }

      return $this->db->query_select(
        "SELECT DISTINCT partidos_4.*
        FROM partidos_4
        INNER JOIN equipos_4 ON equipos_4.nombre_equipo = partidos_4.nombre_local OR equipos_4.nombre_equipo = partidos_4.nombre_visitante
        LEFT JOIN jugadores_4 ON jugadores_4.nombre_equipo = equipos_4.nombre_equipo
        LEFT JOIN records_academicos_4 ON records_academicos_4.cedula_jugador = jugadores_4.id_jugador
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