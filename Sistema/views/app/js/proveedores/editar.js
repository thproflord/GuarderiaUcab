function edit_proveedor(rif,nombre,direccion,telefono,persona){
    $('#id_rif').val(rif);
    $('#id_nombre').val(nombre);
    $('#id_direccion').val(direccion);
    $('#id_telefono').val(telefono);
    $('#id_persona_contacto').val(persona);   
}

/**
 * Ajax action to api rest
*/
function editar_proveedor(){
    $.ajax({
      type : "POST",
      url : "api/proveedores/editar",
      data : $('#editar_proveedor_form').serialize(),
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
  $('#editar_proveedor').click(function(e) {
    e.defaultPrevented;
    editar_proveedor();
  });
  $('#editar_proveedor_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_proveedor();
      }
  });