function editar_color(anio_ini,anio_fin,color_short,color_camisa,codigo_produco,tipo){
  $('#anio_ini_editar').val(anio_ini);
  $('#anio_fin_editar').val(anio_fin);
  $('#color_short_editar').val(color_short);
  $('#color_camisa_editar').val(color_camisa);
  $('#uniforme_editar').val(codigo_produco).change();
  if(tipo == 0){
    $('#tipo1_editar').prop('checked',true);
  }
  else{
    $('#tipo2_editar').prop('checked',true);
  }
}

/**
 * Ajax action to api rest
*/
function editar_colores(){
  $.ajax({
    type : "POST",
    url : "api/colores/editar",
    data : $('#editar_color_form').serialize(),
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
$('#editar_color').click(function(e) {
  e.defaultPrevented;
  editar_colores();
});
$('#editar_color_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        editar_colores();
    }
});