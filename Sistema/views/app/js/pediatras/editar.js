function edit_pediatra(nombre,telefono,cedula){
    $('#id_nombre').val(nombre);
    $('#id_telefono').val(telefono);
    $('#id_cedula').val(cedula);
}

function prueba(){
  alert("prueba");
}

/**
 * Ajax action to api rest
*/
function editar_pediatra(){
    $.ajax({
      type : "POST",
      url : "api/pediatras/editar",
      data : $('#editar_pediatra_form').serialize(),
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
  $('#editar_pediatra').click(function(e) {
    e.defaultPrevented;
    editar_pediatra();
  });
  $('#editar_pediatra_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_pediatra();
      }
  });
