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
    private $cedula_repre2;

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
      $this->cedula_repre2 = $http->request->get('cedula2');
      $this->enfermedades = $http->request->get('enfermedades');
      $this->juegos = $http->request->get('juegos');

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

      if($this->functions->e($this->cedula_repre) && ($edit === false)){
        throw new ModelsException('Por favor introduzca la cedula del representante');
      }

    }

        /**
     * Inserta Enfermedades elegidos en el formulario para el Nino.
     * 
     * @param int $id_producto : Id del producto
     * 
     * @return void
     */
    final private function insertNewEnfermedades(int $id) {
      # Si hay proveedores
      if(null != $this->enfermedades) {
        # Insertar de nuevo esas relaciones
        $enfermedad = $this->db->prepare("INSERT INTO nino_enfermedad_2 (id_nino,id_enfermedad,fechacontagio)
        VALUES ('$id',?,'hola');");
        foreach($this->enfermedades as $id_enfermedad){
          $enfermedad->execute(array($id_enfermedad));
        }
       $enfermedad->closeCursor();
      } 
    }


            /**
     * Inserta Juegos elegidos en el formulario para el Nino.
     * 
     * @param int $id_producto : Id del producto
     * 
     * @return void
     */
    final private function insertNewJuegos(int $id) {
      # Si hay proveedores
      if(null != $this->juegos) {
        
        # Insertar de nuevo esas relaciones
        $juegos = $this->db->prepare("INSERT INTO nino_juego_2 (id_nino,id_juego)
        VALUES ('$id',?);");
        foreach($this->juegos as $id_juego){
          $juegos->execute(array($id_juego));
        }
       $juegos->closeCursor();
      } 
    }

    final public function add(){
      try {
        global $http;

        # Controlar errores de entrada en el formulario
        $this->errors();

        $cantidad = $this->db->query_select(
          "SELECT COUNT(*) as total
           FROM nino_2
           WHERE id_padre=$this->cedula_repre;"
        );
        $cantidad = $cantidad[0]['total'];

        $abc= array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $letra = $abc[$cantidad + 1];
        $codigo = "$letra"."$this->cedula_repre";

        # Insertar elementos
        $this->db->query("INSERT INTO nino_2
        (nombre,apellido,sexo,fecha_nac,id_padre,letra, codigo_nino,id_padre2)
        VALUES ('$this->nombre','$this->apellido','$this->sexo','$this->fecha_nac',$this->cedula_repre,'$letra','$codigo',$this->cedula_repre2);");

        $id_nino = $this->db->lastInsertId();

        # Proveedores de este producto
        $this->insertNewEnfermedades($id_nino);

        # Insertar en Inventario
        $this->insertNewJuegos($id_nino);

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

        $codigo = $http->request->get('codigo');
        # Actualizar elementos
        $this->db->query("UPDATE Nino_2
        SET nombre  =  '$this->nombre', apellido = '$this->apellido', fecha_nac  =  '$this->fecha_nac', sexo = '$this->sexo'
        WHERE codigo_nino='$codigo'");

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
          $this->db->query("DELETE FROM Nino_2 WHERE codigo_nino='$codigo'");
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
