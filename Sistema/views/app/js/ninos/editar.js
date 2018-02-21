function edit_nino(nombre,apellido,cedula,fechanac,sexo, letra){
    $('#id_nombre').val(nombre);
    $('#id_apellido').val(apellido);
    $('#id_cedula').val(cedula);
    $('#id_fechanac').val(fechanac);
    $('#id_sexo').val(sexo);
    $('#id_letra').val(letra);
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