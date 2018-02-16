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
 * Controlador planentrenamiento/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class planentrenamientoController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $p = new Model\Planentrenamiento($router);
        $pe = new Model\Personal();
        $h = new Model\Horarios();

        switch($this->method) {
          case 'crear':
            echo $this->template->render('planentrenamiento/crear');
          break;
          case 'editar':
            if($this->isset_id and false !== ($data = $p->get(false))) {
              echo $this->template->render('planentrenamiento/editar', array(
                'data' => $data[0]
              ));
            } else {
              $this->functions->redir($config['site']['url'] . 'planentrenamiento/&error=true');
            }
          break;
          case 'eliminar':
            $p->delete();
          break;
          default:
            echo $this->template->render('planentrenamiento/planentrenamiento',array(
              'planentrenamiento' => $p->get(),
              'entrenadores' => $pe->getEntrenadores(),
              'horarios' => $h->get(),
            ));
          break;
        }
    }

}