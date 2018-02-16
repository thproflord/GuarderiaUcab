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
 * Controlador inscripciones/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class inscripcionesController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        $i = new Model\Inscripciones;
        $j = new Model\Jugadores;
        $p = new Model\Pagos;
        $s = new Model\Sedes;

        $tres=$p->getCostos('plan_3dias')[0]["plan_3dias"];
        $cinco=$p->getCostos('plan_5dias')[0]["plan_5dias"];


        switch($this->method) {
            default:
            echo $this->template->render('inscripciones/inscripciones',array(
                'inscripciones' => $i->get(),
                'jugadores' => $j->get(),
                'dias_inscritos' => $i->getDiasInscritos(),
                'pagos_inscripciones'=>$p->getPagos('*','inscripciones'),
                'costo_3dias' => $tres,
                'costo_5dias' => $cinco,
                'sedes' => $s->get(),
                'tipo' => 2
            ));

            break;
          }


    }

}