function editar_sede(nombre,id_guarderia,lugar,id_enc,rif,telefono,costo){
  alert(id_enc);
  $('#nombre').val(nombre);
  $('#lugar').val(lugar);
  $('#rif').val(rif);
  $('#telefono').val(telefono);
  $('#costo').val(costo);
  $('#guarderia').val(id_guarderia);
  $('#enc').val(id_enc);
}

function prueba(){
  alert("prueba");
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
