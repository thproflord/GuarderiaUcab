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

class Medicinas extends Models implements IModels {
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
      

      if($this->functions->e($this->codigo)){
        throw new ModelsException('El campo codigo es obligatorio');
      }
      if($this->functions->e($this->descripcion)){
        throw new ModelsException('El campo descripcion es obligatorio');
      }

    }

    final public function add(){
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO medicina_2
        (codigo,descripcion)
        VALUES ('$this->codigo','$this->descripcion');");

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
        $this->db->query("UPDATE medicina_2
        SET descripcion  =  '$this->descripcion'
        WHERE codigo = '$this->codigo'");

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
          $this->db->query("DELETE FROM medicina_2 WHERE codigo = '$id'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'medicinas/&success=true');
        }

    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM medicina_2;");
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