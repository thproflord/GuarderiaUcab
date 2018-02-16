
function crear_posiciones(){
    $.ajax({
      type : "POST",
      url : "api/posicion/crear",
      data : $('#crear_posicion_form').serialize(),
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
  $('#crear_posicion').click(function(e) {
    e.defaultPrevented;
    crear_posiciones();
  });
  $('#crear_posicion_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_posiciones();
      }
  });