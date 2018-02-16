<?php

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
class lugaresController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {

    	parent::__construct($router);   
        global $config;
        
        $l = new Model\Lugares($router);
        $e = new Model\Estados();


    	switch($this->method) {
          case 'eliminar':
            $l->delete();
          break;
          case 'nombrec':
          echo $this->template->render('lugares/lugares',array(
            'lugares' => $l->get("nombre",$this->isset_id,0)
          ));
          break;
          case 'nombrel':
          echo $this->template->render('lugares/lugares',array(
            'lugares' => $l->get("nombre",$this->isset_id,1)
          ));
          break;
          case 'nombre':
          echo $this->template->render('lugares/lugares',array(
            'lugares' => $l->getBySede($this->method,$this->isset_id)
          ));
          break;
          default:
            echo $this->template->render('lugares/lugares',array(
              'lugares' => $l->get(),
              'estados' => $e->get()
            ));
          break;
        }
    }

}