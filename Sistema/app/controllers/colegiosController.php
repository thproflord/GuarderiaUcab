<?php

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
class colegiosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {

    	parent::__construct($router);   
        global $config;
        
        $c = new Model\Colegios($router);


    	switch($this->method) {
          case 'eliminar':
            $c->delete();
          break;
          case 'tipo':
          echo $this->template->render('colegios/colegios',array(
            'colegios' => $c->get($this->method,$this->isset_id,1)
          ));
          break;
          case 'mayor':
          echo $this->template->render('colegios/colegios',array(
            'colegios' => $c->get($this->method,$this->isset_id,2)
          ));
          break;
          case 'menor':
          echo $this->template->render('colegios/colegios',array(
            'colegios' => $c->get($this->method,$this->isset_id,3)
          ));
          break;
          default:
            echo $this->template->render('colegios/colegios',array(
              'colegios' => $c->get()
            ));
          break;
        }
    }

}