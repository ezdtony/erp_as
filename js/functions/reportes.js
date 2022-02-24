$(document).ready(function () {
  $(document).on("change", "#id_proyecto", function () {
    var id_proyecto = $(this).val();
    var url = window.location.search;
    const urlParams = new URLSearchParams(url);
    if (urlParams.has("submodule")) {
      //--- --- ---//

      const submodule = urlParams.get("submodule");
      window.location.search =
        "submodule=" + submodule + "&id_proyecto=" + id_proyecto;
      //--- --- ---//
    }
  });

  $("#estado_dir").select2({
    dropdownParent: $("#registrarUsuario"),
  });

  $("#id_titulo").select2({
    dropdownParent: $("#registrarUsuario"),
  });
});
