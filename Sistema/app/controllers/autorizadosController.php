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
 * Controlador representantes/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/

class autorizadosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);
        $r = new Model\Autorizados;

        /*switch($this->method) {
            case 'eliminar':
              $r->delete($this->isset_id);
            break;
            case 'cedula_representante':
            echo $this->template->render('representantes/representantes',array(
              'representantes' => $r->get($this->method,$this->isset_id)
            ));
            break;
            case 'nombre':
            echo $this->template->render('representantes/representantes',array(
              'representantes' => $r->get($this->method,$this->isset_id)
            ));
            break;
            case 'sexo':
            echo $this->template->render('representantes/representantes',array(
              'representantes' => $r->get($this->method,$this->isset_id)
            ));
            break;
            default:
              echo $this->template->render('representantes/representantes',array(
                'representantes' => $r->get()
              ));
            break;
          }
          */
        echo $this->template->render('autorizados/autorizados');
    }

}
