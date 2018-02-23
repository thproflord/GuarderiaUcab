function edit_sede(nombre,id_guarderia,lugar,id_enc,rif,telefono,costo){
  $('#nombre').val(nombre);
  $('#guarderia').val(id_guarderia);
  $('#lugar').val(lugar);
  $('#enc').val(id_enc);
  $('#rif').val(rif);
  $('#telefono').val(telefono);
  $('#costo').val(costo);
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
