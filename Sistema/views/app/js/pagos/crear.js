function create_pago(cedula,numero,tipo,id,añoini,añofin,total,cuniforme,tunif){

    /*Facturas*/
  if (tipo==0){
    $('#id_id_representante').val(cedula);   
    $('#id_numero_factura').val(numero);  
    $('#id_monto').val(id*cuniforme);  
    $('#id_id_jugadore').val(añoini);
    $('#id_cantidad_pagos').val(añofin);
    $('#id_suma_pagos').val(total);
    $('#id_costo_compra').val(id*cuniforme);
    $('#id_cantidad_ajuste').val(id);
    $('#id_tipo_unif').val(tunif);
  }else 
  /*Mensualidades*/
   if(tipo==1){
    $('#id_id_representante').val(cedula);   
    $('#id_codigo_mensualidad').val(numero); 
    $('#id_id_jugadore').val(id); 
    $('#id_monto').val(añoini); 
     
   }else
   /*Inscripciones*/
   if(tipo==2){
    $('#id_id_representante').val(cedula);
    $('#id_id_jugadore').val(id);   
    $('#id_año_ini').val(añoini);
    $('#id_año_fin').val(añofin);
    $('#id_monto').val(numero);     
   }
    
}



function crear_pago(validador){


  if(validador==0){         
    $.ajax({
              type : "POST",
              url : "api/pagos/crear",
              data : $('#crear_pago_form').serialize(),
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
      }else
      {
        alert('Debe completar el pago total.');
      }


}




/**
 * Ajax action to api rest
*/
function verific_factura(){//parseInt(document.getElementById('id_monto').value, 10); 
var cant_pagos = parseInt($('#id_cantidad_pagos').val() , 10);  
var suma_pagos = parseInt( $('#id_suma_pagos').val(), 10);     
var costo_total = parseInt($('#id_costo_compra').val(), 10);   
var pago_actual = parseInt($('#id_monto').val(), 10);          
var validador=0;


  /*Valida que con el tercer pago se cumpla la cuota total , si no , no se hace el pago*/
  if(cant_pagos==2){
    if( (suma_pagos+pago_actual)<costo_total ){
      validador=1;
    }

  }
  crear_pago(validador); 
}
  


  /**
   * Events
   *  
   * @param {*} e 
   */
  $('#crear_pago').click(function(e) {
    e.defaultPrevented;

    if( isNaN(parseInt($('#id_numero_factura').val() , 10)) ){
       crear_pago(0);
    }else{
      verific_factura();
    }

  });


  $('#crear_pago_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {

      if( isNaN(parseInt($('#id_numero_factura').val() , 10)) ){
       crear_pago(0);
      }else{
      verific_factura();
      }

      }
  });