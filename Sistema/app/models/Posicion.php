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

class Posicion extends Models implements IModels {
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

      $this->descripcion = $http->request->get('descripcion');
      $this->codigo = $http->request->get('codigo');

      if($this->functions->e($this->descripcion)){
        throw new ModelsException('El campo descripcion es obligatorio');
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
        $this->db->query("INSERT INTO posiciones_4
        (descripcion)
        VALUES ('$this->descripcion');");

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
        
        # Controlar errores de entrada en el formulario
        $this->errors(true);

        # Actualizar elementos
        $this->db->query("UPDATE posiciones_4
        SET descripcion = '$this->descripcion'
        WHERE codigo_posicion = $this->codigo;");

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
      $this->db->query("DELETE FROM posiciones_4 WHERE codigo_posicion = '$this->id'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'posicion/mostrar');
    }

   /**
      * Obtiene elementos de la tabla "Posicion"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
      final public function get(string $criterio="-" ,$select = '*',int $option=-1) {
        
            /*Busqueda general*/
              if($criterio=="-"){
              return $this->db->query_select("SELECT * FROM posiciones_4;");
            }
        
              if($option==1){
                $like='%'.$select.'%';
                return $this->db->query_select("SELECT * FROM posiciones_4 WHERE $criterio LIKE '$like';");
              }

              if($option==2){
                return $this->db->query_select("SELECT * FROM posiciones_4 AS c INNER JOIN (SELECT codigo_posicion , count(*) as total FROM jugadores_4 GROUP BY codigo_posicion) AS x ON c.codigo_posicion = x.codigo_posicion WHERE x.total = $select");               
              }

              if($option==3){
                return $this->db->query_select("SELECT * FROM posiciones_4 AS c INNER JOIN (SELECT codigo_posicion , count(*) as total FROM jugadores_4 GROUP BY codigo_posicion) AS x ON c.codigo_posicion = x.codigo_posicion WHERE x.total > $select");   
              }
        
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