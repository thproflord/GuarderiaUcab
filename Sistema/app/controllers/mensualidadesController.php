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
 * Controlador mensualidades/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class mensualidadesController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        $m = new Model\Mensualidades;
        $r = new Model\Representantes;
        $p = new Model\Pagos;
        $costo=$p->getCostos('mensualidad')[0]["mensualidad"];
        
        switch($this->method) {
            default:
            echo $this->template->render('mensualidades/mensualidades',array(
                'mensualidades' => $m->get(),
                'representantes' => $r->get(),
                'pagos_por_codigo' => $p->getPagoMensualidadesByCodigo(),
                'costo_mensualidad' => $costo,
                'tipo' => 1
            ));

            break;
          }

    }

}