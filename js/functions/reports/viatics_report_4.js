//|console.log("load_creditos");
$(document).ready(function () {
    $(document).on("change", "#colaborador", function () {
      var txt_colaborador = $(this).val();
      var arr_colaborador = txt_colaborador.split(" ");
      var colaborador = "";
      for (let index = 0; index < arr_colaborador.length; index++) {
        if (index == (arr_colaborador.length - 1)) {
          colaborador += arr_colaborador[index];
        } else {
          colaborador += arr_colaborador[index] + "-";
        }
      }
      
      var url = window.location.search;
      const urlParams = new URLSearchParams(url);
      if (urlParams.has("submodule")) {
        //--- --- ---//
        const submodule = urlParams.get("submodule");
        window.location.search =
          "?submodule=" +
          submodule +
          "&colaborador=" +
          colaborador;
        //--- --- ---//
      }
    });
    $(document).on("change", "#tgasto", function () {
        var tgasto = $(this).val();
        var txt_colaborador = $("#colaborador option:selected").val();
        var arr_colaborador = txt_colaborador.split(" ");
        var colaborador = "";
        for (let index = 0; index < arr_colaborador.length; index++) {
          if (index == (arr_colaborador.length - 1)) {
            colaborador += arr_colaborador[index];
          } else {
            colaborador += arr_colaborador[index] + "-";
          }
        }
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
            fecha_2+
            "&tgasto=" +
            tgasto;
          //--- --- ---//
        }
      });
    $(document).on("change", "#rango_fechas", function () {
     
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
  