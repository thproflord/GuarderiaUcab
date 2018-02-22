function editar_personal(id_personal,nombre, apellidos,cedula,id_guarderia,direccion,telefono,nivel_estudio,sueldo){
    $('#nombre').val(nombre);
    $('#personal').val(id_personal);
    $('#apellido').val(apellidos);
    $('#cedula').val(cedula);
    $('#guarderia').val(id_guarderia);
    $('#direccion').val(direccion);
    $('#telefono').val(telefono);
    $('#nivel_estudio').val(nivel_estudio);
    $('#sueldo').val(sueldo);
}

function mostrarProfesionEditar(){
    if ($('#tipo_empleado2_editar').is(':checked')){
      $('#profesion_editar').css('display','block');
    }
    else{
      $('#profesion_editar').css('display','none');
    }
}

/**
 * Ajax action to api rest
*/
function editar_empleado(){
    $.ajax({
      type : "POST",
      url : "api/personal/editar",
      data : $('#editar_personal_form').serialize(),
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
  $('#editar_personal').click(function(e) {
    e.defaultPrevented;
    editar_empleado();
  });
  $('#editar_personal_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_empleado();
      }
  });
