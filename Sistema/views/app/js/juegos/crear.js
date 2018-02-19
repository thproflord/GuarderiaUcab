/**
 * Ajax action to api rest
*/
function crear_juego(){
    $.ajax({
      type : "POST",
      url : "api/juegos/crear",
      data : $('#crear_juego_form').serialize(),
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
  $('#crear_juego').click(function(e) {
    e.defaultPrevented;
    crear_juego();
  });
  $('#crear_juego_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_juego();
      }
  });