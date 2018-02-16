<?php

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
class partidosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {

    	parent::__construct($router);   
        global $config;
        
        $p = new Model\Partidos($router);
        $e = new Model\Equipos($router);
        $c = new Model\Categorias($router);


    	switch($this->method) {
          default:
            echo $this->template->render('partidos/partidos',array(
              'partidos' => $p->get(),
              'equipos' => $e->get(),
              'categorias' => $c->get()
            ));
          break;
        }
    }

}