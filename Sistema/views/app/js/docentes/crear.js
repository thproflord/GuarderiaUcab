/**
 * Ajax action to api rest
*/
function crear_docente(){
    $.ajax({
      type : "POST",
      url : "api/docentes/crear",
      data : $('#crear_docente_form').serialize(),
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
  $('#crear_docente').click(function(e) {
    e.defaultPrevented;
    crear_docente();
  });
  $('#crear_docente_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_docente();
      }
  });