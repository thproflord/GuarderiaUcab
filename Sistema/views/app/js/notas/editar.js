function edit_nota(año_ini,año_fin,promedio,lapso,cedula_jugador){
    $('#id_año_ini').val(año_ini);
    $('#id_año_fin').val(año_fin);
    $('#id_lapso').val(lapso);
    $('#id_promedio').val(promedio);
    $('#id_cedula_jugador').val(cedula_jugador).change();
   
}

/**
 * Ajax action to api rest
*/
function editar_nota(){
    $.ajax({
      type : "POST",
      url : "api/notas/editar",
      data : $('#editar_nota_form').serialize(),
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
  $('#editar_nota').click(function(e) {
    e.defaultPrevented;
    editar_nota();
  });
  $('#editar_nota_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_nota();
      }
  });