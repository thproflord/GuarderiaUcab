/**
 * Ajax action to api rest
*/
function crear_medicina(){
    $.ajax({
      type : "POST",
      url : "api/medicinas/crear",
      data : $('#crear_medicina_form').serialize(),
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
  $('#crear_medicina').click(function(e) {
    e.defaultPrevented;
    crear_medicina();
  });
  $('#crear_medicina_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_medicina();
      }
  });