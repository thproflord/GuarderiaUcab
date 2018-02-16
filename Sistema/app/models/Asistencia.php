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
 * Modelo Asistencia
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Asistencia extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    /**
     * Datos a traer de la pagina 
    */
    private $jugadores;
    private $asistencia;
    private $sede;
    private $hora;
    private $dia;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      $this->jugadores = $http->request->get('jugadores');
      $this->asistencia = $http->request->get('asistencia');
      $this->hora = $http->request->get('hora');
      $this->sede = $http->request->get('sede');
      $this->dia = $http->request->get('dia');

      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Asistencia en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        $asist = $this->db->prepare("INSERT INTO asistencias_4(id_jugador,anio_ini,anio_fin,dia,hora_llegada,falto,mes)
        VALUES (?,2016,2017,'$this->dia',?,?,'test')");

        for($i=0;$i<count($this->jugadores);$i++){
          $asist->execute(array($this->jugadores[$i],$this->hora[$i],$this->asistencia[$i]));
        }

        $asist->closeCursor();

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Asistencia en la tabla ``
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
      * Borra un elemento de Asistencia en la tabla ``
      * y luego redirecciona a asistencia/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->delete('',"id_='$this->id'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'asistencia/&success=true');
    }

    /**
      * Obtiene elementos de Asistencia en la tabla ``
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
        return $this->db->select($select,'');
      }

      return $this->db->select($select,'',"id_='$this->id'",'LIMIT 1');
    }

    final public function getDiasAsistidos(){
      return $this->db->query_select("SELECT DISTINCT asistencias_4.dia, asistencias_4.anio_fin, asistencias_4.anio_ini
      FROM asistencias_4");
    }

    final public function getAlumnosAsist($dia, $sede){
      $date = date_create($dia);
        $diaS = date_format($date,'N');
        return $this->db->query_select(
          "SELECT DISTINCT jugadores_4.*, asistencias_4.falto, asistencias_4.hora_llegada
          FROM jugadores_4
          INNER JOIN asistencias_4 ON asistencias_4.id_jugador = jugadores_4.id_jugador
          INNER JOIN inscripciones_4 ON inscripciones_4.id_jugador = jugadores_4.id_jugador
          WHERE DATE_FORMAT(asistencias_4.dia,'%Y-%m-%d') = '$dia' AND inscripciones_4.codigo_sede = $sede");
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