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

/**
    * Inicio de sesión
    *
    * @return json
*/
$app->post('/login', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->login());
});

/**
    * Registro de un usuario
    *
    * @return json
*/
$app->post('/register', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->register());
});

/**
    * Recuperar contraseña perdida
    *
    * @return json
*/
$app->post('/lostpass', function() use($app) {
    $u = new Model\Users;

    return $app->json($u->lostpass());
});

/**
  * Acción vía ajax de Jugadores en api/jugadores/crear
  *
  * @return json
*/
$app->post('/jugadores/crear', function() use($app) {
  $j = new Model\Jugadores;

  return $app->json($j->add());
});


/**
  * Acción vía ajax de Jugadores en api/jugadores/editar
  *
  * @return json
*/
$app->post('/jugadores/editar', function() use($app) {
  $j = new Model\Jugadores;

  return $app->json($j->edit());
});

/**
  * Acción vía ajax de Actividades en api/actividades/crear
  *
  * @return json
*/
$app->post('/actividades/crear', function() use($app) {
  $j = new Model\Actividades;

  return $app->json($j->add());
});


/**
  * Acción vía ajax de Actividades en api/actividades/editar
  *
  * @return json
*/
$app->post('/actividades/editar', function() use($app) {
  $j = new Model\Actividades;

  return $app->json($j->edit());
});

/**
  * Acción vía ajax de Valores en api/valores/crear
  *
  * @return json
*/
$app->post('/valores/crear', function() use($app) {
  $v = new Model\Valores;

  return $app->json($v->add());
});


/**
  * Acción vía ajax de Valores en api/valores/editar
  *
  * @return json
*/
$app->post('/valores/editar', function() use($app) {
  $v = new Model\Valores;

  return $app->json($v->edit());
});

/**
  * Acción vía ajax de Notas en api/notas/crear
  *
  * @return json
*/
$app->post('/notas/crear', function() use($app) {
  $n = new Model\Notas;

  return $app->json($n->add());
});


/**
  * Acción vía ajax de Notas en api/notas/editar
  *
  * @return json
*/
$app->post('/notas/editar', function() use($app) {
  $n = new Model\Notas;

  return $app->json($n->edit());
});


/**
  * Acción vía ajax de Representantes en api/representantes/crear
  *
  * @return json
*/
$app->post('/representantes/crear', function() use($app) {
  $r = new Model\Representantes;

  return $app->json($r->add());
});


/**
  * Acción vía ajax de Representantes en api/representantes/editar
  *
  * @return json
*/
$app->post('/representantes/editar', function() use($app) {
  $r = new Model\Representantes;

  return $app->json($r->edit());
});

/**
  * Acción vía ajax de Juegos en api/Juegos/crear
  *
  * @return json
*/
$app->post('/juegos/crear', function() use($app) {
  $r = new Model\Juegos;

  return $app->json($r->add());
});


/**
  * Acción vía ajax de Juegos en api/Juegos/editar
  *
  * @return json
*/
$app->post('/juegos/editar', function() use($app) {
  $r = new Model\Juegos;

  return $app->json($r->edit());
});

/**
  * Acción vía ajax de Niños en api/ninos/crear
  *
  * @return json
*/
$app->post('/ninos/crear', function() use($app) {
  $r = new Model\Ninos;

  return $app->json($r->add());
});


/**
  * Acción vía ajax de Representantes en api/Ninos/editar
  *
  * @return json
*/
$app->post('/ninos/editar', function() use($app) {
  $r = new Model\Ninos;

  return $app->json($r->edit());
});

/**
  * Acción vía ajax de Autorizados en api/autorizados/crear
  *
  * @return json
*/
$app->post('/autorizados/crear', function() use($app) {
  $r = new Model\Autorizados;

  return $app->json($r->add());
});


/**
  * Acción vía ajax de Autorizados en api/autorizados/editar
  *
  * @return json
*/
$app->post('/autorizados/editar', function() use($app) {
  $r = new Model\Autorizados;

  return $app->json($r->edit());
});


/**
  * Acción vía ajax de Pediatras en api/pediatras/crear
  *
  * @return json
*/
$app->post('/pediatras/crear', function() use($app) {
  $r = new Model\Pediatras;

  return $app->json($r->add());
});


/**
  * Acción vía ajax de Pediatras en api/pediatras/editar
  *
  * @return json
*/
$app->post('/pediatras/editar', function() use($app) {
  $r = new Model\Pediatras;

  return $app->json($r->edit());
});


/**
  * Acción vía ajax de Niños en api/medicinas/crear
  *
  * @return json
*/
$app->post('/medicinas/crear', function() use($app) {
  $r = new Model\Medicinas;

  return $app->json($r->add());
});


/**
  * Acción vía ajax de Representantes en api/medicinas/editar
  *
  * @return json
*/
$app->post('/medicinas/editar', function() use($app) {
  $r = new Model\Medicinas;

  return $app->json($r->edit());
});

/**
  * Acción vía ajax de Personal en api/personal/crear
  *
  * @return json
*/
$app->post('/personal/crear', function() use($app) {
  $p = new Model\Personal;

  return $app->json($p->add());
});


/**
  * Acción vía ajax de Personal en api/personal/editar
  *
  * @return json
*/
$app->post('/personal/editar', function() use($app) {
  $p = new Model\Personal;

  return $app->json($p->edit());
});


/**
  * Acción vía ajax de Sedes en api/sedes/crear
  *
  * @return json
*/
$app->post('/sedes/crear', function() use($app) {
  $s = new Model\Sedes;

  return $app->json($s->add());
});


/**
  * Acción vía ajax de Sedes en api/sedes/editar
  *
  * @return json
*/
$app->post('/sedes/editar', function() use($app) {
  $s = new Model\Sedes;

  return $app->json($s->edit());
});


/**
  * Acción vía ajax de Productos en api/productos/crear
  *
  * @return json
*/
$app->post('/productos/crear', function() use($app) {
  $p = new Model\Productos;

  return $app->json($p->add());
});

$app->post('/colegios/crear', function() use($app) {
  $p = new Model\Colegios;

  return $app->json($p->add());
});


/**
  * Acción vía ajax de Productos en api/productos/editar
  *
  * @return json
*/
$app->post('/productos/editar', function() use($app) {
  $p = new Model\Productos;

  return $app->json($p->edit());
});
$app->post('/colegios/editar', function() use($app) {
  $p = new Model\Colegios;

  return $app->json($p->edit());
});

$app->post('/posicion/crear', function() use($app) {
  $p = new Model\Posicion;

  return $app->json($p->add());
});

$app->post('/posicion/editar', function() use($app) {
  $p = new Model\Posicion;

  return $app->json($p->edit());
});


/**
  * Acción vía ajax de Colores en api/colores/crear
  *
  * @return json
*/
$app->post('/colores/crear', function() use($app) {
  $c = new Model\Colores;

  return $app->json($c->add());
});


/**
  * Acción vía ajax de Colores en api/colores/editar
  *
  * @return json
*/
$app->post('/colores/editar', function() use($app) {
  $c = new Model\Colores;

  return $app->json($c->edit());
});


$app->post('/categorias/crear', function() use($app) {
  $p = new Model\Categorias;

  return $app->json($p->add());
});

$app->post('/categorias/editar', function() use($app) {
  $p = new Model\Categorias;

  return $app->json($p->edit());
});

$app->post('/lugares/crear', function() use($app) {
  $p = new Model\Lugares;

  return $app->json($p->add());
});

$app->post('/lugares/editar', function() use($app) {
  $p = new Model\Lugares;

  return $app->json($p->edit());
});


/**
  * Acción vía ajax de Ajustes en api/ajustes/crear
  *
  * @return json
*/
$app->post('/ajustes/crear', function() use($app) {
  $a = new Model\Ajustes;

  return $app->json($a->add());
});

/**
  * Acción vía ajax de Ajustes en api/ajustes/crear
  *
  * @return json
*/
$app->post('/ajustes/dañado', function() use($app) {
  $a = new Model\Ajustes;

  return $app->json($a->dañado());
});


/**
  * Acción vía ajax de Ajustes en api/ajustes/editar
  *
  * @return json
*/
$app->post('/ajustes/editar', function() use($app) {
  $a = new Model\Ajustes;

  return $app->json($a->edit());
});


/**
  * Acción vía ajax de Estados en api/estados/crear
  *
  * @return json
*/
$app->post('/estados/crear', function() use($app) {
  $e = new Model\Estados;

  return $app->json($e->add());
});


/**
  * Acción vía ajax de Estados en api/estados/editar
  *
  * @return json
*/
$app->post('/estados/editar', function() use($app) {
  $e = new Model\Estados;

  return $app->json($e->edit());
});


/**
  * Acción vía ajax de Ejercicios en api/ejercicios/crear
  *
  * @return json
*/
$app->post('/ejercicios/crear', function() use($app) {
  $e = new Model\Ejercicios;

  return $app->json($e->add());
});


/**
  * Acción vía ajax de Ejercicios en api/ejercicios/editar
  *
  * @return json
*/
$app->post('/ejercicios/editar', function() use($app) {
  $e = new Model\Ejercicios;

  return $app->json($e->edit());
});


/**
  * Acción vía ajax de Horarios en api/horarios/crear
  *
  * @return json
*/
$app->post('/horarios/crear', function() use($app) {
  $h = new Model\Horarios;

  return $app->json($h->add());
});


/**
  * Acción vía ajax de Horarios en api/horarios/editar
  *
  * @return json
*/
$app->post('/horarios/editar', function() use($app) {
  $h = new Model\Horarios;

  return $app->json($h->edit());
});


/**
  * Acción vía ajax de Planentrenamiento en api/planentrenamiento/crear
  *
  * @return json
*/
$app->post('/planentrenamiento/crear', function() use($app) {
  $p = new Model\Planentrenamiento;

  return $app->json($p->add());
});


/**
  * Acción vía ajax de Proveedores en api/proveedores/crear
  *
  * @return json
*/
$app->post('/proveedores/crear', function() use($app) {
  $p = new Model\Proveedores;

  return $app->json($p->add());
});


/**
  * Acción vía ajax de Planentrenamiento en api/planentrenamiento/editar
  *
  * @return json
*/
$app->post('/planentrenamiento/editar', function() use($app) {
  $p = new Model\Planentrenamiento;
  return $app->json($p->edit());
});

/*
  * Acción vía ajax de proveedores en api/proveedores/editar
  *
  * @return json
*/
$app->post('/proveedores/editar', function() use($app) {
  $p = new Model\Proveedores;

  return $app->json($p->edit());
});


/**
  * Acción vía ajax de Plansemanal en api/plansemanal/crear
  *
  * @return json
*/
$app->post('/plansemanal/crear', function() use($app) {
  $p = new Model\Plansemanal;

  return $app->json($p->add());
});
/**
  * Acción vía ajax de Ordencompra en api/ordencompra/crear
  *
  * @return json
*/
$app->post('/ordencompra/crear', function() use($app) {
  $oc = new Model\Ordencompra;

  return $app->json($oc->add());
});


/**
  * Acción vía ajax de Plansemanal en api/plansemanal/editar
  *
  * @return json
*/
$app->post('/plansemanal/editar', function() use($app) {
  $p = new Model\Plansemanal;

  return $app->json($p->edit());
});
/*
  * Acción vía ajax de Ordencompra en api/ordencompra/editar
  *
  * @return json
*/
$app->post('/ordencompra/editar', function() use($app) {
  $oc = new Model\Ordencompra;

  return $app->json($oc->edit());
});


/**
  * Acción vía ajax de Asistencia en api/asistencia/crear
  *
  * @return json
*/
$app->post('/asistencia/crear', function() use($app) {
  $a = new Model\Asistencia;

  return $app->json($a->add());
});


/**
  * Acción vía ajax de Asistencia en api/asistencia/editar
  *
  * @return json
*/
$app->post('/asistencia/editar', function() use($app) {
  $a = new Model\Asistencia;

  return $app->json($a->edit());
});


/**
  * Acción vía ajax de Partidos en api/partidos/crear
  *
  * @return json
*/
$app->post('/partidos/crear', function() use($app) {
  $p = new Model\Partidos;

  return $app->json($p->add());
});


/**
  * Acción vía ajax de Partidos en api/partidos/editar
  *
  * @return json
*/
$app->post('/partidos/editar', function() use($app) {
  $p = new Model\Partidos;

  return $app->json($p->edit());
});
/*
  * Acción vía ajax de Ordencompra en api/ordencompra/editar
  *
  * @return json
*/
$app->post('/ordencompra/pagar', function() use($app) {
  $oc = new Model\Ordencompra;

  return $app->json($oc->pagar());
});

/**
  * Acción vía ajax de Ventas en api/ventas/crear
  *
  * @return json
*/
$app->post('/ventas/crear', function() use($app) {
  $v = new Model\Ventas;

  return $app->json($v->add());
});

/**
  * Acción vía ajax de Mensualidades en api/mensualidades/crear
  *
  * @return json
*/
$app->post('/mensualidades/crear', function() use($app) {
  $m = new Model\Mensualidades;

  return $app->json($m->add());
});

/**
  * Acción vía ajax de Inscripciones en api/inscripciones/crear
  *
  * @return json
*/
$app->post('/inscripciones/crear', function() use($app) {
  $i = new Model\Inscripciones;

  return $app->json($i->add());
});


/**
  * Acción vía ajax de Equipos en api/equipos/crear
  *
  * @return json
*/
$app->post('/equipos/crear', function() use($app) {
  $e = new Model\Equipos;

  return $app->json($e->add());
});


/**
  * Acción vía ajax de Equipos en api/equipos/editar
  *
  * @return json
*/
$app->post('/equipos/editar', function() use($app) {
  $e = new Model\Equipos;

  return $app->json($e->edit());
});
/*
  * Acción vía ajax de Pagos en api/pagos/crear
  *
  * @return json
*/
$app->post('/pagos/crear', function() use($app) {
  $p = new Model\Pagos;

  return $app->json($p->add());
});

/**
  * Acción vía ajax de Costos en api/costos/editar
  *
  * @return json
*/
$app->post('/costos/editar', function() use($app) {
  $c = new Model\Costos;

  return $app->json($c->edit());
});

$app->post('/enfermedades/crear', function() use($app) {
  $j = new Model\Enfermedades;

  return $app->json($j->add());
});


/**
  * Acción vía ajax de Jugadores en api/jugadores/editar
  *
  * @return json
*/
$app->post('/enfermedades/editar', function() use($app) {
  $j = new Model\Enfermedades;

  return $app->json($j->edit());
});

/**
  * Acción vía ajax de Valores en api/valores/crear
  *
  * @return json
*/
$app->post('/pediatras/crear', function() use($app) {
    $u = new Model\Pediatras;

    return $app->json($u->add());
});

/**
    * Registro de un usuario
    *
    * @return json
*/
$app->post('/pediatras/editar', function() use($app) {
    $u = new Model\Pediatras;

    return $app->json($u->edit());
});

/**
    * Recuperar contraseña perdida
    *
    * @return json
*/



/**
  * Acción vía ajax de Sintomas en api/sintomas/crear
  *
  * @return json
*/
$app->post('/sintomas/crear', function() use($app) {
  $s = new Model\Sintomas;

  return $app->json($s->add());
});


/**
  * Acción vía ajax de Sintomas en api/sintomas/editar
  *
  * @return json
*/
$app->post('/sintomas/editar', function() use($app) {
  $s = new Model\Sintomas;

  return $app->json($s->edit());
});

// Actividades Guarderias
$app->post('/actividades/actguarcrear', function() use($app) {
  $s = new Model\Actividades;

  return $app->json($s->addactguar());   
});


/**
  * Acción vía ajax de Sintomas en api/sintomas/editar
  *
  * @return json
*/
$app->post('/actividades/actguareditar', function() use($app) {
  $s = new Model\Actividades;

  return $app->json($s->editactguar());
});
