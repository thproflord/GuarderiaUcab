/**
 * Ajax action to api rest
*/
function sedes(){
  $.ajax({
    type : "POST",
    url : "api/sedes/crear",
    data : $('#crear_sedes_form').serialize(),
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
$('#crear_sedes').click(function(e) {
  e.defaultPrevented;
  sedes();
});
$('#crear_sedes_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        sedes();
    }
});