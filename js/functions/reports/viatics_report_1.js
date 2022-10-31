//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("change", "#colaborador", function () {
    var colaborador = $(this).val();

    var rango_fechas = $("#rango_fechas").val();
    var fecha_1 = rango_fechas.split("-")[0].trim();
    var fecha_2 = rango_fechas.split("-")[1].trim();
    console.log(colaborador);
    console.log(rango_fechas);

    var url = window.location.search;
    const urlParams = new URLSearchParams(url);
    if (urlParams.has("submodule")) {
      //--- --- ---//
      const submodule = urlParams.get("submodule");
      window.location.search =
        "?submodule=" +
        submodule +
        "&colaborador=" +
        colaborador +
        "&fecha_1=" +
        fecha_1 +
        "&fecha_2=" +
        fecha_2;
      //--- --- ---//
    }
  });
  $(document).on("change", "#rango_fechas", function () {
   $("#colaborador").val("");
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
