function edit_actividades(codigo,nombre,transporte,costo_trans,edad_minima,descripcion){
    $('#id_codigo').val(codigo);
    $('#id_nombre').val(nombre);
    $('#id_transporte').val(transporte);
    $('#id_costo_trans').val(costo_trans);
    $('#id_edad_minima').val(edad_minima);
    $('#id_descripcion').val(descripcion);
    
}

/**
 * Ajax action to api rest
*/
function editar_actividades(){
    $.ajax({
      type : "POST",
      url : "api/actividades/editar",
      data : $('#editar_actividades_form').serialize(),
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
  $('#editar_actividades').click(function(e) {
    e.defaultPrevented;
    editar_actividades();
  });
  $('#editar_actividades_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_actividades();
      }
  });