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
 * Controlador sedes/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/

class sedesController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);
        global $config;

        $s = new Model\Sedes($router);
        $p = new Model\Personal($router);

        switch($this->method) {
          case 'crear':
            echo $this->template->render('sedes/crear');
          break;
          case 'editar':
            echo $this->template->render('sedes/editar');
          default:
            echo $this->template->render('sedes/sedes', array(
            'sedes' => $s->get(),
            'personal' => $p->get(),
            'lugar' => $s->getL()
          ));
          break;
        }
    }

}
