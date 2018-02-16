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
 * Controlador notas/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class notasController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        $n = new Model\Notas;
        $j = new Model\Jugadores();

		switch($this->method) {
            case 'eliminar':
              $n->delete($this->isset_id);
            break;
            case 'anio_ini_record':
            echo $this->template->render('notas/notas',array(
              'notas' => $n->getint($this->method,$this->isset_id)
            ));
            break;
            case 'promedio':
            echo $this->template->render('notas/notas',array(
              'notas' => $n->getint($this->method,$this->isset_id)
            ));
            break;
            case 'cedula_jugador':
            echo $this->template->render('notas/notas',array(
              'notas' => $n->get($this->method,$this->isset_id)
            ));
            break;
            default:
              echo $this->template->render('notas/notas',array(
                'notas' => $n->get(),
                'jugadores' => $j->get()
              ));
            break;
          }

    }

}