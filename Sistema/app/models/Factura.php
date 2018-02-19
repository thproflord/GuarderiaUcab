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
 * Modelo Factura
 *
 * @author Ramon García, Fernando Gomes y Alexander De Azevedo <oeneikaphotos@gmail.com>
 */

class Factura extends Models implements IModels {
    

    use DBModel;
    private $id_inscripcion;
    private $semana;
    private $num_transferencia;

    final public function errors(bool $edit = false){
        global $http;
        $this->id_inscripcion = $http->request->get('id_inscripcion');
        $this->semana = $http->request->get('semana');
        $this->num_transferencia =$http->request->get('num_transferencia');

        if ($this->functins->e($this->id_inscripcion,$this->semana,$this->num_transferencia)){
            throw new ModelsException('Todos los campos son requeridos');
        }
    }
    final public function add(){
        try {
          global $http;
  
          # Controlar errores de entrada en el formulario
          $this->errors();
  
          # Insertar elementos
        
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
  
      final public function editar(){
        $this->db->update('factura_2', array(
        ),"id_comida=");
      }
  
      final public function get(bool $multi  = true, string $select = '*') {
          return $this->db->query_select("SELECT * FROM factura_2;");
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