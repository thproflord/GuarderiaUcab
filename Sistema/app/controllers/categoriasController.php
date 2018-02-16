<?php

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
class categoriasController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {

    	parent::__construct($router);   
        global $config;
        
        $c = new Model\Categorias($router);


    	switch($this->method) {
          case 'eliminar':
            $c->delete($this->isset_id);
          break;
          case 'nombre_categoria':
          echo $this->template->render('categorias/categorias',array(
            'categorias' => $c->get($this->method,$this->isset_id,1)
          ));
          break;
          case 'año_nacimiento':
          echo $this->template->render('categorias/categorias',array(
            'categorias' => $c->get($this->method,$this->isset_id,2)
          ));
          break;
          case 'alumno':
          echo $this->template->render('categorias/categorias',array(
            'categorias' => $c->get("nombre",$this->isset_id,3)
          ));
          break;
          default:
            echo $this->template->render('categorias/categorias',array(
              'categorias' => $c->get(),
            ));
          break;
        }
    }

}