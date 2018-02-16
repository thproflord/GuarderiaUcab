function getAll(){
    getTopEquipos();
    getTopJugadores();
    getTopPorteros();
    getTopEquiposPromedio();
}

function getTopEquipos(){
    $.ajax({
      type:"GET",
      url: "api/estadisticas/getTopEquipos",
      data: $("#temporada_form").serialize(),
      success: function(json){
        $("#body-topequipos").empty();
        for (var i = 0; i < json.length; i++){
          $("#body-topequipos").append(`<tr>
          <td>${json[i].nombre_equipo}</td>
          <td>Infantil A</td>
          <td>${json[i].hechos}</td>
          <td>${json[i].recibidos}</td>
          <td>56</td>
        </tr>`);
        }
      },
      error : function(xhr, status) {
        alert('Ha ocurrido un problema.');
      }
    })
}

function getTopEquiposPromedio(){
    $.ajax({
      type:"GET",
      url: "api/estadisticas/getTopEquiposPromedio",
      data: $("#temporada_form").serialize(),
      success: function(json){
        $("#body-topequipos-promedio").empty();
        for (var i = 0; i < json.length; i++){
          $("#body-topequipos-promedio").append(`<tr>
          <td>${json[i].nombre_equipo}</td>
          <td>Infantil A</td>
          <td>${json[i].hechos}</td>
          <td>${json[i].recibidos}</td>
          <td>56</td>
        </tr>`);
        }
      },
      error : function(xhr, status) {
        alert('Ha ocurrido un problema.');
      }
    })
}

function getTopJugadores(){
    $.ajax({
      type:"GET",
      url: "api/estadisticas/getTopJugadores",
      data: $("#temporada_form").serialize(),
      success: function(json){
        $("#body-topjugadores").empty();
        for (var i = 0; i < json.length; i++){
          $("#body-topjugadores").append(`<tr>
          <td>${json[i].nombre}</td>
          <td>${json[i].apellido}</td>
          <td>${json[i].goles}</td>
        </tr>`);
        }
      },
      error : function(xhr, status) {
        alert('Ha ocurrido un problema.');
      }
    })
}

function getTopPorteros(){
    $.ajax({
      type:"GET",
      url: "api/estadisticas/getTopPorteros",
      data: $("#temporada_form").serialize(),
      success: function(json){
        $("#body-topporteros").empty();
        for (var i = 0; i < json.length; i++){
          $("#body-topporteros").append(`<tr>
          <td>${json[i].nombre}</td>
          <td>${json[i].apellido}</td>
          <td>${json[i].goles}</td>
        </tr>`);
        }
      },
      error : function(xhr, status) {
        alert('Ha ocurrido un problema.');
      }
    })
}