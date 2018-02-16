function create_valor(){
    $('#modal_crear_valor').modal('show');
}

/**
 * Ajax action to api rest
*/
function crear_valor(){
    $.ajax({
      type : "POST",
      url : "api/valores/crear",
      data : $('#crear_valor_form').serialize(),
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
  $('#crear_valor').click(function(e) {
    e.defaultPrevented;
    crear_valor();
  });
  $('#crear_valor_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_valor();
      }
  });