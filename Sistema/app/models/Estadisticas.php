<?php

/*
 * This file is part of the Ocrend Framewok 2 package.
 *
 * (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models as Model;
use Ocrend\Kernel\Models\Models;
use Ocrend\Kernel\Models\IModels;
use Ocrend\Kernel\Models\ModelsException;
use Ocrend\Kernel\Models\Traits\DBModel;
use Ocrend\Kernel\Router\IRouter;

/**
 * Modelo Estadisticas
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Estadisticas extends Models implements IModels {
    /**
      * Característica para establecer conexión con base de datos. 
    */
    use DBModel;

    // Contenido del modelo... 


		/**
      * Obtiene elementos de Estadisticas en 
      *
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                     array con los datos.
    */
    final public function getTopEquipos($multi = true, $ini=0, $fin=0) {
      global $http;
      if($multi){
        return $this->db->query_select("SELECT nombre_equipo, hechos_visi+hechos_local AS hechos, recibidos_local+recibidos_visi AS recibidos
        FROM equipos_4
        INNER JOIN (SELECT nombre_local,SUM(goles_local) AS hechos_local,SUM(goles_visitante) AS recibidos_local
        FROM partidos_4
        GROUP BY nombre_local) AS x ON x.nombre_local = equipos_4.nombre_equipo
        INNER JOIN (SELECT nombre_visitante,SUM(goles_visitante) AS hechos_visi,SUM(goles_local) AS recibidos_visi
        FROM partidos_4
        GROUP BY nombre_visitante) AS y ON y.nombre_visitante = equipos_4.nombre_equipo
        ORDER BY (hechos-recibidos) DESC
        LIMIT 5");
      }

      $ini = $http->query->get('anio_ini');
      $fin = $http->query->get('anio_fin');

      return $this->db->query_select("SELECT nombre_equipo, hechos_visi+hechos_local AS hechos, recibidos_local+recibidos_visi AS recibidos
      FROM equipos_4
      INNER JOIN (SELECT nombre_local,SUM(goles_local) AS hechos_local,SUM(goles_visitante) AS recibidos_local, anio_ini_partido, anio_fin_partido
      FROM partidos_4
      GROUP BY nombre_local) AS x ON x.nombre_local = equipos_4.nombre_equipo
      INNER JOIN (SELECT nombre_visitante,SUM(goles_visitante) AS hechos_visi,SUM(goles_local) AS recibidos_visi, anio_ini_partido, anio_fin_partido
      FROM partidos_4
      GROUP BY nombre_visitante) AS y ON y.nombre_visitante = equipos_4.nombre_equipo
      WHERE (x.anio_ini_partido=$ini AND x.anio_fin_partido = $fin) OR (y.anio_ini_partido=$ini AND y.anio_fin_partido = $fin) 
      ORDER BY (hechos-recibidos) DESC
      LIMIT 5");
    }

    final public function getTopEquiposPromedio($multi = true, $ini=0, $fin=0) {
      global $http;
      if($multi){
        return $this->db->query_select("SELECT nombre_equipo, (hechos_visi+hechos_local)/(y.tot_partidos+x.tot_partidos) AS hechos, recibidos_local+recibidos_visi AS recibidos
        FROM equipos_4
        INNER JOIN (SELECT nombre_local,SUM(goles_local) AS hechos_local,SUM(goles_visitante) AS recibidos_local, COUNT(nombre_local) AS tot_partidos
        FROM partidos_4
        GROUP BY nombre_local) AS x ON x.nombre_local = equipos_4.nombre_equipo
        INNER JOIN (SELECT nombre_visitante,SUM(goles_visitante) AS hechos_visi,SUM(goles_local) AS recibidos_visi, COUNT(nombre_visitante) AS tot_partidos
        FROM partidos_4
        GROUP BY nombre_visitante) AS y ON y.nombre_visitante = equipos_4.nombre_equipo
        ORDER BY (hechos) DESC
        LIMIT 5");
      }

      $ini = $http->query->get('anio_ini');
      $fin = $http->query->get('anio_fin');

      return $this->db->query_select("SELECT nombre_equipo, (hechos_visi+hechos_local)/(y.tot_partidos+x.tot_partidos) AS hechos, recibidos_local+recibidos_visi AS recibidos
      FROM equipos_4
      INNER JOIN (SELECT nombre_local,SUM(goles_local) AS hechos_local,SUM(goles_visitante) AS recibidos_local,COUNT(nombre_local) AS tot_partidos, anio_ini_partido, anio_fin_partido
      FROM partidos_4
      GROUP BY nombre_local) AS x ON x.nombre_local = equipos_4.nombre_equipo
      INNER JOIN (SELECT nombre_visitante,SUM(goles_visitante) AS hechos_visi,SUM(goles_local) AS recibidos_visi,COUNT(nombre_visitante) AS tot_partidos, anio_ini_partido, anio_fin_partido
      FROM partidos_4
      GROUP BY nombre_visitante) AS y ON y.nombre_visitante = equipos_4.nombre_equipo
      WHERE (x.anio_ini_partido=$ini AND x.anio_fin_partido = $fin) OR (y.anio_ini_partido=$ini AND y.anio_fin_partido = $fin) 
      ORDER BY (hechos) DESC
      LIMIT 5");
    }

    /**
      * Obtiene elementos de Estadisticas en 
      *
      * @param string $select: Elementos de  a seleccionar
      *
      * @return false|array: false si no hay datos.
      *                     array con los datos.
    */
    final public function getTopJugadores($multi=true,$tipo = 0) {
      global $http;
      if($multi){
        return $this->db->query_select("SELECT jugadores_4.nombre, jugadores_4.apellido, COUNT(goles_4.id_jugador) AS goles
        FROM jugadores_4
        LEFT JOIN goles_4 ON goles_4.id_jugador = jugadores_4.id_jugador
        WHERE goles_4.tipo = $tipo
        GROUP BY jugadores_4.nombre
        ORDER BY goles DESC
        LIMIT 5");       
      }

      $ini = $http->query->get('anio_ini');
      $fin = $http->query->get('anio_fin');

      return $this->db->query_select("SELECT jugadores_4.nombre, jugadores_4.apellido, COUNT(goles_4.id_jugador) AS goles
      FROM jugadores_4
      LEFT JOIN goles_4 ON goles_4.id_jugador = jugadores_4.id_jugador
      LEFT JOIN partidos_4 ON partidos_4.id_partido = goles_4.id_partido 
      WHERE goles_4.tipo = $tipo AND partidos_4.anio_ini_partido = $ini AND partidos_4.anio_fin_partido = $fin
      GROUP BY jugadores_4.nombre
      ORDER BY goles DESC
      LIMIT 5");
    }


    /**
      * __construct()
    */
    public function __construct(IRouter $router = null) {
        parent::__construct($router);
        $this->startDBConexion();
    }

    /**
      * __destruct()
    */ 
    public function __destruct() {
        parent::__destruct();
        $this->endDBConexion();
    }
}