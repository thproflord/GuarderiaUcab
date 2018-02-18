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

class Ninos extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;

    private $nombre;
    private $apellido;
    private $sexo;
    private $fecha_nac;
    private $cedula_repre;

    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */

    final private function errors(bool $edit = false) {
      global $http;

      $this->nombre = $http->request->get('nombre');
      $this->apellido = $http->request->get('apellido');
      $this->sexo = $http->request->get('sexo');
      $this->fecha_nac = $http->request->get('fecha_nac');
      $this->cedula_repre = $http->request->get('cedula_repre');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->apellido)){
        throw new ModelsException('El campo apellido es obligatorio');
      }
      if($this->functions->e($this->sexo)){
        throw new ModelsException('El campo sexo es obligatorio');
      }

      if($this->functions->e($this->fecha_nac)){
        throw new ModelsException('Por favor seleccione una fecha de nacimiento');
      }

      if($this->functions->e($this->cedula_repre)){
        throw new ModelsException('Por favor introduzca la cedula del representante');
      }

    }

    final public function add(){
      try {
        global $http;

        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO Nino_2
        (nombre,apellido,sexo,fecha_nac,id_padre)
        VALUES ('$this->nombre','$this->apellido','$this->sexo','$this->fecha_nac','$this->cedula_repre');");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    final public function editar(){
      $this->db->update('ninos', array(
      ),"cedula=");
    }

    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM Nino_2;");
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
