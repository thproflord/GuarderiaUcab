function editar_personal(nombre, apellido,cedula,telefono_oficina,telefono_casa,telefono_celular,fecha_nacimiento,nacionalidad,tipo,profesion,sexo){
    $('#nombre_editar').val(nombre);
    $('#apellido_editar').val(apellido);
    $('#cedula_editar').val(cedula);
    $('#tlf_oficina_editar').val(telefono_oficina);
    $('#tlf_casa_editar').val(telefono_casa);
    $('#tlf_celular_editar').val(telefono_celular);
    $('#fecha_nacimiento_editar').val(fecha_nacimiento);
    $('#nacionalidad_editar').val(nacionalidad);
    if(tipo == 1){
        $('#tipo_empleado1_editar').prop('checked',true);
    }
    else if(tipo == 2){
        $('#tipo_empleado2_editar').prop('checked',true);
        $('#profesion_editar').css('display','block');
    }
    else{
        $('#tipo_empleado3_editar').prop('checked',true);
    }
    if(sexo == 'm'){
        $('#sexo1_editar').prop('checked',true);
    }
    else {
        $('#sexo2_editar').prop('checked',true);
    }
    $('#input_profesion_editar').val(profesion);
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