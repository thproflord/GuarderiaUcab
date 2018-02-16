<?php

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
class posicionController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {

    	parent::__construct($router);   
        global $config;
        
        $p = new Model\Posicion($router);


    	switch($this->method) {
          case 'eliminar':
            $p->delete();
          break;
          case 'descripcion':
          echo $this->template->render('posicion/posicion',array(
            'posicion' => $p->get($this->method,$this->isset_id,1)
          ));
          break;
          case 'posicion':
          echo $this->template->render('posicion/posicion',array(
            'posicion' => $p->get($this->method,$this->isset_id,2)
          ));
          break;
          case 'menor':
          echo $this->template->render('posicion/posicion',array(
            'posicion' => $p->get($this->method,$this->isset_id,3)
          ));
          break;
          default:
            echo $this->template->render('posicion/posicion',array(
              'posicion' => $p->get()
            ));
          break;
        }
    }

}