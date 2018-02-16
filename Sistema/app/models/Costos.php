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
 * Modelo Costos
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Costos extends Models implements IModels {
    
 /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    private $costo_3dias;
    private $costo_5dias;
    private $mensualidad;
    private $costouniforme;

    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors() {
      global $http;
      
      $this->costo_3dias = $http->request->get('costo_3dias');
      $this->costo_5dias = $http->request->get('costo_5dias');
      $this->mensualidad = $http->request->get('mensualidad');
      $this->costouniforme = $http->request->get('costouniforme');

      if($this->functions->e($this->costo_3dias)){
        throw new ModelsException('El costo del plan de tres dias es obligatorio');
      }

      if($this->functions->e($this->costo_5dias)){
        throw new ModelsException('El costo del plan de cinco dias es obligatorio');
      }

      if($this->functions->e($this->mensualidad)){
        throw new ModelsException('El costo de la mensualidad es obligatorio');
      }

      if($this->functions->e($this->costouniforme)){
        throw new ModelsException('El costo del uniforme es obligatorio');
      }


    }

    
    /** 
      * Edita un elemento de Ajustes en la tabla ``
      *
      * @return array con información para la api, un valor success y un mensaje.
    */
    final public function edit() : array {
      try {
        global $http;
        $this->errors();

        $this->db->query("UPDATE costos_4
        SET plan_3dias = $this->costo_3dias,plan_5dias = $this->costo_5dias,
        mensualidad = $this->mensualidad , costouniforme = $this->mensualidad 
        WHERE clave = 1
        ;");


        return array('success' => 1, 'message' => 'Editado con éxito.');
      } catch(ModelsException $e) {
        return array('success' => 0, 'message' => $e->getMessage());
      }
    }



    final public function get() {
      return $this->db->query_select(
      "SELECT *
      FROM costos_4
      ");
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