/**
 * Ajax action to api rest
*/
function edit_costos(a,b,c,d){

    $('#id_costo_3dias').val(a);
    $('#id_costo_5dias').val(b);
    $('#id_mensualidad').val(c);
    $('#id_costouniforme').val(d);

}



function editar_costos(){
    $.ajax({
      type : "POST",
      url : "api/costos/editar",
      data : $('#editar_costos_form').serialize(),
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
  $('#editar_costos').click(function(e) {
    e.defaultPrevented;
    editar_costos();
  });
  $('#editar_costos_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
        editar_costos();
      }
  });