function edit_nino(nombre,apellido,codigo,fechanac,sexo){
    $('#id_nombre').val(nombre);
    $('#id_apellido').val(apellido);
    $('#id_codigo').val(codigo);
    $('#id_fechanac').val(fechanac);
    $('#id_sexo').val(sexo);
}

/**
 * Ajax action to api rest
*/
function editar_nino(){
    $.ajax({
      type : "POST",
      url : "api/ninos/editar",
      data : $('#editar_nino_form').serialize(),
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
  $('#editar_nino').click(function(e) {
    e.defaultPrevented;
    editar_nino();
  });
  $('#editar_nino_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_nino();
      }
  });