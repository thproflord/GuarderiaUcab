/**
 * Ajax action to api rest
*/
function crear_actividades(){
    $.ajax({
      type : "POST",
      url : "api/actividades/crear",
      data : $('#crear_actividades_form').serialize(),
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
  $('#crear_actividades').click(function(e) {
    e.defaultPrevented;
    crear_actividades();
  });
  $('#crear_actividades_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_actividades();
      }
  });