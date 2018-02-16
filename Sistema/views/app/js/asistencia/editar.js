/**
 * Ajax action to api rest
*/
function asistencia(){
  $.ajax({
    type : "POST",
    url : "api/asistencia/editar",
    data : $('#asistencia_form').serialize(),
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
$('#asistencia').click(function(e) {
  e.defaultPrevented;
  asistencia();
});
$('#asistencia_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        asistencia();
    }
});