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
 * Modelo Sintomas
 *
 * @author Ramon García, Fernando Gomes y Alexander De Azevedo <oeneikaphotos@gmail.com>
 */

class Sintomas extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $codigo;
    private $descripcion;

    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
        global $http;
        $this->codigo = $http->request->get('codigo');
        $this->descripcion = $http->request->get('descripcion');

        if ($this->functions->e($this->codigo,$this->descripcion))
        {
          throw new ModelsException ('Todos los campos son necesarios');
        }
      }

    /** 
      * Crea un elemento de Sintomas en la tabla `sintomas_2`
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO sintoma_2(codigo,descripcion) VALUES('$this->codigo','$this->descripcion'
        );");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Sintomas en la tabla `sintomas_2`
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;

        # Controlar errores de entrada en el formulario
        $this->errors();

        # Actualizar elementos
        $this->db->query("UPDATE sintoma_2 SET
        descripcion='$this->descripcion'
        WHERE codigo='$this->codigo';");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Sintomas en la tabla `sintomas_2`
      * y luego redirecciona a sintomas/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM sintoma_2 WHERE codigo='$this->id' ;");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'sintomas/sintomas');
    }

    /**
      * Obtiene elementos de Sintomas en la tabla `sintomas_2`
      *
      * @param bool $multi: true si se quiere obtener un listado total de los elementos 
      *                     false si se quiere obtener un único elemento según su id_sintomas_2
      * @param string $select: Elementos de sintomas_2 a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
    */
    final public function get(bool $multi = true) {
      if($multi) {
        return $this->db->query_select("SELECT * FROM sintoma_2;");
      }
      return $this->db->query_select("SELECT * FROM sintoma_2 WHERE codigo = $this->codigo;");
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