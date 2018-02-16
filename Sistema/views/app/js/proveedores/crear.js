/**
 * Ajax action to api rest
*/
function crear_proveedor(){
    $.ajax({
      type : "POST",
      url : "api/proveedores/crear",
      data : $('#crear_proveedor_form').serialize(),
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
  $('#crear_proveedor').click(function(e) {
    e.defaultPrevented;
    crear_proveedor();
  });
  $('#crear_proveedor_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_proveedor();
      }
  });