function busqueda(){
  $.ajax({
    type:"GET",
    url: "api/partidos/getTres",
    data: $("#busqueda_form").serialize(),
    success: function(json){
      $("#partidos_body").empty();
      for (var i = 0; i < json.length; i++){
        $("#partidos_body").append(`<tr>
        <td>${ json[i].anio_ini_partido }-${ json[i].anio_fin_partido }</td>
        <td>${ json[i].nombre_local }</td>
        <td>${ json[i].nombre_visitante }</d>
        <td>${ json[i].duracion }</td>
        <td>${ json[i].goles_local }</td>
        <td>${ json[i].goles_visitante }</td>
        <td><a type="button" data-toggle="modal" data-target="#modal-editar-partido" onclick="editar_partido(${ json[i].goles_local }, ${ json[i].goles_visitante }, ${ json[i].duracion }, ${ json[i].id_partido })"><i class="fa fa-edit"></i></a></td>
      </tr>`);
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  })
}
function inicial(){
  $.ajax({
    type : "GET",
    url : `api/partidos/get_equipos/${$("#categorias_partidos").val()}`,
    success : function(json) {
      $('#agregar_visitante').empty();
      $('#agregar_local').empty();
      for (var i = 0; i< json.length; i++){
          if ((i+1)!=json.length){
            $("#body-partidos").append(`<tr>
              <td>${json[i].nombre_equipo} <input type="hidden" name="local[]" value="${json[i].nombre_equipo}"></td>
              <td>${json[i+1].nombre_equipo} <input type="hidden" name="visitante[]" value="${json[i+1].nombre_equipo}"></td>
              <td><input type="text" class="form-control pull-right datepicker" name="fecha" id="agregar_fecha" name="fecha[]"></td>
              <td><a type="button"><i class="fa fa-trash"></i></a></td>
              </tr>`);
          }
          else {
            $("#body-partidos").append(`<tr>
              <td>${json[i].nombre_equipo} <input type="hidden" name="local[]" value="${json[i].nombre_equipo}"></td>
              <td>${json[0].nombre_equipo} <input type="hidden" name="visitante[]" value="${json[0].nombre_equipo}"></td>
              <td><input type="text" class="form-control pull-right datepicker" name="fecha" id="agregar_fecha" name="fecha[]"></td>
              <td><a type="button"><i class="fa fa-trash"></i></a></td>
              </tr>`);
          }
      }
      $(".datepicker").datepicker({
        autoclose: true
      });
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  })
}

function get_equipos(){
  $.ajax({
    type : "GET",
    url : `api/partidos/get_equipos/${$("#categorias_partidos").val()}`,
    success : function(json) {
      $('#agregar_visitante').empty();
      $('#agregar_local').empty();
      for (var i = 0; i< json.length; i++){
        $('#agregar_visitante').append(new Option(
            json[i].nombre_equipo,
            json[i].nombre_equipo,
            false,
            false
        ));
        $('#agregar_local').append(new Option(
          json[i].nombre_equipo,
          json[i].nombre_equipo,
          false,
          false
      ));
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  })
}

function jugadores(){
  $.ajax({
    type : "GET",
    url : "api/partidos/get_jugadores",
    data : $('#crear_partido_form').serialize(),
    success : function(json) {
      for (var i = 0; i< json.length; i++){
        $('#jugador_gol').append(new Option(
            json[i].nombre,
            json[i].id_jugador,
            false,
            false
        ));
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  })
}

function add_gol(vl){
  $("#body_goles").append(`<tr>
  <td>${$("#jugador_gol :selected").text()}<input type="hidden" name="goles[]" class="form-control" value="${$("#jugador_gol").val()}"></td>
  <td>${$("#tipo_gol :selected").text()}<input type="hidden" name="tipo[]" class="form-control" value="${$("#tipo_gol").val()}"></td>
  <td></td>
  </tr>`);
  if($("#tipo_gol").val()==0){
    var x = parseInt($(`#${vl}_edit`).val())+1;
    $(`#${vl}_edit`).val(x);
  }
  
}

function agregar_partido(){
  $("#body-partidos").append(`<tr>
  <td>${$("#agregar_local").val()} <input type="hidden" name="local[]" value="${$("#agregar_local").val()}"></td>
  <td>${$("#agregar_visitante").val()} <input type="hidden" name="visitante[]" value="${$("#agregar_visitante").val()}"></td>
  <td>${$("#agregar_fecha").val()} <input type="hidden" name="fecha[]" value="${$("#agregar_fecha").val()}"></td>
  <td><a type="button"><i class="fa fa-trash"></i></a></td>
  </tr>`);
}

function crear_partidos(){
  $.ajax({
    type : "POST",
    url : "api/partidos/crear",
    data : $('#crear_partido_form').serialize(),
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
$('#crear_partido').click(function(e) {
  e.defaultPrevented;
  crear_partidos();
});
$('#crear_partido_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_partidos();
    }
});

$('#visitante_button').click(function(){
  $('#crear_gol').attr('onclick','add_gol("visitante")');
})

$('#local_button').click(function(){
  $('#crear_gol').attr('onclick','add_gol("local")');
})

$('#cerrar_edit').click(function(){
  $("#body_goles").empty();
})