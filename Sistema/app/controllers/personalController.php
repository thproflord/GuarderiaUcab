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
 * Controlador personal/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class personalController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $p = new Model\Personal($router);

        switch($this->method) {
          case 'eliminar':
            $p->delete();
          break;
          case 'fecha_nacimiento':
          echo $this->template->render('personal/personal',array(
            'personal' => $p->getFnac($this->method,$this->isset_id)
          ));
          break;
          case 'nacionalidad':
          echo $this->template->render('personal/personal',array(
            'personal' => $p->get($this->method,$this->isset_id)
          ));
          break;
          case 'sexo':
          echo $this->template->render('personal/personal',array(
            'personal' => $p->get($this->method,$this->isset_id)
          ));
          break;
          default:
            echo $this->template->render('personal/personal',array(
              'personal' => $p->get()
            ));
          break;
        }
    }

}