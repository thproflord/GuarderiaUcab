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

class Representantes extends Models implements IModels {
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
    private $direccion;
    private $email;
    private $vivenino;

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
      $this->direccion = $http->request->get('direccion');
      $this->email = $http->request->get('email'); 
      $this->vivenino = $http->request->get('vivenino');

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
        $this->db->query("INSERT INTO padre_2
        (nombre,apellido,cedula,direccion,email,tel_casa,tel_ofic,tel_celular,profesion,principal,vivenino)
        VALUES ('$this->nombre','$this->apellido','$this->cedula','$this->direccion','$this->email','$this->tlf_casa','$this->tlf_oficina',
        '$this->tlf_celular','$this->profesion',$this->principal,'$this->vivenino');");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    final public function edit(){
      try{
        global $http;

        $this->errors(true);
        # Actualizar elementos
        $this->db->query("UPDATE padre_2
        SET nombre = '$this->nombre', apellido = '$this->apellido',direccion='$this->direccion', tel_casa = '$this->tlf_casa',
        tel_ofic = '$this->tlf_oficina', tel_celular = '$this->tlf_celular' ,
        profesion = '$this->profesion', principal = $this->principal,
        direccion = '$this->direccion'
        WHERE cedula = '$this->cedula';");

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
          $hijos = $this->db->query_select(
          "SELECT COUNT(*) as total
           FROM nino_2
           WHERE id_padre=$id;"
          );
          $hijos = $hijos[0]['total'];

          if ($hijos == 0){
             # Borrar el elemento de la base de datos
          $this->db->query("DELETE FROM padre_2 WHERE cedula = '$id'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'representantes/&success=true');
          }
          else{
            $this->functions->redir($config['site']['url'] . 'representantes/&success=true');}
         
        }

      final public function getHijos(){

        return $this->db->query_select(
          "SELECT COUNT (*)
           FROM ninos_2
           WHERE cedula='$this->id_padre';"
        );

      }

    final public function get(bool $multi = true, string $select = '*') {
        return $this->db->query_select("SELECT * FROM padre_2;");
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
