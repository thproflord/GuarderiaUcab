var enfermedades = 0;

function add_fecha(){
  if ($('#enfermedad_crear').val().length > enfermedades){
    enfermedades = $('#enfermedad_crear').val().length;
    $('#fechas').append(`<input type="date" class="form-control" placeholder="Fecha de contagio" name="fecha_contagio[]" id="fecha_${enfermedades}">`);
  }
  else if ($('#enfermedad_crear').val().length < enfermedades){
    $(`#fecha_${enfermedades}`).remove();
    enfermedades = enfermedades - 1;
  }
}

function empty_fechas(){
  $('#fechas').empty();
  enfermedades = 0;
}

function crear_nino(){
    $.ajax({
      type : "POST",
      url : "api/ninos/crear",
      data : $('#crear_nino_form').serialize(),
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
  $('#crear_nino').click(function(e) {
    e.defaultPrevented;
    crear_nino();
  });
  $('#crear_nino_form').keypress(function(e) {
      e.defaultPrevented;
      if(e.which == 13) {
          crear_nino();
      }
  });