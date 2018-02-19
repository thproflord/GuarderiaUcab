function edit_niño(nombre,apellido,cedula,fechanac,sexo){
    $('#id_nombre').val(nombre);
    $('#id_apellido').val(apellido);
    $('#id_cedula').val(cedula);
    $('#id_fechanac').val(fechanac);
    $('#id_sexo').val(sexo);
}

/**
 * Ajax action to api rest
*/
function editar_niño(){
    $.ajax({
      type : "POST",
      url : "api/niños/editar",
      data : $('#editar_niño_form').serialize(),
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
  $('#editar_niño').click(function(e) {
    e.defaultPrevented;
    editar_niño();
  });
  $('#editar_niño_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_niño();
      }
  });