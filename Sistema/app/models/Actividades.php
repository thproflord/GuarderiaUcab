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

class Actividades extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos.
    */
    use DBModel;

    private $codigo;
    private $nombre;
    private $transporte;
    private $costo_trans;
    private $edad_minima;
    private $descripcion;

    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */

    final private function errors(bool $edit = false) {
      global $http;

      $this->codigo = $http->request->get('codigo');
      $this->nombre = $http->request->get('nombre');
      $this->transporte = $http->request->get('transporte');
      $this->costo_trans = ($http->request->get('costo_trans') != ' ') ? $http->request->get('costo_trans') : null;
      $this->edad_minima = $http->request->get('edad_minima');
      $this->descripcion = $http->request->get('descripcion');

      if($this->functions->e($this->nombre)){
        throw new ModelsException('El campo nombre es obligatorio');
      }
      if($this->functions->e($this->transporte)){
        throw new ModelsException('El campo transporte es obligatorio');
      }
      if($this->functions->e($this->codigo)){
        throw new ModelsException('El campo codigo es obligatorio');
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
        $this->db->query("INSERT INTO actividad_2
        (codigo,nombre,transporte,costo_trans,edad_minima,descripcion)
        VALUES ('$this->codigo','$this->nombre','$this->transporte','$this->costo_trans','$this->edad_minima',
        '$this->descripcion');");

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
        $this->db->query("UPDATE actividad_2
        SET nombre  =  '$this->nombre', transporte = '$this->transporte', costo_trans  =  '$this->costo_trans', edad_minima  =  '$this->edad_minima', descripcion  =  '$this->descripcion'
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
          $this->db->query("DELETE FROM actividad_2 WHERE codigo = '$id'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'actividades/&success=true');
        }

    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM actividad_2;");
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
