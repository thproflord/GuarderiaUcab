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

class Enfermedades extends Models implements IModels {
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

      $this->codigo = $http->request->get('codig');
      $this->descripcion = $http->request->get('descripcion');

      if($this->functions->e($this->codigo)){
        throw new ModelsException('El campo Codigo es obligatorio');
      }
      if($this->functions->e($this->descripcion)){
        throw new ModelsException('El campo Descripcion es obligatorio');
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
        $this->db->query("INSERT INTO enfermedad_2
        (codigo,descripcion)
        VALUES ('$this->codigo','$this->descripcion');");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    final public function editar(){
      $this->db->update('representantes', array(
      ),"cedula=");
    }

    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM enfermedad_2;");
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
