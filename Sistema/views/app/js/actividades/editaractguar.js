function edit_actividades(guarderia,actividad,personal,cupomin,cupomax){
    $('#id_guarderia').val(guarderia);
    $('#id_actividad').val(actividad);
    $('#id_personal').val(personal);
    $('#id_cupomin').val(cupomin);
    $('#id_cupomax').val(cupomax);

}

/**
 * Ajax action to api rest
*/
function editar_actividades(){
    $.ajax({
      type : "POST",
      url : "api/actividades/editaractguar",
      data : $('#editar_actividades_form').serialize(),
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
  $('#editar_actividades').click(function(e) {
    e.defaultPrevented;
    editar_actividades();
  });
  $('#editar_actividades_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_actividades();
      }
  });
