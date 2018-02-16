
/**
 * Ajax action to api rest
*/
function mostrar_jugadores(nombre){
    $.ajax({
      type : "GET",
      url : `api/equipos/get_jugadores/${nombre}`,
      success : function(json) {
        $("#body_jugadores").empty();
        for (var i =0;i<json.length;i++){
          $("#body_jugadores").append(`<tr>
          <td> ${json[i].id_jugador} </td>
          <td> ${json[i].nombre} </td>
          <td> ${json[i].apellido} </td>
          <td> ${json[i].nombre_categoria} </td>
          <td> ${json[i].nombre_posicion} </td>
          </tr>`);
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
  $('#mostrar_jug').click(function(e) {
    e.defaultPrevented;
    mostrar_jugadores();
  });