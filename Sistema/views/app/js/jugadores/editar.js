function edit_jugador(cedula,cedula_r,nombre_cat,cod_pos,cel,cod_colegio,año_estudio,goles_marcados,goles_detenidos,nombre_equipo,morosidad){
    $('#id_cedula').val(cedula);
    $('#id_cedula_representante').val(cedula_r);
    $('#id_categoria').val(nombre_cat).change();
    $('#id_celular').val(cel);
    $('#id_codigo_colegio').val(cod_colegio).change();
    $('#id_año_estudio').val(año_estudio);
    $('#id_goles_marcados_torneo').val(goles_marcados);
    $('#id_goles_detenidos_torneo').val(goles_detenidos);
    $('#id_nombre_equipo').val(nombre_equipo);
    $('#id_id_posicion').val(cod_pos).change();
    $('#id_morosidad').val(morosidad);
}

/**
 * Ajax action to api rest
*/
function editar_jugador(){
    $.ajax({
      type : "POST",
      url : "api/jugadores/editar",
      data : $('#editar_jugador_form').serialize(),
      success : function(json) {
        alert(json.success);
        alert(json.message);
        if(json.success == 1) {
          setTimeout(function(){
              location.reload();
          },1000);
        }
      },
      error : function(xhr, status) {
        alert('Ha ocurrido un problema.');
      }
    });
  }
  
  /**
   * Events
   *  
   * @param {*} e 
   */
  $('#editar_jugador').click(function(e) {
    e.defaultPrevented;
    editar_jugador();
  });
  $('#editar_jugador_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_jugador();
      }
  });