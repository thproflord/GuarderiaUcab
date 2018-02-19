/**
 * Ajax action to api rest
*/
function crear_comida(){
    $.ajax({
      type : "POST",
      url : "api/comidas/crear",
      data : $('#crear_comida_form').serialize(),
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
  $('#crear_comida').click(function(e) {
    e.defaultPrevented;
    crear_comida();
  });
  $('#crear_comida_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_comida();
      }
  });