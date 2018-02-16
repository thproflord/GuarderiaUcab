function busqueda(){
  $.ajax({
    type:"GET",
    url: "api/ejercicios/getTres",
    data: $("#busqueda_form").serialize(),
    success: function(json){
      $("#ejercicios_body").empty();
      for (var i = 0; i < json.length; i++){
        $("#ejercicios_body").append(`<tr>
          <td>${json[i].id_ejercicio}</td>
          <td>${json[i].descripcion}</td>                                                                                                    
          <td><a type="button" data-toggle="modal" data-target="#modal_editar_ejercicio" onclick="edit_ejercicios('${json[i].descripcion}',${json[i].id_ejercicio})"><i class="fa fa-edit"></i></a></td>        
          <td><a type="button" href="ejercicios/eliminar/${json[i].id_ejercicio}"><i class="fa fa-trash"></i></a></td>   
          </tr>`);
      }
    },
    error : function(xhr, status) {
      alert('Ha ocurrido un problema.');
    }
  })
}

/**
 * Ajax action to api rest
*/
function crear_ejercicios(){
  $.ajax({
    type : "POST",
    url : "api/ejercicios/crear",
    data : $('#crear_ejercicio_form').serialize(),
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
$('#crear_ejercicio').click(function(e) {
  e.defaultPrevented;
  crear_ejercicios()
});
$('#crear_ejercicio_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
      crear_ejercicios()
    }
});