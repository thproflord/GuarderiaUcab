function busqueda(){
  $.ajax({
    type:"GET",
    url: "api/planentrenamiento/getTres",
    data: $("#busqueda_form").serialize(),
    success: function(json){
      $("#planentrenamiento_body").empty();
      for (var i = 0; i < json.length; i++){
        $("#planentrenamiento_body").append(`<tr>
        <td>${ json[i].nombre }</td>
        <td>${json[i].tipo}</td>
        <td>${ json[i].duracion }</td>
        <td>${ json[i].anio_ini }</td>
        <td>${ json[i].anio_fin }</td>
        <td>${ json[i].nombre_sede }</td>
        <td>${ json[i].dia }</td>
        <td>${ json[i].nombre_entrenador }</td>
                                                                                                       
      <td><a type="button" data-toggle="modal" data-target="#modal_editar_plan" onclick="edit_plan('${ json[i].nombre }', ${ json[i].duracion }, ${ json[i].ci_entrenador }, '${ $.tipo }', ${ json[i].id_entrenamiento }, ${ json[i].id_horario })"><i class="fa fa-edit"></i></a></td>        
      <td><a type="button" href="planentrenamiento/eliminar/${ json[i].id_entrenamiento }"><i class="fa fa-trash"></i></a></td>  
      
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
function crear_planentrenamiento(){
  $.ajax({
    type : "POST",
    url : "api/planentrenamiento/crear",
    data : $('#crear_plan_form').serialize(),
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
$('#crear_plan').click(function(e) {
  e.defaultPrevented;
  crear_planentrenamiento();
});
$('#crear_plan_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_planentrenamiento();
    }
});