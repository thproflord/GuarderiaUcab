function get_dias(){
  $.ajax({
    type : "GET",
    url : `api/asistencia/get_horarios/${$('#sede_asistencia').val()}`,
    success : function(json) {
      $('#dia_asistencia').empty();
      for(var i = 0; i < json.length; i++){
        var option = `temporada ${json[i].anio_ini_horario}-${json[i].anio_fin_horario}, ${json[i].dia}`
        $('#dia_asistencia').append(new Option(
          option,
          json[i].dia,
          false,
          false
        ));
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  });
}

function get_dias_asistidos(){
  $.ajax({
    type : "GET",
    url : `api/asistencia/get_dias_asistidos/${$('#sede_asistencia').val()}`,
    success : function(json) {
      for(var i = 0; i < json.length; i++){
        var option = `temporada ${json[i].anio_ini}-${json[i].anio_fin}, ${json[i].dia}`
        $('#dia_asistencia').append(new Option(
          option,
          json[i].dia,
          false,
          false
        ));
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  });
}

function get_alumnos_asistencia(){
  $('#body_asistencia').empty();
  $.ajax({
    type : "GET",
    url : `api/asistencia/get_alumnos_asist/${$('#dia_asistencia').val()}/${$('#sede_asistencia').val()}`,
    success : function(json) { 
      for(var i = 0; i < json.length; i++){
        $('#body_asistencia').append(`<tr>
        <td> ${json[i].id_jugador} <input type="hidden" name="jugadores[]" value="${json[i].id_jugador}"></td>
        <td> ${json[i].nombre} </td>
        <td> ${json[i].apellido} </td>
        <td> ${json[i].falto} </td>
        <td> ${json[i].hora_llegada} </td>
        </tr>`);
      }
      $('.timepicker').timepicker({
        showInputs: false
      });
      
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  });
}

function get_alumnos(){
  $('#body_asistencia').empty();
  $.ajax({
    type : "GET",
    url : `api/asistencia/get_alumnos/${$('#dia_asistencia').val()}&${$('#sede_asistencia').val()}`,
    success : function(json) { 
      for(var i = 0; i < json.length; i++){
        var option = `temporada ${json[i].anio_ini_horario}-${json[i].anio_fin_horario}, ${json[i].dia}`
        $('#body_asistencia').append(`<tr>
        <td> ${json[i].id_jugador} <input type="hidden" name="jugadores[]" value="${json[i].id_jugador}"></td>
        <td> ${json[i].nombre} </td>
        <td> ${json[i].apellido} </td>
        <td> <select class="form-control select2" name="asistencia[]" id="">
        <option disabled selected value></option>
        <option value="no">Asistio</option>
        <option value="si">No asistio</option>
        </select>
        </td>
        <td><div class="bootstrap-timepicker">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control timepicker" name="hora[]">
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
        </div></td>
        </tr>`);
      }
      $('.timepicker').timepicker({
        showInputs: false
      });
      
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  });
}

/**
 * Ajax action to api rest
*/
function asistencia(){
  $.ajax({
    type : "POST",
    url : "api/asistencia/crear",
    data : $('#guardar_asistencia_form').serialize(),
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
$('#guardar_asistencia').click(function(e) {
  e.defaultPrevented;
  asistencia();
});
$('#guardar_asistencia_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        asistencia();
    }
});