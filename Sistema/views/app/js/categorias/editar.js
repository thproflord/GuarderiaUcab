function editar_categoria(nombre,año_nacimiento){
    $('#nombre_editar').val(nombre);
    $('#año_nacimiento_editar').val(año_nacimiento);
}

/**
 * Ajax action to api rest
*/
function editar_categorias(){
    $.ajax({
      type : "POST",
      url : "api/categorias/editar",
      data : $('#editar_categoria_form').serialize(),
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
  $('#editar_categoria').click(function(e) {
    e.defaultPrevented;
    editar_categorias();
  });
  $('#editar_categoria_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_categorias();
      }
  });