//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("click", ".btn_SubirArchivo", function () {
    
    var txt_archivo = $(this).attr("data-nombre_archivo");
    var id_archivos_usuarios = $(this).attr("id");
    var html_input_type = $(this).attr("data-html_input_type");
    $("#lblSubirArchivo").text("CARGAR " + txt_archivo);
    $(".btnCargarArchivo").attr("id", id_archivos_usuarios);
    $("#div_input_archivo").empty();
    var input_html =
      '<label class="form-label">Seleccionar un archivo</label><input id="archivo_usuario"  class="form-control" type="file" accept="' +
      html_input_type +
      '" />';
    $("#div_input_archivo").append(input_html);
  });
  $(document).on("click", ".btnCargarArchivo", function () {
    var id_archivos_usuarios = $(this).attr("id");
    console.log(id_archivos_usuarios);
    const inputFile = document.querySelector("#archivo_usuario");

    if (inputFile.files.length <= 0) {
      Swal.close();
      Swal.fire({
        title: "Debe seleccionar un archivo",
        text: "",
        icon: "warning",
        timer: 3000,
      });
    } else {
      loading();
      let formData = new FormData();
      formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
      formData.append("id_archivos_usuarios", id_archivos_usuarios);

      fetch("php/controllers/personal/save_user_document.php", {
        method: "POST",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          console.log(decodificado);
          if (decodificado.response == true) {
            Swal.close();
            Swal.fire({
              title: "Archivo cargado correctamente",
              text: "",
              icon: "success",
              timer: 3000,
            }).then(function () {
              location.reload();
            });
          } else {
            Swal.fire({
              title: "Error al cargar",
              text: "",
              icon: "error",
              timer: 3000,
            });
          }
        });
    }
  });

  $("#id_area").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#subirArchivo").modal({ backdrop: "static", keyboard: false });
});

function loading(){
  $(document).ready(function() {
    Swal.fire({
        title: 'Cargando...',
        html: '<img src="images/loading.gif" width="300" height="175">',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: false,
    })
});
}