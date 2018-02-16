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
            case 'eliminar':
              $p->delete($this->isset_id);
            break;
            case 'uniformes':
                echo $this->template->render('pagos/pagos',array(
                    'pagosuni' => $p->getPagos('*','uniformes'),
                    'tipopago' => 0,
                ));
            break;
            break;
            case 'mensualidades':
                echo $this->template->render('pagos/pagos',array(
                    'pagosmen' => $p->getPagos('*','mensualidades'),
                    'tipopago' => 1,
                ));
            break;
            case 'inscripciones':
                echo $this->template->render('pagos/pagos',array(
                    'pagosin' => $p->getPagos('*','inscripciones'),
                    'tipopago' => 2,
                ));
            break;
            default:
            echo $this->template->render('pagos/pagos',array(
                'pagos' => $p->get()
            ));

            break;
          }


    }

}