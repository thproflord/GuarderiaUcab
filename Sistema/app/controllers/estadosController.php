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
 * Controlador estados/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class estadosController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $e = new Model\Estados($router);

        switch($this->method) {
          case 'crear':
            echo $this->template->render('estados/crear');
          break;
          case 'editar':
            if($this->isset_id and false !== ($data = $e->get(false))) {
              echo $this->template->render('estados/editar', array(
                'data' => $data[0]
              ));
            } else {
              $this->functions->redir($config['site']['url'] . 'estados/&error=true');
            }
          break;
          case 'eliminar':
            $e->delete();
          break;
          default:
            echo $this->template->render('estados/estados',array(
              'estados' => $e->get()
            ));
          break;
        }
    }

}