/**
 * Ajax action to api rest
*/
function crear_autorizado(){
    $.ajax({
      type : "POST",
      url : "api/autorizados/crear",
      data : $('#crear_autorizado_form').serialize(),
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
  $('#crear_autorizado').click(function(e) {
    e.defaultPrevented;
    crear_autorizado();
  });
  $('#crear_autorizado_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_autorizado();
      }
  });