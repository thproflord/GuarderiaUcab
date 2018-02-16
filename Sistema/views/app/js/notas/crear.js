function create_nota(){
    $('#modal_crear_nota').modal('show');
}

/**
 * Ajax action to api rest
*/
function crear_nota(){
    $.ajax({
      type : "POST",
      url : "api/notas/crear",
      data : $('#crear_nota_form').serialize(),
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
  $('#crear_nota').click(function(e) {
    e.defaultPrevented;
    crear_nota();
  });
  $('#crear_nota_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_nota();
      }
  });














