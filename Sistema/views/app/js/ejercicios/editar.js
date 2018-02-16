function edit_ejercicios(descripcion,id){
  $('#descripcion_edit').val(descripcion);
  $('#id_ejercicio_edit').val(id);
}

/**
 * Ajax action to api rest
*/
function editar_ejercicios(){
  $.ajax({
    type : "POST",
    url : "api/ejercicios/editar",
    data : $('#editar_ejercicio_form').serialize(),
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
$('#editar_ejercicio').click(function(e) {
  e.defaultPrevented;
  editar_ejercicios();
});
$('#editar_ejercicio_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        editar_ejercicios();
    }
});