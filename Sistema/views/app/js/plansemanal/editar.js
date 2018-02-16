/**
 * Ajax action to api rest
*/
function plansemanal(){
  $.ajax({
    type : "POST",
    url : "api/plansemanal/editar",
    data : $('#plansemanal_form').serialize(),
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
$('#plansemanal').click(function(e) {
  e.defaultPrevented;
  plansemanal();
});
$('#plansemanal_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        plansemanal();
    }
});