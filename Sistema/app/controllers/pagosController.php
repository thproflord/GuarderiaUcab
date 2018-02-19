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
 * Controlador pagos/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/

class pagosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);
        $p = new Model\Pagos;
        $v = new Model\Ventas;
        $r = new Model\Representantes;
       
        switch($this->method) {
            default:
              echo $this->template->render('pagos/pagos',array(
                  'mensualidades' => $p->getPagos()
              ));
            break;
            case 'actividades':
                echo $this->template->render('pagos/actividades');
            break;
            case 'pagoshoras':
                echo $this->template->render('pagos/pagoshoras');
            break;
            case 'multas':
                echo $this->template->render('pagos/multas');
            break;
            case 'menu':
                echo $this->template->render('pagos/menu');
            break;
            case 'factura':
                echo $this->template->render('pagos/factura');

        }

    }

}
