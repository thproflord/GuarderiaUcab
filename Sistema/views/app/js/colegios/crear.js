

/**
 * Ajax action to api rest
*/
function crear_colegios(){
    $.ajax({
      type : "POST",
      url : "api/colegios/crear",
      data : $('#crear_colegio_form').serialize(),
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
  $('#crear_colegio').click(function(e) {
    e.defaultPrevented;
    crear_colegios();
  });
  $('#crear_colegio_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_colegios();
      }
  });