function editar_producto(descripcion,cantidad_teorica,cantidad_minima,cantidad,codigo_sede,codigo,precio){
  $('#descripcion_editar').val(descripcion);
  $('#cantidad_editar').val(cantidad);
  $('#cantidad_teorica_editar').val(cantidad_teorica);
  $('#codigo_editar').val(codigo);
  $('#cantidad_minima_editar').val(cantidad_minima);
  $('#sede_editar').val(codigo_sede).change();
  $('#precio_editar').val(precio);
}

/**
 * Ajax action to api rest
*/
function editar_productos(){
  $.ajax({
    type : "POST",
    url : "api/productos/editar",
    data : $('#editar_producto_form').serialize(),
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
$('#editar_producto').click(function(e) {
  e.defaultPrevented;
  editar_productos();
});
$('#editar_producto_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        editar_productos();
    }
});