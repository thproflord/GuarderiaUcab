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
 * Controlador horarios/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/

class horariosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);
        global $config;

        $h = new Model\Horarios($router);
        $s = new Model\Sedes();
        $c = new Model\Categorias();
        echo $this->template->render('horarios/horarios');
        /*switch($this->method) {
          case 'crear':
            echo $this->template->render('horarios/crear');
          break;
          case 'editar':
            if($this->isset_id and false !== ($data = $h->get(false))) {
              echo $this->template->render('horarios/editar', array(
                'data' => $data[0]
              ));
            } else {
              $this->functions->redir($config['site']['url'] . 'horarios/&error=true');
            }
          break;
          case 'eliminar':
            $h->delete();
          break;
          default:
            echo $this->template->render('horarios/horarios',array(
              'horarios' => $h->get(),
              'sedes' => $s->get(),
              'categorias' => $c->get()
            ));
          break;
        }*/
    }

}
