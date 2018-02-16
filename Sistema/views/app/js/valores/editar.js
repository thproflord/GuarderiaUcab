function edit_valor(id_jugador,peso,talla,imc,flexiones_x_minuto,ab_x5_min,tiempo_200m,tiempo_600m,tiempo_1k){
    $('#id_peso').val(peso);
    $('#id_talla').val(talla);
    $('#id_imc').val(imc);
    $('#id_flexiones_x_minuto').val(flexiones_x_minuto);
    $('#id_ab_x5_min').val(ab_x5_min);
    $('#id_tiempo_200m').val(tiempo_200m);
    $('#id_tiempo_600m').val(tiempo_600m);
    $('#id_tiempo_1k').val(tiempo_1k);
    $('#id_id_jugador').val(id_jugador);
  }

/**
 * Ajax action to api rest
*/
function editar_valor(){
    $.ajax({
      type : "POST",
      url : "api/valores/editar",
      data : $('#editar_valor_form').serialize(),
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
  $('#editar_valor').click(function(e) {
    e.defaultPrevented;
    editar_valor();
  });
  $('#editar_valor_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          editar_valor();
      }
  });