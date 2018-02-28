function edit_comida(comida,tipo,descripcion){
    $('#id_comida').val(comida);
    $('#id_tipo').val(tipo);
    $('#id_descripcion').val(descripcion);
}

/**
 * Ajax action to api rest
*/
function editar_comida(){
    $.ajax({
      type : "POST",
      url : "api/comidas/editar",
      data : $('#editar_comida_form').serialize(),
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
  $('#editar_comida').click(function(e) {
    e.defaultPrevented;
    editar_comida();
  });
  $('#editar_comida_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_comida();
      }
  });