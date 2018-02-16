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

class Categorias extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $nombre;

    private $año_nacimiento;
    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->año_nacimiento = $http->request->get('año_nacimiento');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }

      if($this->functions->e($this->año_nacimiento)){
        throw new ModelsException('El campo año de nacimiento es obligatorio');
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
        $this->db->query("INSERT INTO categorias_4
        (nombre_categoria,año_nacimiento)
        VALUES ('$this->nombre','$this->año_nacimiento');");

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
        $this->errors(true);

        
        # Actualizar elementos
        $this->db->query("UPDATE categorias_4
        SET año_nacimiento  =  '$this->año_nacimiento'
        WHERE nombre_categoria = '$this->nombre'");

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
      $this->db->query("DELETE FROM categorias_4 WHERE nombre_categoria ='$nombre_categoria'");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'categorias/mostrar');
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
    final public function get(string $criterio="-", $select = '*',int $option=-1) {
    /*Busqueda general*/
              if($criterio=="-"){
              return $this->db->query_select("SELECT * FROM categorias_4;");
            }
        
              if($option==1){
                return $this->db->query_select("SELECT * FROM categorias_4 WHERE $criterio='$select';");
              }

              if($option==2){
                $like='%'.$select.'%';
                return $this->db->query_select("SELECT * FROM categorias_4 WHERE $criterio LIKE '$like';");
              }

              if($option==3){
                $innerquery="SELECT nombre_categoria FROM jugadores_4 WHERE $criterio = '$select' ";
                
                    return $this->db->query_select("SELECT * FROM categorias_4 WHERE nombre_categoria = ($innerquery) ;");              }


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