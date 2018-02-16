function editar_equipo(nombre){
  $('#nombre_editar').val(nombre);
}

/**
* Ajax action to api rest
*/
function editar_equipos(){
  $.ajax({
    type : "POST",
    url : "api/equipos/editar",
    data : $('#editar_equipo_form').serialize(),
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
$('#editar_equipo').click(function(e) {
  e.defaultPrevented;
  editar_equipos();
});
$('#editar_equipo_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        editar_equipos();
    }
});