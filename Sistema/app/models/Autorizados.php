<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;

/**
 * Modelo Representantes
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Autorizados extends Models implements IModels {
    
/**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

        private $cedula;
        private $nombre;
        private $apellido;
        private $tlf;

        
        /**
          * Controla los errores de entrada del formulario
          *
          * @throws ModelsException
        */
        final private function errors(bool $edit = false) {
          global $http;

          $this->cedula = $http->request->get('cedula');
          $this->nombre = $http->request->get('nombre');
          $this->apellido = $http->request->get('apellido');
          $this->tlf = $http->request->get('tlf');


    
          if($this->functions->e($this->nombre)){
            throw new ModelsException('El campo nombre es obligatorio');
          }
          if($this->functions->e($this->apellido)){
            throw new ModelsException('El campo apellido es obligatorio');
          }
          if($this->functions->e($this->cedula)){
            throw new ModelsException('El campo cedula es obligatorio');
          }
          if($this->functions->e($this->telefono)){
            throw new ModelsException('El campo telefono es obligatorio');
          }
  
          $cedula_exist = $this->db->query_select("SELECT * FROM representantes_4 WHERE cedula_representante = '$this->cedula'");
          if(false!==$cedula_exist && !$edit){
            throw new ModelsException('El numero de cedula ya existe');
          }
    
         // throw new ModelsException('¡Esto es un error!');
        }
    
        /** 
          * Crea un elemento de Personal en la tabla ``
          *
          * @return array con información para la api, un valor success y un mensaje.
        */
        final public function add() {
          try {
            global $http;
                      
            # Controlar errores de entrada en el formulario
            $this->errors();
    

            # Insertar elementos
            $this->db->query("INSERT INTO representantes_4
            (nombre,apellido,cedula_representante,direccion,telefono_casa,telefono_oficina,telefono_celular,profesion,parentesco,sexo)
            VALUES ('$this->nombre','$this->apellido','$this->cedula','$this->direccion','$this->tlf_casa','$this->tlf_oficina',
            '$this->tlf_celular','$this->profesion','$this->parentesco','$this->sexo');");
    
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
            $this->db->query("UPDATE representantes_4
            SET nombre = '$this->nombre', apellido = '$this->apellido', telefono_casa ='$this->tlf_casa',
            telefono_oficina = '$this->tlf_oficina', telefono_celular = '$this->tlf_celular', direccion = '$this->direccion',
            profesion = '$this->profesion', parentesco = '$this->parentesco',sexo = '$this->sexo'
            WHERE cedula_representante = '$this->cedula'");
    
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
          $this->db->query("DELETE FROM representantes_4 WHERE cedula_representante = '$id'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'representantes/&success=true');
        }
    
      /**
      * Obtiene elementos de la tabla "Representantes"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function get(string $criterio="-" ,$select = '*') {

    /*Busqueda general*/
      if($criterio=="-"){
      return $this->db->query_select("SELECT * FROM representantes_4;");
    }
      /*Busqueda personalizada*/
    return $this->db->query_select("SELECT * FROM representantes_4  WHERE $criterio='$select';");
    }
    

      final public function getHijos(string $id){

        return $this->db->query_select(
          "SELECT j4.nombre AS nombre, j4.apellido AS apellido , j4.id_jugador AS id_jugador
           FROM representantes_4 r4
           INNER JOIN jugadores_4 j4 ON j4.cedula_representante=r4.cedula_representante
           WHERE r4.cedula_representante='$id';"
        );

      }


      /**
      */
      final public function getDataPagos(int $padre,string $hijo,int $tipo) {

          /*Trae las facturas pendientes para pagar*/
          if($tipo==0){
            return $this->db->query_select(
              "SELECT f4.numero_factura , f4.monto_pago
               FROM facturas_4 f4
               WHERE p4.cedula_representante=$padre AND p4.id_jugador='$hijo';"
            );
          }else

          /*Trae las mensualidades pendientes para pagar*/
          if($tipo==0){
            return $this->db->query_select(
              "SELECT p4.codigo_mensualidad , p4.monto_pago
               FROM mensualidades_4 m4
               WHERE p4.cedula_representante=$padre AND p4.id_jugador='$hijo';"
            );          
          }else

          /*Trae las inscripciones pendientes para pagar*/ 
          {
            return $this->db->query_select(
              "SELECT p4.anio_ini , p4.anio_fin , p4.monto_pago
               FROM inscripciones_4 i4
               WHERE p4.cedula_representante=$padre AND p4.id_jugador='$hijo';"
            );
          }
       
        }
        

    // Contenido del modelo... 


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