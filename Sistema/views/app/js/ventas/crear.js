/**
 * Ajax action to api rest
*/
function crear_venta(){
    $.ajax({
      type : "POST",
      url : "api/ventas/crear",
      data : $('#crear_venta_form').serialize(),
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
  

  function traerrepresentado(){
    var cedula = document.getElementById('id_ci_representante').value;

    $('.selector_representado').empty();
    $('.selector_sede').empty();
    $('.cantidad_stock').empty();

    $.ajax({
      type : "GET",
      url : "api/traerhijos/" + cedula,
      success : function(json) {

        $('.selector_representado').append(new Option());

        for (var i = 0; i< json.length; i++){
              $('.selector_representado').append(new Option(
                  json[i].nombre,
                  json[i].id_jugador,
                  false,
                  false
              ));
        }
      },
      error : function(xhr, status) {
        error_toastr('Error', 'Ha ocurrido un problema');
      }
    });

  }


function buscarSedeInscripcion(){

  var id = document.getElementById('id_id_jugador').value;

  $('.selector_sede').empty();
  $('.cantidad_stock').empty();
  
  $.ajax({
    type : "GET",
    url : "api/traersedeinscripcion/" + id,
    success : function(json) {
      
      $('.selector_sede').append(new Option());

            $('.selector_sede').append(new Option(
                json[0].nombre_sede,
                json[0].codigo_sede,
                false,
                false
            ));
      
    },
    error : function(xhr, status) {
      error_toastr('Error', 'Ha ocurrido un problema');
    }
  });
}



  function buscar_cantidad(){
    
    var sede = parseInt(document.getElementById('id_sede').value, 10);
    var uniforme;

    if(sede>0){

          if($("#id_uniforme_entrenamiento").is(':checked')) {  
            uniforme=1;  
          } else {  
            uniforme=2;   
          } 

        
          $('.cantidad_stock').empty();
          $.ajax({
            type : "GET",
            url : "api/traerUniformes/sedeytipo/" + sede + "/" + uniforme,
            success : function(json) {

              $(".cantidad_stock").append(`<li>Cantidad sobrante ${ json[0].cantidad }</li>`);  
              $("#id_stock").val(json[0].cantidad);
              $("#id_stock_minimo").val(json[0].cantidad_minima);
            },
            error : function(xhr, status) {
              error_toastr('Error', 'Ha ocurrido un problema');
            }
          });

      }
    



  }


  /**
   * Events
   *  
   * @param {*} e 
   */
  $('#crear_venta').click(function(e) {
    e.defaultPrevented;
    crear_venta();
  });
  $('#crear_venta_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_venta();
      }
  });