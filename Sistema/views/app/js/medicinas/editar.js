function edit_medicina(codigo,descripcion){
    $('#id_codigo').val(codigo);
    $('#id_descripcion').val(descripcion);
}

/**
 * Ajax action to api rest
*/
function editar_medicina(){
    $.ajax({
      type : "POST",
      url : "api/medicinas/editar",
      data : $('#editar_medicina_form').serialize(),
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
  $('#editar_medicina').click(function(e) {
    e.defaultPrevented;
    editar_medicina();
  });
  $('#editar_medicina_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_medicina();
      }
  });