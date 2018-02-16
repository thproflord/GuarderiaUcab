function editar_estados(codigo,nombre){
  $('#codigo_editar').val(codigo);
  $('#nombre_editar').val(nombre);
}

/**
 * Ajax action to api rest
*/
function estados(){
  $.ajax({
    type : "POST",
    url : "api/estados/editar",
    data : $('#editar_estados_form').serialize(),
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
$('#editar_estados').click(function(e) {
  e.defaultPrevented;
  estados();
});
$('#editar_estados_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        estados();
    }
});