function busqueda(){
  $.ajax({
    type:"GET",
    url: "api/horarios/getTres",
    data: $("#busqueda_form").serialize(),
    success: function(json){
      $("#horarios_body").empty();
      for (var i = 0; i < json.length; i++){
        $("#horarios_body").append(`<tr>
        <td>${ json[i].anio_ini_horario }</td>
        <td>${ json[i].anio_fin_horario }</td>
        <td>${ json[i].dia }</td>
        <td>${ json[i].hora_ini }</td>
        <td>${ json[i].hora_fin }</td>
        <td>${ json[i].nombre_sede }</td>
        <td>${ json[i].nombre_categoria }</td>
                                                                                                       
      <td><a type="button" data-toggle="modal" data-target="#modal_editar_horario" onclick="edit_horarios(${ json[i].anio_ini_horario },${ json[i].anio_fin_horario },'${ json[i].dia }',${ json[i].hora_ini },${ json[i].hora_fin },${ json[i].codigo_sede },'${ json[i].nombre_categoria }')"><i class="fa fa-edit"></i></a></td>
      
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
function crear_horarios(){
  $.ajax({
    type : "POST",
    url : "api/horarios/crear",
    data : $('#crear_horario_form').serialize(),
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
$('#crear_horario').click(function(e) {
  e.defaultPrevented;
  crear_horarios();
});
$('#crear_horario_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
      crear_horarios();
    }
});