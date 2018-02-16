<?php


namespace app\controllers;

use app\models as Model;
use Ocrend\Kernel\Router\IRouter;
use Ocrend\Kernel\Controllers\Controllers;
use Ocrend\Kernel\Controllers\IControllers;
  
/**
 * Controlador jugadores/
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
*/
  
class jugadoresController extends Controllers implements IControllers {

    public function __construct(IRouter $router) {
        parent::__construct($router);   
        
        $j = new Model\Jugadores();
        $r = new Model\Representantes();
        $c = new Model\Categorias();
        $co = new Model\Colegios();
        $p = new Model\Posicion();

        switch($this->method) {
          case 'eliminar':
            $j->delete($this->isset_id);
          break;
          case 'id_jugador':
          echo $this->template->render('jugadores/jugadores',array(
            'jugadores' => $j->get($this->method,$this->isset_id)
          ));
          break;
          case 'nombre_categoria':
          echo $this->template->render('jugadores/jugadores',array(
            'jugadores' => $j->get($this->method,$this->isset_id)
          ));
          break;
          case 'apellido':
          echo $this->template->render('jugadores/jugadores',array(
            'jugadores' => $j->get($this->method,$this->isset_id)
          ));
          break;
          default:
            echo $this->template->render('jugadores/jugadores',array(
              'jugadores' => $j->get(),
              'categorias'=>$c->get(),
              'representantes'=>$r->get(),
              'colegios' => $co->get(),
              'posiciones' => $p->get(),
              'equipos' => $j->getEquipos()
            ));
          break;
        }

    }

}