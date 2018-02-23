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
    private $lugar;
    private $rif;
    private $telefono;
    private $costo;
    private $encargado;


    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->lugar = $http->request->get('lugar');
      $this->rif = $http->request->get('rif');
      $this->telefono = $http->request->get('telefono');
      $this->costo = $http->request->get('costo');
      $this->encargado = $http->request->get('encargado');

      if($this->functions->e($this->nombre,$this->lugar,$this->rif,$this->telefono,$this->costo,$this->encargado)){
        throw new ModelsException("Todos los campos son obligatorios");
      };

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
        $this->db->query("INSERT INTO guarderia_2
        (nombre,id_lugar,id_enc,rif,telefonos,costo)
        VALUES ('$this->nombre',$this->lugar,$this->encargado,'$this->rif','$this->telefono',$this->costo);");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /**
      * Devuelve los lugares
    **/

    final public function getL(){

      return $this->db->query_select("SELECT * FROM lugar_2;");

    }

    /**
      * Edita un elemento de Sedes en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;
        # Controlar errores de entrada en el formulario
        $this->errors();
        
        # Actualizar elementos
        $this->db->query("UPDATE guarderia_2
        SET nombre = '$this->nombre', id_lugar = $this->lugar, id_enc =$this->encargado,
        telefonos = '$this->telefono', costo = $this->costo
        WHERE id_guarderia = $codigo");

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
      $this->db->query("DELETE FROM guarderia_2 WHERE id_guarderia = $this->id");
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
    final public function get(string $criterio="-" ,$select = '*'){

      return $this->db->query_select("SELECT g.nombre,g.id_guarderia, g.rif, g.telefonos,g.costo,e.nombre as 'empleado',e.apellidos as 'apellido',
         e.id_personal, l.id_lugar, l.nombre as 'lugar' FROM guarderia_2 g,personal_2 e, lugar_2 l
         where g.id_enc = e.id_personal and g.id_lugar = l.id_lugar ;");

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
