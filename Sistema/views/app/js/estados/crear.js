/**
 * Ajax action to api rest
*/
function crear_estados(){
  $.ajax({
    type : "POST",
    url : "api/estados/crear",
    data : $('#crear_estados_form').serialize(),
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
$('#crear_estados').click(function(e) {
  e.defaultPrevented;
  crear_estados();
});
$('#crear_estados_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_estados();
    }
});