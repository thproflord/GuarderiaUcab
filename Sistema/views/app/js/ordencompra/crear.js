function create_ordencompra(){
    $('#contador').val(1);
}

/**
 * Ajax action to api rest
*/
function crear_ordencompra(){
    $.ajax({
      type : "POST",
      url : "api/ordencompra/crear",
      data : $('#crear_ordencompra_form').serialize(),
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
  



/*Agrega un selector con la lista de productos , un input para colocar la cantidad y el precio*/
function agregar_producto(){

var sede = parseInt(document.getElementById('id_codigo_sede').value , 10);
var contador = parseInt(document.getElementById('contador').value , 10);

if(sede>0){

    $.ajax({
      type : "GET",
      url : "api/traerproductos/" + sede  ,
      success : function(json) {

        /*Agrega un select , un input para el precio , otro para la cantidad y un button de eliminar*/
        $('.clase_productos').append(`

        <label id="nombre_producto_${contador}" >Producto ${contador} </label>

        <select class="form-control select_${contador}" name="lista_productos[]" onchange="traer_precio_productos(${contador})">
        <option disabled selected value></option>
        </select>

        <input type="number" class="form-control" placeholder="Precio por unidad"  id="precio_producto_${contador}" name="precios_pago[]" readonly="readonly">
        <input type="number" class="form-control" placeholder="Cantidad" id="cantidad_producto_${contador}"  name="cantidades_pago[]">
        <button type="button" id="eliminar_producto_${contador}" class="btn btn-primary">Delete</button>
        `);

        /*Elimina el producto contador*/
        $(`#eliminar_producto_${contador}`).click(function(e) {
          e.defaultPrevented;
          
          $( `#nombre_producto_${contador-1}` ).remove();
          $( `.select_${contador-1}` ).remove();
          $( `#precio_producto_${contador-1}` ).remove();
          $( `#cantidad_producto_${contador-1}` ).remove();
          $( `#eliminar_producto_${contador-1}` ).remove();
        });

        /*Agrega la lista de productos al select contador*/
        for (var i = 0; i< json.length; i++){
          $(`.select_${contador}`).append(`
          <option value="${ json[i].codigo_producto }">${ json[i].descripcion }</option>
        `);
        }

        



contador++;
$('#contador').val(contador);

      }, 
      error : function(xhr, status) {
        error_toastr('Error', 'Ha ocurrido un problema');
      }
    });

}
}


function traer_precio_productos(id_selector){

  var id_producto =  $(`.select_${id_selector}`).val();

  $.ajax({
    type : "GET",
    url : "api/traerprecioproducto/" + id_producto  ,
    success : function(json) {
      

      $(`#precio_producto_${id_selector}`).val( json[0].precio );

    }, 
    error : function(xhr, status) {
      error_toastr('Error', 'Ha ocurrido un problema');
    }
  });


  }




/*Borra todos los select e imputs del select y resetea el contador*/
function reset_productos(){
$('.clase_productos').empty();
$('#contador').val(1); 
}



  /**
   * Events
   *  
   * @param {*} e 
   */
  $('#crear_ordencompra').click(function(e) {
    e.defaultPrevented;
    crear_ordencompra();
  });
  $('#crear_ordencompra_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_ordencompra();
      }
  });