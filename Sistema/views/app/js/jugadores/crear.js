
/**
 * Ajax action to api rest
*/
function crear_jugador(){
    $.ajax({
      type : "POST",
      url : "api/jugadores/crear",
      data : $('#crear_jugador_form').serialize(),
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
  $('#crear_jugador').click(function(e) {
    e.defaultPrevented;
    crear_jugador();
  });
  $('#crear_jugador_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_jugador();
      }
  });