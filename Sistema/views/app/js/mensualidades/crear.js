

function create_mensualidad(mensualidad){
$('#id_precio_mensualidad').val(mensualidad);  
$('#id_precio_mensualidad_total').val(mensualidad); 
}


/**
 * Ajax action to api rest
*/
function crear_mensualidad(){
    $.ajax({
      type : "POST",
      url : "api/mensualidades/crear",
      data : $('#crear_mensualidad_form').serialize(),
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
  
  /*Trae a los representados por el representante que se encuentra en el select*/
  function traerrepresentado(){
    var cedula = document.getElementById('id_ci_representante').value;
    $('.selector_representado').empty();
    $.ajax({
      type : "GET",
      url : "api/traerhijos/" + cedula.toString(),
      success : function(json) {
        for (var i = 0; i< json.length; i++){
              $('.selector_representado').append(new Option(
                  json[i].id_jugador
              ));
        }
      },
      error : function(xhr, status) {
        error_toastr('Error', 'Ha ocurrido un problema');
      }
    });

  }

  /*Verifica si ya se pago el monto total de la mensualidad*/
  function verificar(){
    var codigo = document.getElementById('id_codigo_consecutivo').value;
    var precio = document.getElementById('id_precio_mensualidad_total').value;
    var representante = document.getElementById('id_ci_representante').value;
    var jugador = document.getElementById('id_id_jugador').value;
    

    if(codigo!="" && precio!="" && representante!="" && jugador!=""){
        $.ajax({
          type : "GET",      
          url : "api/mensualidad/verificar/" + codigo + '/' + precio + '/' + representante + '/' + jugador ,
          success : function(json) {

              if(jQuery.isEmptyObject(json)){
                crear_mensualidad();
              }else{
                alert('Ya se pago');
              }
              
          },
          error : function(xhr, status) {
            error_toastr('Error');
          }
        });
    }


  }


  /**
   * Events
   *  
   * @param {*} e 
   */
  $('#crear_mensualidad').click(function(e) {
    e.defaultPrevented;
    crear_mensualidad();
  });
  $('#crear_mensualidad_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
        crear_mensualidad();
      }
  });