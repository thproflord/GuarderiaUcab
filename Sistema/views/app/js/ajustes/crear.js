function equipoDañado(cantidad,codigo){
  $('#cantidad_dañada').val(cantidad);
  $('#id_producto_dañado').val(codigo);
}

/**
 * Ajax action to api rest
*/
function ajustes_equipo_dañado(){
  $.ajax({
    type : "POST",
    url : "api/ajustes/dañado",
    data : $('#producto_dañado_form').serialize(),
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
 * Ajax action to api rest
*/
function ajustes(cant_teorica, cant_fisica, cod_producto){
  var ajuste = {cantidad_teorica:cant_teorica,cantidad_fisica:cant_fisica,codigo_producto:cod_producto};
  $.ajax({
    type : "POST",
    url : "api/ajustes/crear",
    data : ajuste,
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


$('#producto_dañado').click(function(e) {
  e.defaultPrevented;
  ajustes_equipo_dañado();
});