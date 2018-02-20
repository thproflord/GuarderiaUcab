function edit_autorizado(nombre,apellido,cedula,telefono){
    $('#id_nombre').val(nombre);
    $('#id_apellido').val(apellido);
    $('#id_cedula').val(cedula);
    $('#id_telefono').val(telefono);

}

/**
 * Ajax action to api rest
*/
function editar_autorizado(){
    $.ajax({
      type : "POST",
      url : "api/autorizados/editar",
      data : $('#editar_autorizado_form').serialize(),
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
  $('#editar_autorizado').click(function(e) {
    e.defaultPrevented;
    editar_autorizado();
  });
  $('#editar_autorizado_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_autorizado();
      }
  });
