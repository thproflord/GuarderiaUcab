/**
 * Ajax action to api rest
*/
function sintomas(){
  $.ajax({
    type : "POST",
    url : "api/sintomas/editar",
    data : $('#sintomas_form').serialize(),
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
$('#sintomas').click(function(e) {
  e.defaultPrevented;
  sintomas();
});
$('#sintomas_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        sintomas();
    }
});