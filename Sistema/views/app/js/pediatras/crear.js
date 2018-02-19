<<<<<<< HEAD
=======

/**
 * Ajax action to api rest
*/
>>>>>>> 3409342a728c6b29040819f0da8bde756bcb71d0
function crear_pediatra(){
    $.ajax({
      type : "POST",
      url : "api/pediatras/crear",
      data : $('#crear_pediatra_form').serialize(),
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
<<<<<<< HEAD
  
  /**
   * Events
   *  
   * @param {*} e 
=======

  /**
   * Events
   *
   * @param {*} e
>>>>>>> 3409342a728c6b29040819f0da8bde756bcb71d0
   */
  $('#crear_pediatra').click(function(e) {
    e.defaultPrevented;
    crear_pediatra();
  });
  $('#crear_pediatra_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_pediatra();
      }
<<<<<<< HEAD
  });
=======
  });
>>>>>>> 3409342a728c6b29040819f0da8bde756bcb71d0
