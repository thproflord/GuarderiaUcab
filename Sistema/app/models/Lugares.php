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

class Lugares extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $nombre;
    private $codigo;
    private $codigo_estado;
    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->codigo_estado = $http->request->get('estado');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->codigo_estado)){
        throw new ModelsException('Debe seleccionar un estado');
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
        $this->db->query("INSERT INTO ciudades_4
        (nombre,codigo_estado)
        VALUES ('$this->nombre',$this->codigo_estado);");

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
        $this->db->query("UPDATE ciudades_4
        SET nombre = '$this->nombre', codigo_estado = '$this->codigo_estado'
        WHERE codigo_ciudad = $this->codigo;");

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
      $this->db->query("DELETE FROM ciudades_4 WHERE codigo_ciudad = '$this->id'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'lugares/mostrar');
    }

  /**
      * Obtiene elementos de la tabla "Ciudad"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
      final public function get() {
       return $this->db->query_select("SELECT nombre,id_lugar  FROM lugar_2;");
      }
    


      /**
      * Obtiene elementos de la tabla "Categoria"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function getBySede(string $criterio="-" ,string $select = '*') {

        $innerquery="SELECT codigo_ciudad FROM sedes_4 WHERE $criterio = '$select' ";

    return $this->db->query_select("SELECT * FROM ciudades_4 WHERE codigo_ciudad = ($innerquery) ;");

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