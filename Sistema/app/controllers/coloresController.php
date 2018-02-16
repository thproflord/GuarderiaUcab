<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
/**
 * Controlador colores/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class coloresController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $c = new Model\Colores($router);
        $p = new Model\Productos();

        switch($this->method) {
          case 'eliminar':
            $c->delete();
          break;
          case 'anio_ini_color':
          echo $this->template->render('colores/colores',array(
            'colores' => $c->getInt($this->method,$this->isset_id)
          ));
          break;
          case 'tipo':
          echo $this->template->render('colores/colores',array(
            'colores' => $c->getInt($this->method,$this->isset_id)
          ));
          break;
          case 'color_camisa':
          echo $this->template->render('colores/colores',array(
            'colores' => $c->get($this->method,$this->isset_id)
          ));
          break;
          default:
            echo $this->template->render('colores/colores',array(
              'colores' => $c->get(),
              'uniformes'=> $p->getUniformes()
            ));
          break;
        }
    }

}