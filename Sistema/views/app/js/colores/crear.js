/**
 * Ajax action to api rest
*/
function crear_colores(){
  $.ajax({
    type : "POST",
    url : "api/colores/crear",
    data : $('#crear_color_form').serialize(),
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
$('#crear_color').click(function(e) {
  e.defaultPrevented;
  crear_colores();
});
$('#crear_color_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_colores();
    }
});