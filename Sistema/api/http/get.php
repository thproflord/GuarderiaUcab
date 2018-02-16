<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

use app\models as Model;

/*Trae los datos del tipo de pago dependiendo del $tipo donde se encuentren el padre y el hijo*/
$app->get('/traerpagos', function($id_p,$id_h,$tipo) use($app) {
$r = new Model\Representantes; 

return $app->json($r->getDataPagos($id_p,$id_h,$tipo));
    
});

$app->get('/asistencia/get_dias_asistidos/{id}', function($id) use($app) {
    $a = new Model\Asistencia();
    return $app->json($a->getDiasAsistidos());   
});

$app->get('/asistencia/get_horarios/{id}', function($id) use($app) {
    $h = new Model\Horarios();
    return $app->json($h->get($id));   
});

$app->get('/asistencia/get_alumnos/{dia}&{sede}', function($dia,$sede) use($app) {
    $j = new Model\Jugadores();
    return $app->json($j->getDiasInscritos($dia,$sede));    
});

$app->get('/asistencia/get_alumnos_asist/{dia}/{sede}', function($dia,$sede) use($app) {
    $a = new Model\Asistencia();
    return $app->json($a->getAlumnosAsist($dia,$sede));    
});

$app->get('/partidos/get_jugadores', function() use($app) {
    $j = new Model\Jugadores();
    return $app->json($j->get());   
});


$app->get('/partidos/get_equipos/{id}', function($id) use($app) {
    $e = new Model\Equipos();
    return $app->json($e->getByCategoria($id));   
});

$app->get('/equipos/get_jugadores/{nombre}', function($nombre) use($app) {
    $e = new Model\Equipos();
    return $app->json($e->getJugadores($nombre));   
});

$app->get('/ejercicios/getTres', function() use($app) {
    $e = new Model\Ejercicios();
    return $app->json($e->getTres());   
});

$app->get('/horarios/getTres', function() use($app) {
    $h = new Model\Horarios();
    return $app->json($h->getTres());   
});

$app->get('/planentrenamiento/getTres', function() use($app) {
    $p = new Model\Planentrenamiento();
    return $app->json($p->getTres());   
});

$app->get('/plansemanal/getTres', function() use($app) {
    $p = new Model\Plansemanal();
    return $app->json($p->getTres());   
});

$app->get('/equipos/getTres', function() use($app) {
    $e = new Model\Equipos();
    return $app->json($e->getTres());   
});

$app->get('/partidos/getTres', function() use($app) {
    $p = new Model\Partidos();
    return $app->json($p->getTres());   
});

$app->get('/estadisticas/getTopEquipos', function() use($app) {
    $e = new Model\Estadisticas();
    return $app->json($e->getTopEquipos(false));   
});

$app->get('/estadisticas/getTopEquiposPromedio', function() use($app) {
    $e = new Model\Estadisticas();
    return $app->json($e->getTopEquiposPromedio(false));   
});

$app->get('/estadisticas/getTopJugadores', function() use($app) {
    $e = new Model\Estadisticas();
    return $app->json($e->getTopJugadores(false));   
});

$app->get('/estadisticas/getTopPorteros', function() use($app) {
    $e = new Model\Estadisticas();
    return $app->json($e->getTopJugadores(false,1));   
});

/*Trae un array de hijos dependiendo del id padre que se pase por parametro*/
$app->get('/traerhijos/{id}', function($id) use($app) {
$r = new Model\Representantes;   
   
return $app->json($r->getHijos($id));
        
});


/*Trae la ultima inscripcion del id del jugador pasado por parametro*/
$app->get('/traersedeinscripcion/{id}', function($id) use($app) {
$i = new Model\Inscripciones;   
       
return $app->json($i->getByJugador($id));

});


/*Trae un array de hijos dependiendo del id padre que se pase por parametro*/
$app->get('/mensualidad/verificar/{id0}/{id1}/{id2}/{id3}', function($id0,$id1,$id2,$id3) use($app) {
$p = new Model\Pagos;   
       
return $app->json($p->checkMensualidades($id0,$id1,$id2,$id3));
            
});

/*Trae los productos*/
$app->get('/traerproductos', function() use($app) {
    $p = new Model\Productos;   
       
    return $app->json($p->get());
            
});

/*Trae los productos*/
$app->get('/traerproductos/{id}', function($id) use($app) {
    $p = new Model\Productos;   
       
    return $app->json($p->get("codigo_sede",$id));
            
});

/*Trae precio de producto*/
$app->get('/traerprecioproducto/{id}', function($id) use($app) {
    $p = new Model\Productos;   
       
    return $app->json($p->getInt("codigo_producto",$id));
            
});

/*Trae las ordenes de productos asociados al id pasado por paremetro*/
$app->get('/traerOP/{id}', function($id) use($app) {
$oc = new Model\Ordencompra;   
       
return $app->json($oc->getOP($id));
            
});

/*Trae los productos uniforme que constan de la sede pasada*/
$app->get('/traerUniformes/sedeytipo/{id}/{id2}', function($id,$id2) use($app) {
$p = new Model\Productos;   
return $app->json($p->getUniformesBy($id,$id2));
});


/**/
$app->get('/proveedores/criterios', function() use($app) {
$p = new Model\Proveedores;   
return $app->json($p->getByCriterios());
});

/**/
$app->get('/mensualidades/criterios', function() use($app) {
$m = new Model\Mensualidades;   
return $app->json($m->getByCriterios());
});

/**/
$app->get('/inscripciones/criterios', function() use($app) {
$i = new Model\Inscripciones;   
return $app->json($i->getByCriterios());
});

    
/**/
$app->get('/ventas/criterios', function() use($app) {
$v= new Model\Ventas;   
return $app->json($v->getByCriterios());
});
    
/**/
$app->get('/ordenproductos/criterios', function() use($app) {
$op= new Model\Ordenproductos;   
return $app->json($op->getByCriterios());
});

    /**/
$app->get('/ordencompra/criterios', function() use($app) {
$oc= new Model\Ordencompra;   
return $app->json($oc->getByCriterios());
});

/*Este se puede dividir en tres para cada tipo de pago*/
$app->get('/pagos/criterios', function() use($app) {
$p= new Model\Pagos;   
return $app->json($p->getByCriterios());
});
    


