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
 * Controlador productos/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class productosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $p = new Model\Productos($router);
        $s = new Model\Sedes();

        switch($this->method) {
          case 'eliminar':
            $p->delete();
          break;
          case 'descripcion':
          echo $this->template->render('productos/productos',array(
            'productos' => $p->get($this->method,$this->isset_id)
          ));
          break;
          case 'numero_factura':
          echo $this->template->render('productos/productos',array(
            'productos' => $p->getInt($this->method,$this->isset_id)
          ));
          break;
          case 'codigo_sede':
          echo $this->template->render('productos/productos',array(
            'productos' => $p->getInt($this->method,$this->isset_id)
          ));
          break;
          default:
            echo $this->template->render('productos/productos',array(
              'productos' => $p->get(),
              'sedes' => $s->get()
            ));
          break;
        }
    }

}