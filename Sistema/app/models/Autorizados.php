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

class Autorizados extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;

    private $nombre;
    private $apellido;
    private $cedula;
    private $telefono;

    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */

    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->apellido = $http->request->get('apellido');
      $this->cedula = $http->request->get('cedula');
      $this->telefono = $http->request->get('telefono');


      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->apellido)){
        throw new ModelsException('El campo apellido es obligatorio');
      }
      if($this->functions->e($this->cedula)){
        throw new ModelsException('El campo cedula es obligatorio');
      }
      if($this->functions->e($this->cedula)){
        throw new ModelsException('El campo telefono es obligatorio');
      }

    }

    final public function add(){
      try {
        global $http;

        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO autorizado_2
        (cedula,nombre,apellido,telefono)
        VALUES ('$this->cedula','$this->nombre','$this->apellido','$this->telefono');");

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
        $this->db->query("UPDATE autorizado_2
        SET nombre  =  '$this->nombre', apellido = '$this->apellido', telefono  =  '$this->telefono'
        WHERE cedula = '$this->cedula'");

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
        final public function delete($id) {
          global $config;
          # Borrar el elemento de la base de datos
          $this->db->query("DELETE FROM autorizado_2 WHERE cedula = '$id'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'autorizados/&success=true');
        }


    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM autorizado_2;");
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
