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
 * Controlador ejercicios/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class ejerciciosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $e = new Model\Ejercicios($router);

        switch($this->method) {
          case 'crear':
            echo $this->template->render('ejercicios/crear');
          break;
          case 'editar':
            if($this->isset_id and false !== ($data = $e->get(false))) {
              echo $this->template->render('ejercicios/editar', array(
                'data' => $data[0]
              ));
            } else {
              $this->functions->redir($config['site']['url'] . 'ejercicios/&error=true');
            }
          break;
          case 'eliminar':
            $e->delete();
          break;
          default:
            echo $this->template->render('ejercicios/ejercicios',array(
              'ejercicios' => $e->get()
            ));
          break;
        }
    }

}