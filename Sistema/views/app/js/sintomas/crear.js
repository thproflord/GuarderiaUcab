/**
 * Ajax action to api rest
*/
function crear_sintoma(){
  $.ajax({
    type : "POST",
    url : "api/sintomas/crear",
    data : $('#crear_sintoma_form').serialize(),
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
$('#crear_sintoma').click(function(e) {
  e.defaultPrevented;
  crear_sintoma();
});
$('#crear_sintoma_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_sintoma();
    }
});