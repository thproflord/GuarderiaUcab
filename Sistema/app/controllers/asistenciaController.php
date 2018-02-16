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
 * Controlador asistencia/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class asistenciaController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $a = new Model\Asistencia($router);
        $s = new Model\Sedes();

        switch($this->method) {
          case 'eliminar':
            $a->delete();
          break;
          case 'crear':
          echo $this->template->render('asistencia/crear', array(
            'sedes' => $s->get()
          ));
          break;
          default:
            echo $this->template->render('asistencia/asistencia', array(
              'sedes' => $s->get()
            ));
          break;
        }
    }

}