/**
 * Ajax action to api rest
*/
function crear_inscripcion(){
    $.ajax({
      type : "POST",
      url : "api/inscripciones/crear",
      data : $('#crear_inscripcion_form').serialize(),
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
  $('#crear_inscripcion').click(function(e) {
    e.defaultPrevented;
    crear_inscripcion();
  });
  $('#crear_inscripcion_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_inscripcion();
      }
  });