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
 * Controlador comidas/
 *
 * @author Ramon García, Fernando Gomes y Alexander De Azevedo <oeneikaphotos@gmail.com>
*/
  
class comidasController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   

        $c = new Model\Comidas($router);
        switch($this->method){
            case 'crear':
            echo $this->template->render('comidas/crear');
            break;
            
            case 'editar':
            echo $this->template->render('comidas/editar');
            break;
            
            case 'eliminar':
            break;

            default:
            echo $this->template->render('comidas/comidas',array(  
                'comida' => $c->get()
            ));
            break;
        }

    }

}