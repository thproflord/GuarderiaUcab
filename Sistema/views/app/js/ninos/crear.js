/**
 * Ajax action to api rest
*/
function crear_nino(){
    $.ajax({
      type : "POST",
      url : "api/ninos/crear",
      data : $('#crear_nino_form').serialize(),
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
  $('#crear_nino').click(function(e) {
    e.defaultPrevented;
    crear_nino();
  });
  $('#crear_nino_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_nino();
      }
  });