function busqueda(){
  $.ajax({
    type:"GET",
    url: "api/equipos/getTres",
    data: $("#busqueda_form").serialize(),
    success: function(json){
      $("#equipos_body").empty();
      for (var i = 0; i < json.length; i++){
        $("#equipos_body").append(`<tr>
        <td>${ json[i].nombre_equipo } </td>
        <td><a href="#" type="button" data-toggle="modal" data-target="#modal-mostrar-jug" onclick="mostrar_jugadores('${ json[i].nombre_equipo }')">${ json[i].tot_jugadores }</a></td>
        <td><a type="button" data-toggle="modal" data-target="#modal-equipos-editar" onclick="editar_equipo('${ json[i].nombre_equipo }')"><i class="fa fa-edit"></i></a></td>
        <td><a type="button" href="equipos/eliminar/${ json[i].nombre_equipo }"><i class="fa fa-trash"></i></a></td>
      </tr>`);
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  })
}

function crear_equipo(){
  $.ajax({
    type : "POST",
    url : "api/equipos/crear",
    data : $('#crear_equipo_form').serialize(),
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
$('#crear_equipo').click(function(e) {
  e.defaultPrevented;
  crear_equipo();
});
$('#crear_equipo_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_equipo();
    }
});