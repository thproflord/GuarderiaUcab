/**
 * Ajax action to api rest
*/
function crear_pediatra(){
    $.ajax({
      type : "POST",
      url : "api/pediatras/crear",
      data : $('#crear_pediatra_form').serialize(),
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
  $('#crear_pediatra').click(function(e) {
    e.defaultPrevented;
    crear_pediatra();
  });
  $('#crear_pediatra_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_pediatra();
      }
  });