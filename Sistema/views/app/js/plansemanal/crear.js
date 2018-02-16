function busqueda(){
  $.ajax({
    type:"GET",
    url: "api/plansemanal/getTres",
    data: $("#busqueda_form").serialize(),
    success: function(json){
      $("#plansemanal_body").empty();
      for (var i = 0; i < json.length; i++){
        $("#plansemanal_body").append(`<tr>
        <td>${ json[i].nombre_plan }</td>
        <td>${ json[i].ejercicio }</td>
        <td>${ json[i].nombre_categoria }</td>
        <td>${ json[i].posicion }</td>
        <td>${ json[i].duracion}</td> 
      
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
function crear_plansemanal(){
  $.ajax({
    type : "POST",
    url : "api/plansemanal/crear",
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
  crear_plansemanal();
});
$('#crear_plan_form').keypress(function(e) {
    e.defaultPrevented;
    if(e.which == 13) {
        crear_plansemanal();
    }
});