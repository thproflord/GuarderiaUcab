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
 * Modelo Colores
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Colores extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $anio_ini;
    private $anio_fin;
    private $color_short;
    private $color_camisa;
    private $uniforme;
    private $tipo;

    
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      $this->anio_ini = $http->request->get('anio_ini');
      $this->anio_fin = $http->request->get('anio_fin');
      $this->color_short = $http->request->get('color_short');
      $this->color_camisa = $http->request->get('color_camisa');
      $this->uniforme = $http->request->get('uniforme');
      $this->tipo = $http->request->get('tipo');

      if($this->functions->e($this->anio_ini,$this->anio_fin,$this->color_short,$this->color_camisa,$this->uniforme,$this->tipo)){
        throw new ModelsException('Todos los campos son obligatorios!');
      }
      # throw new ModelsException('¡Esto es un error!');
    }

    /** 
      * Crea un elemento de Colores en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function add() {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Insertar elementos
        $this->db->query("INSERT INTO colores_4
        (anio_ini_color,anio_fin_color,color_short,color_camisa,codigo_producto,tipo)
        VALUES ($this->anio_ini,$this->anio_fin, '$this->color_short', '$this->color_camisa', $this->uniforme,$this->tipo);");

        return array('success' => 1, 'message' => 'Creado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }
          
    /** 
      * Edita un elemento de Colores en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;
                  
        # Controlar errores de entrada en el formulario
        $this->errors();

        # Actualizar elementos
        $this->db->query("UPDATE colores_4
        SET color_short = '$this->color_short', color_camisa = '$this->color_camisa', tipo = $this->tipo
        WHERE anio_ini_color = $this->anio_ini AND anio_fin_color = $this->anio_fin AND codigo_producto = $this->uniforme");

        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }

    /** 
      * Borra un elemento de Colores en la tabla ``
      * y luego redirecciona a colores/&success=true
      *
      * @return void
    */
    final public function delete() {
      global $config;
      # Borrar el elemento de la base de datos
      $this->db->query("DELETE FROM colores_4 WHERE id_color = $this->id");
      # Redireccionar a la página principal del controlador
      $this->functions->redir($config['site']['url'] . 'colores/&success=true');
    }

  /**
      * Obtiene elementos de la tabla "Colores"
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
      return $this->db->query_select("SELECT colores_4.*, sedes_4.nombre
      FROM colores_4
      INNER JOIN productos_4 ON colores_4.codigo_producto = productos_4.codigo_producto
      INNER JOIN sedes_4 ON productos_4.codigo_sede = sedes_4.codigo_sede;");
    }
      /*Busqueda personalizada*/
    return $this->db->query_select("SELECT * FROM colores_4  WHERE $criterio='$select';");
    }

    /**
      * Obtiene elementos de la tabla "Colores"
      *
      * @param string $criterio: si el parametro es pasado entonces se realiza una busqueda personalizada
      *
      * @param $select: Elementos de a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                      array con los datos.
      */
    final public function getInt(string $criterio="-" ,$select = '*') {

      /*Busqueda personalizada*/
    return $this->db->query_select("SELECT * FROM colores_4  WHERE $criterio=$select;");
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