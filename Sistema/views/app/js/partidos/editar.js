function editar_partido(goles_local,goles_visitante,duracion,id){
  $('#visitante_edit').val(goles_visitante);
  $('#local_edit').val(goles_local);
  $('#duracion_edit').val(duracion);
  $('#id_partido_edit').val(id);
}

/**
* Ajax action to api rest
*/
function editar_partidos(){
  $.ajax({
    type : "POST",
    url : "api/partidos/editar",
    data : $('#editar_partido_form').serialize(),
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
$('#editar_partidos').click(function(e) {
  e.defaultPrevented;
  editar_partidos();
});
$('#editar_partido_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        editar_partidos();
    }
});