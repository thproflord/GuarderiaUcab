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
 * Controlador ordencompra/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class ordencompraController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        $o = new Model\Ordencompra;
        $p = new Model\Proveedores;
        $s = new Model\Sedes;

        switch($this->method) {
            case 'eliminar':
              $o->delete($this->isset_id);
            break;
            default:
            echo $this->template->render('ordencompra/ordencompra',array(
                'ordenes' => $o->get(),
                'proveedores' => $p->get(),
                'sedes' => $s->get()
            ));

            break;
          }


    }

}