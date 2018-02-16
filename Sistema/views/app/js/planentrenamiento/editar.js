function edit_plan(nombre,duracion,entrenador,tipo,id,horario){
  $('#nombre_edit').val(nombre);
  $('#duracion_edit').val(duracion);
  $('#entrenador_edit').val(entrenador).change();
  $('#tipo_edit').val(tipo).change();
  $('#horario_edit').val(horario).change();
  $('#id_edit').val(id);
}

/**
 * Ajax action to api rest
*/
function editar_planentrenamiento(){
  $.ajax({
    type : "POST",
    url : "api/planentrenamiento/editar",
    data : $('#editar_plan_form').serialize(),
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
$('#editar_plan').click(function(e) {
  e.defaultPrevented;
  editar_planentrenamiento();
});
$('#editar_plan_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
      editar_planentrenamiento();
    }
});