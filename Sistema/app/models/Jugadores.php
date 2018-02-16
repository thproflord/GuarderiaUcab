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
 * Modelo Jugadores
 *
 * @author Alexander De Azevedo, Sergio García y Greg Gómez <oeneikaphotos@gmail.com>
 */

class Jugadores extends Models implements IModels {
    
    use DBModel;
    
      protected $cedula;
      protected $nombre;
      protected $apellido;
      protected $celular;
      protected $fecha_nacimiento;
      protected $sexo; 
      protected $anio_estudio;
      protected $goles_marcados_torneo;
      protected $goles_detenidos_torneo;
      protected $cedula_representante;
      protected $nombre_equipo;
      protected $codigo_posicion;
      protected $codigo_colegio;
      protected $nombre_categoria;
      protected $morosidad;
    /**
      * Controla los errores de entrada del formulario
      *
      * @throws ModelsException
    */
    final private function errors(bool $edit = false) {
     global $http;
        
      #Datos obligatorios al crear
      $this->cedula = $http->request->get('cedula');
      $this->nombre = $http->request->get('nombre');
      $this->apellido = $http->request->get('apellido');
      $this->fecha_nacimiento = $http->request->get('fecha_nacimiento');
      $this->sexo = $http->request->get('sexo'); 
      $this->anio_estudio = $http->request->get('año_estudio');
      $this->cedula_representante = $http->request->get('cedula_representante');
      $this->codigo_posicion = $http->request->get('posicion');
      $this->codigo_colegio = $http->request->get('codigo_colegio');
      $this->nombre_categoria = $http->request->get('categoria');
      $this->morosidad = $http->request->get('morosidad');

      #Dato opcional al crear
      $this->celular = $http->request->get('celular');

      #Datos solo verificados al editar
      if ($edit){
      $this->goles_marcados_torneo = $http->request->get('goles_marcados_torneo');
      $this->goles_detenidos_torneo = $http->request->get('goles_detenidos_torneo');
      $this->nombre_equipo = $http->request->get('nombre_equipo');
      }

        # Verificar que la cedula no este vacia
     if($this->functions->emp($this->cedula) && !$edit) {
        throw new ModelsException('La cedula no puede estar vacía.');
      }
  
      # Verificar que el nombre no está vacío
      if($this->functions->emp($this->nombre) && !$edit) {
        throw new ModelsException('El nombre no puede estar vacío.');
      }
  
      # Verificar que el apellido no está vacío
      if($this->functions->emp($this->apellido) && !$edit) {
        throw new ModelsException('El apellido no puede estar vacío.');
      }
  
      # Verificar la fecha de nacimiento no este vacia
      if($this->functions->emp($this->fecha_nacimiento) && !$edit) {
        throw new ModelsException('La fecha de nacimiento no puede estar vacía.');
      }
  
      # Verificar que el sexo no está vacío
      if($this->functions->emp($this->sexo) && !$edit) {
        throw new ModelsException('El sexo no puede estar vacío.');
      }

      # Verificar que el año de estudio no es te vacio
      if($this->functions->emp($this->anio_estudio)) {
        throw new ModelsException('El año de estudio no puede estar vacío.');
      }

      # Verificar que la cedula del representante no este vacia
      if($this->functions->emp($this->cedula_representante ) && !$edit ) {
        throw new ModelsException('La cedula del representante no puede estar vacío.');
      }

      # Verificar que el codigo de la posicion no este vacio
      if($this->functions->emp($this->codigo_posicion)) {
        throw new ModelsException('La posicion no puede estar vacío.');
      }

      # Verificar que el codigo del colegio no está vacío
      if($this->functions->emp($this->codigo_colegio)) {
        throw new ModelsException('El codigo del colegio no puede estar vacío.');
      }
  
      # Verificar que el nombre de la categoria no este vacio 
      if($this->functions->emp($this->nombre_categoria)) {
        throw new ModelsException('El nombre de la categoria no puede estar vacío.');
      }

      

      
        $cedula_exist = $this->db->query_select("SELECT * FROM jugadores_4 WHERE id_jugador = '$this->cedula'");
        if(false!==$cedula_exist && !$edit){
          throw new ModelsException('El numero de cedula ya existe');
        }
  
       // throw new ModelsException('¡Esto es un error!');
      }
  
      /** 
        * Crea un elemento de Jugadores en la tabla `jugadores`
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function add() {
        try {
                    
          # Controlar errores de entrada en el formulario
          $this->errors();
  
          # Insertar elementos
          $this->db->query("INSERT INTO jugadores_4
          (id_jugador,nombre,apellido,celular,fecha_nacimiento,sexo,anio_estudio,cedula_representante,codigo_posicion,codigo_colegio,nombre_categoria)
          VALUES ('$this->cedula','$this->nombre','$this->apellido','$this->celular','$this->fecha_nacimiento','$this->sexo',$this->anio_estudio,
          '$this->cedula_representante',$this->codigo_posicion,$this->codigo_colegio,'$this->nombre_categoria');");
  
  
          return array('success' => 1, 'message' => 'Creado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
            
      /** 
        * Edita un elemento de Jugadores en la tabla `jugadores`
        *
        * @return array con información para la api, un valor success y un mensaje.
      */
      final public function edit() : array {
        try {
          
          # Controlar errores de entrada en el formulario
          $this->errors(true);
  
          


          if( !($this->functions->emp($this->nombre_equipo)) ){
          # Actualizar elementos
          $this->db->query("UPDATE jugadores_4
          SET celular ='$this->celular', anio_estudio = $this->anio_estudio , codigo_posicion = $this->codigo_posicion,
          codigo_colegio = $this->codigo_colegio , nombre_categoria = '$this->nombre_categoria' , goles_marcados_torneo = $this->goles_marcados_torneo , 
          goles_detenidos_torneo = $this->goles_detenidos_torneo ,nombre_equipo = '$this->nombre_equipo' ,morosidad = $this->morosidad      
          WHERE id_jugador = '$this->cedula';");
          }else{
            $this->db->query("UPDATE jugadores_4
            SET cedula_representante = '$this->cedula_representante' , celular ='$this->celular', anio_estudio = $this->anio_estudio , codigo_posicion = $this->codigo_posicion,
            codigo_colegio = $this->codigo_colegio , nombre_categoria = '$this->nombre_categoria' , goles_marcados_torneo = $this->goles_marcados_torneo , 
            goles_detenidos_torneo = $this->goles_detenidos_torneo ,morosidad = $this->morosidad      
            WHERE id_jugador = '$this->cedula';");

          }
          
          /*Si se le coloca la morosidad en 30 hay que borrarlo de las inscripciones y ya no podra pagar mensualidades*/
          if($this->morosidad==30){
            $this->db->query(
               "DELETE 
                FROM inscripciones_4 
                WHERE id_jugador = '$this->cedula'
              ;");

              /* $this->db->query(
               "DELETE 
                FROM mensualidades_4 
                WHERE id_jugador = '$this->cedula'
              ;");*/

          }

  



          return array('success' => 1, 'message' => 'Editado con éxito.');
        } catch(ModelsException $e) {
          return array('success' => 0, 'message' => $e->getMessage());
        }
      }
  
      /** 
        * Borra un elemento de Jugadores en la tabla `jugadores`
        * y luego redirecciona a jugadoresl/&success=true
        *
        * @return void
      */
      final public function delete($id) {
        global $config;
        # Borrar el elemento de la base de datos
        $this->db->query("DELETE FROM jugadores_4 WHERE id_jugador = '$id'");
        # Redireccionar a la página principal del controlador
        $this->functions->redir($config['site']['url'] . 'jugadores/&success=true');
      }

      final public function contarhombres(){
        global $config;
        return $this->db->query_select("SELECT COUNT(*) AS total 
          FROM jugadores_4 
          WHERE sexo='m';");
      }

      final public function contarmujeres(){
        global $config;
        return $this->db->query_select("SELECT COUNT(*) AS total 
          FROM jugadores_4 
          WHERE sexo='f';");
      }

        final public function contarempleados(){
        global $config;
        return $this->db->query_select("SELECT COUNT(*) AS total 
          FROM empleados_4 ");
      }

        final public function contarrepresentantes(){
        global $config;
        return $this->db->query_select("SELECT COUNT(*) AS total 
          FROM representantes_4 ");
      }


              final public function contarsedes(){
        global $config;
        return $this->db->query_select("SELECT COUNT(*) AS total 
          FROM sedes_4 ");
      }

      /**
       * Obtiene los alumnos inscritos en dias especificos y sedes especificas
       */
      final public function getDiasInscritos(string $dia, int $sede){
        $date = date_create($dia);
        $diaS = date_format($date,'N');
        return $this->db->query_select(
          "SELECT DISTINCT jugadores_4.*
          FROM jugadores_4
          INNER JOIN inscripciones_4 ON inscripciones_4.id_jugador = jugadores_4.id_jugador
          INNER JOIN dias_inscritos_4 ON dias_inscritos_4.id_jugador = jugadores_4.id_jugador
          WHERE dias_inscritos_4.dia = $diaS AND inscripciones_4.codigo_sede = $sede AND jugadores_4.morosidad < 20");
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