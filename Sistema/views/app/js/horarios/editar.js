function edit_horarios(anio_ini,anio_fin,dia,hora_ini,hora_fin,sede,categoria){
  $('#anio_ini_edit').val(anio_ini);
  $('#anio_fin_edit').val(anio_fin);
  $('#hora_ini_edit').val(hora_ini);
  $('#hora_fin_edit').val(hora_fin);
  $('#dia_edit').val(dia);
  $('#sede_edit').val(sede);
  $('#categoria_edit').val(categoria).change();
}

/**
 * Ajax action to api rest
*/
function editar_horarios(){
  $.ajax({
    type : "POST",
    url : "api/horarios/editar",
    data : $('#editar_horario_form').serialize(),
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
$('#editar_horario').click(function(e) {
  e.defaultPrevented;
  editar_horarios();
});
$('#editar_horario_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
      editar_horarios();
    }
});