

/**
 * Ajax action to api rest
*/
function crear_lugares(){
    $.ajax({
      type : "POST",
      url : "api/lugares/crear",
      data : $('#crear_lugares_form').serialize(),
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
  $('#crear_lugares').click(function(e) {
    e.defaultPrevented;
    crear_lugares();
  });
  $('#crear_lugares_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_lugares();
      }
  });