/**
 * Ajax action to api rest
*/
function crear_productos(){
  $.ajax({
    type : "POST",
    url : "api/productos/crear",
    data : $('#crear_producto_form').serialize(),
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
$('#crear_producto').click(function(e) {
  e.defaultPrevented;
  crear_productos();
});
$('#crear_producto_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        productos();
    }
});