function editar_lugares(codigo, nombre,codigo_estado){
    $('#codigo_editar').val(codigo);
    $('#nombre_editar').val(nombre);
    $('#id_estado_editar').val(codigo_estado).change();
}

/**
 * Ajax action to api rest
*/
function editar_lugar(){
    $.ajax({
      type : "POST",
      url : "api/lugares/editar",
      data : $('#editar_lugares_form').serialize(),
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
  $('#editar_lugares').click(function(e) {
    e.defaultPrevented;
    editar_lugar();
  });
  $('#editar_lugares_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
         editar_lugar();
      }
  });