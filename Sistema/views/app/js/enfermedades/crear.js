/**
 * Ajax action to api rest
*/
function crear_enfermedades(){
    $.ajax({
      type : "POST",
      url : "api/enfermedades/crear",
      data : $('#crear_enfermedades_form').serialize(),
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
  $('#crear_enfermedades').click(function(e) {
    e.defaultPrevented;
    crear_enfermedades();
  });
  $('#crear_enfermedades_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_enfermedades();
      }
  });
