//|console.log("load_creditos");
$(document).ready(function () {

    $(document).on("change", "#colaborador", function () {
        var colaborador = $(this).val();
        var rango_fechas = $("#rango_fechas").val();

        console.log(colaborador);
        console.log(rango_fechas);
     });
    
  
    
    function loading() {
      $(document).ready(function () {
        Swal.fire({
          title: "Cargando...",
          html: '<img src="images/loading.gif" width="300" height="175">',
          allowOutsideClick: false,
          allowEscapeKey: false,
          showCloseButton: false,
          showCancelButton: false,
          showConfirmButton: false,
        });
      });
    }
  });
  