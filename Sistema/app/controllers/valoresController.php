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
 * Controlador valores/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class valoresController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        $v = new Model\Valores;
        $j = new Model\Jugadores();
        
        switch($this->method) {
            case 'eliminar':
              $v->delete($this->isset_id);
            break;
            case 'peso':
            echo $this->template->render('valores/valores',array(
              'valores' => $v->getint($this->method,$this->isset_id)
            ));
            break;
            case 'talla':
            echo $this->template->render('valores/valores',array(
              'valores' => $v->getint($this->method,$this->isset_id)
            ));
            break;
            case 'id_jugador':
            echo $this->template->render('valores/valores',array(
              'valores' => $v->get($this->method,$this->isset_id)
            ));
            break;
            default:
              echo $this->template->render('valores/valores',array(
                'valores' => $v->get(),
                'jugadores' => $j->get()
              ));
            break;
          }

    }

}