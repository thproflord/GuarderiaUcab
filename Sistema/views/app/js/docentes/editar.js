function edit_docente(nombre,apellido,cedula,telefono_oficina,telefono_casa,telefono_celular,sexo,direccion,parentesco,profesion){
    $('#id_nombre').val(nombre);
    $('#id_apellido').val(apellido);
    $('#id_cedula').val(cedula);
    $('#id_tlf_oficina').val(telefono_oficina);
    $('#id_tlf_casa').val(telefono_casa);
    $('#id_tlf_celular').val(telefono_celular);
    $('#id_direccion').val(direccion);
    $('#id_parentesco').val(parentesco);
    $('#id_profesion').val(profesion);

    

    if(sexo == 'm'){
        $("#id_sexo_hombre_edit").prop("checked",true);
    }
    else {
        $("#id_sexo_mujer_edit").prop("checked",true);
    }
    
}

/**
 * Ajax action to api rest
*/
function editar_docente(){
    $.ajax({
      type : "POST",
      url : "api/docentes/editar",
      data : $('#editar_docente_form').serialize(),
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
  $('#editar_docente').click(function(e) {
    e.defaultPrevented;
    editar_docente();
  });
  $('#editar_docente_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_docente();
      }
  });