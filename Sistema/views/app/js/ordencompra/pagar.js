function pay_ordencompra(numero){
$('#id_numero_orden_pago').val(numero);
getOP(numero);
}

/**
 * Ajax action to api rest
*/
function pagar_ordencompra(){
    $.ajax({
      type : "POST",
      url : "api/ordencompra/pagar",
      data : $('#pagar_ordencompra_form').serialize(),
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
  
/*Trae las ordenes de productos de la orden de compra*/
function getOP(numero){
  
    $('.lista_de_productos').empty();
    $.ajax({
      type : "GET",
      url : "api/traerOP/" + numero,
      success : function(json) {
        for (var i = 0; i< json.length; i++){
            $("ol").append(`<li>${ json[i].descripcion } ${ json[i].cantidad } </li>`);
        }
      },
      error : function(xhr, status) {
        error_toastr('Error', 'Ha ocurrido un problema');
      }
    });



}  


  /**
   * Events
   *  
   * @param {*} e 
   */
  $('#pagar_ordencompra').click(function(e) {
    e.defaultPrevented;
    pagar_ordencompra();
  });
  $('#pagar_ordencompra_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          pagar_ordencompra();
      }
  });