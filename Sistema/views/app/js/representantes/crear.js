/**
 * Ajax action to api rest
*/
function crear_representante(){
    $.ajax({
      type : "POST",
      url : "api/representantes/crear",
      data : $('#crear_representante_form').serialize(),
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
  $('#crear_representante').click(function(e) {
    e.defaultPrevented;
    crear_representante();
  });
  $('#crear_representante_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_representante();
      }
  });