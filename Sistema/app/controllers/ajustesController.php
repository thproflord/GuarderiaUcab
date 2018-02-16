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
 * Controlador ajustes/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class ajustesController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        global $config;
        
        $a = new Model\Ajustes($router);

        switch($this->method) {
          case 'crear':
            echo $this->template->render('ajustes/crear');
          break;
          case 'editar':
            if($this->isset_id and false !== ($data = $a->get(false))) {
              echo $this->template->render('ajustes/editar', array(
                'data' => $data[0]
              ));
            } else {
              $this->functions->redir($config['site']['url'] . 'ajustes/&error=true');
            }
          break;
          case 'eliminar':
            $a->delete();
          break;
          default:
            echo $this->template->render('ajustes/ajustes',array(
              'ajustes' => $a->get()
            ));
          break;
        }
    }

}