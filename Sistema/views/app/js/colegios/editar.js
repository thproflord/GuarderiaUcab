function editar_colegio(codigo, nombre, tipo){
    $('#codigo_editar').val(codigo);
    $('#nombre_editar').val(nombre);
    if(tipo == 0){
        $('#tipo_colegio1_editar').prop('checked',true);
    }
    else if(tipo == 1){
        $('#tipo_colegio2_editar').prop('checked',true);
    }
}

/**
 * Ajax action to api rest
*/
function editar_colegios(){
    $.ajax({
      type : "POST",
      url : "api/colegios/editar",
      data : $('#editar_colegio_form').serialize(),
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
  $('#editar_colegio').click(function(e) {
    e.defaultPrevented;
    editar_colegios();
  });
  $('#editar_colegio_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_empleado();
      }
  });