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

    private $nombre;
    private $apellido;
    private $cedula;
    private $tlf_casa;
    private $tlf_oficina;
    private $tlf_celular;
    private $profesion;
    private $sexo;

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
      $this->tlf_casa = ($http->request->get('tlf_casa') != ' ') ? $http->request->get('tlf_casa') : null;
      $this->tlf_oficina = ($http->request->get('tlf_oficina') != ' ') ? $http->request->get('tlf_oficina') : null;
      $this->tlf_celular = ($http->request->get('tlf_celular') != ' ') ? $http->request->get('tlf_celular') : null;
      $this->principal = $http->request->get('sexo');
      $this->profesion = $http->request->get('profesion');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->apellido)){
        throw new ModelsException('El campo apellido es obligatorio');
      }
      if($this->functions->e($this->cedula)){
        throw new ModelsException('El campo cedula es obligatorio');
      }

      if($this->functions->e($this->profesion) && $this->tipo == 2){
        throw new ModelsException('Indique una profesión');
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
        (nombre,apellido,cedula,tel_casa,tel_ofic,tel_celular,profesion,principal)
        VALUES ('$this->nombre','$this->apellido','$this->cedula','$this->tlf_casa','$this->tlf_oficina',
        '$this->tlf_celular','$this->profesion',$this->principal);");

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
