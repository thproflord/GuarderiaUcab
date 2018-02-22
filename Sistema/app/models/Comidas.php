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
 * Modelo Comidas
 *
 * @author Ramon García, Fernando Gomes y Alexander De Azevedo <oeneikaphotos@gmail.com>
 */

class Comidas extends Models implements IModels {
    use DBModel;

    private $tipo;
    private $descripcion;

    final public function errors(bool $edit = false){
        global $http;
        $this->tipo = $http->request->get('tipo');
        $this->descripcion = $http->request->get('descripcion');

        if ($this->functins->e($this->tipo,$this->descripcion)){
            throw new ModelsException('Todos los campos son requeridos');
        }
    }
    final public function add(){
        try {
          global $http;
  
          # Controlar errores de entrada en el formulario
          $this->errors();
  
          # Insertar elementos
          $this->db->query("INSERT INTO comida_2
          (tipo,descripcion)
          VALUES ($this->tipo,'$this->descripcion');");
  
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
  
      final public function edit(){
        $this->db->query("UPDATE comida_2 
        SET tipo = $this->tipo,
        descripcion = '$this->descripcion'
        WHERE id_comida= $this->id_comida");
      }
  
      final public function get(bool $multi  = true, string $select = '*') {
          return $this->db->query_select("SELECT * FROM comida_2;");
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