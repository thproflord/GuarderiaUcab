function crear_categorias(){
    $.ajax({
      type : "POST",
      url : "api/categorias/crear",
      data : $('#crear_categoria_form').serialize(),
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
  $('#crear_categoria').click(function(e) {
    e.defaultPrevented;
    crear_categorias();
  });
  $('#crear_categoria_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_categorias();
      }
  });