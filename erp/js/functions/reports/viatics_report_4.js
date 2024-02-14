//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("change", "#colaborador", function () {
    var txt_colaborador = $(this).val();
    var arr_colaborador = txt_colaborador.split(" ");
    var colaborador = "";
    for (let index = 0; index < arr_colaborador.length; index++) {
      if (index == arr_colaborador.length - 1) {
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
        "?submodule=" + submodule + "&colaborador=" + colaborador;
      //--- --- ---//
    }
  });
  $(document).on("change", "#tgasto", function () {
    var tgasto = $(this).val();
    var txt_colaborador = $("#colaborador option:selected").val();
    var arr_colaborador = txt_colaborador.split(" ");
    var colaborador = "";
    for (let index = 0; index < arr_colaborador.length; index++) {
      if (index == arr_colaborador.length - 1) {
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
        fecha_2 +
        "&tgasto=" +
        tgasto;
      //--- --- ---//
    }
  });
  $(document).on("change", "#rango_fechas", function () {});

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

  const sheetName = $(".tableReport").attr("data-table-name");
  $(".tableReport").tableExport({
    headers: true, // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
    footers: true, // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ["xlsx"], // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
    filename: sheetName, // (id, String), filename for the downloaded file, (default: 'id')
    bootstrap: false, // (Boolean), style buttons using bootstrap, (default: true)
    exportButtons: true, // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
    position: "top", // (top, bottom), position of the caption element relative to table, (default: 'bottom')
    ignoreRows: null, // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
    ignoreCols: null, // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
    trimWhitespace: true, // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
    RTL: false, // (Boolean), set direction of the worksheet to right-to-left (default: false)
    sheetname: "id",
  });

  $(".xlsx").addClass("btn btn-success");
  $(".xlsx").html('<i class="fa-solid fa-file-excel"></i>');
});
