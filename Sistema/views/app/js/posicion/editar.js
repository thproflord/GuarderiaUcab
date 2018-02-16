function editar_posicion(codigo, descripcion){
    $('#codigo_editar').val(codigo);
    $('#descripcion_editar').val(descripcion);
}

/**
 * Ajax action to api rest
*/
function editar_posiciones(){
    $.ajax({
      type : "POST",
      url : "api/posicion/editar",
      data : $('#editar_posicion_form').serialize(),
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
  $('#editar_posicion').click(function(e) {
    e.defaultPrevented;
    editar_posiciones();
  });
  $('#editar_posicion_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_posiciones();
      }
  });