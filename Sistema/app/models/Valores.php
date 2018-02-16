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
 * Modelo Valores
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Valores extends Models implements IModels {
    
/**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;
    
        private $peso;
        private $talla;
        private $imc; //innecesario
        private $flexiones_x_minuto;
        private $ab_x5_min;
        private $tiempo_200m;
        private $tiempo_600m;
        private $tiempo_1k;
        private $id_jugador;

        
        /**
          * Controla los errores de entrada del formulario
          *
          * @throws ModelsException
        */
        final private function errors(bool $edit = false) {
          global $http;

          $this->id_jugador = $http->request->get('id_jugador');
          $this->peso = $http->request->get('peso');
          $this->talla = $http->request->get('talla');
          $this->imc = $http->request->get('imc');
          $this->flexiones_x_minuto = $http->request->get('flexiones_x_minuto');
          $this->ab_x5_min = $http->request->get('ab_x5_min');
          $this->tiempo_200m = $http->request->get('tiempo_200m');
          $this->tiempo_600m = $http->request->get('tiempo_600m');
          $this->tiempo_1k = $http->request->get('tiempo_1k');
    
          if($this->functions->e($this->peso)){
            throw new ModelsException('El campo peso es obligatorio');
          }
          if($this->functions->e($this->talla)){
            throw new ModelsException('El talla apellido es obligatorio');
          }
          if($this->functions->e($this->imc)){
            throw new ModelsException('El campo imc es obligatorio');
          }
          if($this->functions->e($this->flexiones_x_minuto)){
            throw new ModelsException('El campo flexiones_x_minuto es obligatorio');
          }
          if($this->functions->e($this->ab_x5_min)){
            throw new ModelsException('El campo ab_x5_min es obligatorio');
          }
          if($this->functions->e($this->tiempo_200m)){
            throw new ModelsException('El campo tiempo_200m es obligatorio');
          }
          if($this->functions->e($this->tiempo_600m)){
            throw new ModelsException('El campo tiempo_600m es obligatorio');
          }
          if($this->functions->e($this->tiempo_1k)){
            throw new ModelsException('El campo tiempo_1k es obligatorio');
          }
    
          $cedula_exist = $this->db->query_select("SELECT * FROM datos_4 WHERE id_jugador = '$this->id_jugador'");
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
            $this->db->query("INSERT INTO datos_4
            (id_jugador,peso,talla,imc,flexiones_x_minuto,ab_x5_min,tiempo_200m,tiempo_600m,tiempo_1km)
            VALUES ('$this->id_jugador','$this->peso','$this->talla','$this->imc',$this->flexiones_x_minuto,$this->ab_x5_min,
            $this->tiempo_200m,'$this->tiempo_600m',$this->tiempo_1k);");
    
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
            $this->db->query("UPDATE datos_4
            SET talla = '$this->talla', peso = '$this->peso', imc ='$this->imc',
            flexiones_x_minuto = '$this->flexiones_x_minuto', ab_x5_min = '$this->ab_x5_min', tiempo_200m = '$this->tiempo_200m',
            tiempo_600m = '$this->tiempo_600m', tiempo_1km = '$this->tiempo_1k'
            WHERE id_jugador = '$this->id_jugador'");
    
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
          $this->db->query("DELETE FROM datos_4 WHERE id_jugador = '$id'");
          # Redireccionar a la página principal del controlador
          $this->functions->redir($config['site']['url'] . 'valores/&success=true');
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
                                          FROM datos_4;");
       }
        /*Busqueda personalizada*/
       else{
         return $this->db->query_select("SELECT *
                                        FROM datos_4
                                        WHERE $criterio='$select';");
       }
       }

       final public function getint(string $criterio="-",$select){

          /*Busqueda general*/
          if($criterio=="-"){
           return $this->db->query_select("SELECT *
                                          FROM datos_4;");
       }
        /*Busqueda personalizada*/
       else{
         return $this->db->query_select("SELECT *
                                        FROM datos_4
                                        WHERE $criterio=$select;");
       }
        
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