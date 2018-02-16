function editar_sede(nombre, codigo,direccion,fecha_apertura,costo_3dias,costo_5dias,calle,urbanizacion,coord_tecnico,coord_admin){
  $('#nombre_editar').val(nombre);
  $('#direccion_editar').val(direccion);
  $('#codigo_editar').val(codigo);
  $('#costo_3dias_editar').val(costo_3dias);
  $('#costo_5dias_editar').val(costo_5dias);
  $('#fecha_apertura_editar').val(fecha_apertura);
  $('#coord_tecni_editar').val(coord_tecnico).change();
  $('#coord_admin_editar').val(coord_admin).change();
  $('#calle_editar').val(calle);
  $('#urbanizacion_editar').val(urbanizacion);
}

/**
 * Ajax action to api rest
*/
function editar_sedes(){
  $.ajax({
    type : "POST",
    url : "api/sedes/editar",
    data : $('#editar_sede_form').serialize(),
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
$('#editar_sede').click(function(e) {
  e.defaultPrevented;
  editar_sedes();
});
$('#editar_sede_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        editar_sedes();
    }
});