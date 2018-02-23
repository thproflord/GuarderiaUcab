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
 * Controlador ninos/
 *
 * @author Ramon García, Fernando Gomes y Alexander De Azevedo <oeneikaphotos@gmail.com>
*/
  
class ninosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
      parent::__construct($router);  
      global $config; 
      $r = new Model\Ninos($router);
      $c = new Model\Representantes();
      $j = new Model\Juegos();
      $e = new Model\Enfermedades();
      $a = new Model\Alergias();
      $m = new Model\Medicinas();
      $z = new Model\Autorizados();
      switch ($this->method) {
        case 'eliminar':
          $r->delete($this->isset_id);
        break;
        default:
          echo $this->template->render('ninos/ninos',array(
          'Ninos' => $r->get(),
          'juegos' => $j->get(),
          'enfermedades' => $e->get(),
          'alergias' => $a->get(),
          'medicinas' => $m->get(),
          'autorizado' => $z->get(),
          'representante' => $c->get()
          ));
          break;
      }

    }

}