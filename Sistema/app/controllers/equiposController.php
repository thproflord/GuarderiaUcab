<?php

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
class equiposController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {

    	parent::__construct($router);   
        global $config;
        
        $e = new Model\Equipos($router);
        $j = new Model\Jugadores();
        $c = new Model\Categorias();


    	switch($this->method) {
          case 'eliminar':
            $e->delete();
          break;
          default:
            echo $this->template->render('equipos/equipos',array(
              'equipos' => $e->get(),
              'jugadores' => $j->get(),
              'categorias' => $c->get()
            ));
          break;
        }
    }

}