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
    private $letra;

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
      $this->cedula_repre = $http->request->get('cedula');
      $this->letra = $http->request->get('letra');

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
        $this->db->query("INSERT INTO nino_2
        (nombre,apellido,sexo,fecha_nac,id_padre,letra)
        VALUES ('$this->nombre','$this->apellido','$this->sexo','$this->fecha_nac','$this->cedula_repre','$this->letra');");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    final public function edit() : array {
      try {
        global $http;
        
        # Controlar errores de entrada en el formulario
        $this->errors(true);

        
        # Actualizar elementos
        $this->db->query("UPDATE Nino_2
        SET nombre  =  '$this->nombre', apellido = '$this->apellido', fecha_nac  =  '$this->fecha_nac', sexo = '$this->sexo'
        WHERE id_padre = '$this->cedula_repre' and letra = '$this->letra'");

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
        final public function delete($id,$letra) {
          global $config;
          # Borrar el elemento de la base de datos
          $this->db->query("DELETE FROM Nino_2 WHERE id_padre = '$id' and letra = '$letra'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'ninos/&success=true');
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
