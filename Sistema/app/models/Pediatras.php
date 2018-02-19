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

class Pediatras extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;

    private $cedula;
    private $nombre;
    private $telefono;

    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */

    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->cedula = $http->request->get('cedula');
      $this->tlf = $http->request->get('tlf');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->cedula)){
        throw new ModelsException('El campo cedula es obligatorio');
      }
      if($this->functions->e($this->tlf)){
        throw new ModelsException('El campo telefono es obligatorio');
      }

      /*$cedula_exist = $this->db->query_select("SELECT * FROM representantes WHERE cedula_empleado = '$this->cedula'");
      if(false!==$cedula_exist && !$edit){
        throw new ModelsException('El numero de cedula ya existe');
      }*/

     // throw new ModelsException('¡Esto es un error!');
    }

    final public function add(){
      try {
        global $http;

        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO pediatra_2
        (nombre,cedula,telefono)
        VALUES ('$this->nombre','$this->cedula','$this->tlf');");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    final public function edit(){
      $this->db->update('representantes', array(
      ),"cedula=");
    }

    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM pediatra_2;");
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
