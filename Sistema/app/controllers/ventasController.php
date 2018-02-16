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
 * Controlador ventas/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class ventasController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        $v = new Model\Ventas;
        $r = new Model\Representantes;
        $p = new Model\Pagos;
        $s = new Model\Sedes;


        $costo = $p->getCostos("costouniforme")[0]["costouniforme"];
        switch($this->method) {
            default:
            echo $this->template->render('ventas/ventas',array(
                'ventas' => $v->get(),
                'representantes' => $r->get(),
                'pagos_por_facturas' => $p->getPagoVentasByFactura(),
                'costo_uniforme' => $costo,
                'sedes' => $s->get(),
                'tipo' => 0
            ));

            break;
          }
    }

}