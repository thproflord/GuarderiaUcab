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
 * Modelo Notas
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Notas extends Models implements IModels {
         
/**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;
    
    private $año_ini;
    private $año_fin;
    private $promedio;
    private $lapso;
    private $cedula_jugador;

            
            /**
              * Controla los errores de entrada del formulario
              *
              * @throws ModelsException
            */
            final private function errors(bool $edit = false) {
              global $http;
    
              $this->año_ini = $http->request->get('año_ini');
              $this->año_fin = $http->request->get('año_fin');
              $this->promedio = $http->request->get('promedio');
              $this->lapso = $http->request->get('lapso');
              $this->cedula_jugador = $http->request->get('cedula_jugador');
    
    
        
              if($this->functions->e($this->año_ini)){
                throw new ModelsException('El campo año_ini es obligatorio');
              }
              if($this->functions->e($this->año_fin)){
                throw new ModelsException('El campo año_fin es obligatorio');
              }
              if($this->functions->e($this->promedio)){
                throw new ModelsException('El campo promedio es obligatorio');
              }
              if($this->functions->e($this->lapso)){
                throw new ModelsException('El campo lapso es obligatorio');
              }
              if($this->functions->e($this->cedula_jugador)){
                throw new ModelsException('El campo cedula_jugador es obligatorio');
              }
    
              $cedula_exist = $this->db->query_select("SELECT * FROM records_academicos_4 WHERE cedula_jugador = '$this->cedula_jugador'");
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
                $this->db->query("INSERT INTO records_academicos_4
                (anio_ini_record,anio_fin_record,promedio,lapso,cedula_jugador)
                VALUES ('$this->año_ini','$this->año_fin','$this->promedio','$this->lapso','$this->cedula_jugador');");
        
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
                $this->db->query("UPDATE records_academicos_4
                SET anio_ini_record = '$this->año_ini', anio_fin_record = '$this->año_fin', promedio ='$this->promedio',
                lapso = '$this->lapso'
                WHERE cedula_jugador = '$this->cedula_jugador'");
        
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
              $this->db->query("DELETE FROM records_academicos_4 WHERE cedula_jugador = '$id'");
              # Redireccionar a la página principal del controlador
              $this->functions->redir($config['site']['url'] . 'notas/&success=true');
            }
        


            /**
          * Obtiene elementos de Personal en la tabla ``
          *
          * @param bool $multi: true si se quiere obtener un listado total de los elementos 
          *                     false si se quiere obtener un único elemento según su id_
          * @param string $select: Elementos de  a seleccionar
          *
          * @return false|array: false si no hay datos.
          *                      array con los datos.
        */
        final public function get(string $criterio="-",$select = '*') {
          /*Busqueda general*/
          if($criterio=="-"){
           return $this->db->query_select("SELECT *
                                          FROM records_academicos_4;");
       }
        /*Busqueda personalizada*/
       else{
         return $this->db->query_select("SELECT *
                                        FROM records_academicos_4
                                        WHERE $criterio='$select';");
       }
       }

       final public function getint(string $criterio="-",$select){

          /*Busqueda general*/
          if($criterio=="-"){
           return $this->db->query_select("SELECT *
                                          FROM records_academicos_4;");
       }
        /*Busqueda personalizada*/
       else{
         return $this->db->query_select("SELECT *
                                        FROM records_academicos_4
                                        WHERE $criterio=$select;");
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