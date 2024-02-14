$(document).on("click", ".sendEmail", function () {
  loading();
  var id_personal = $(this).attr("id-personal");
  $.ajax({
    url: "php/controllers/personal/personal_controller.php",
    method: "POST",
    data: {
      mod: "sendViaticsMail",
      id_personal: id_personal,
    },
  })
    .done(function (data) {
      var data = JSON.parse(data);
      console.log(data);

      if (data.response == true) {
        Swal.fire({
          icon: "success",
          title: "Correo enviado",
          text: data.message,
          showConfirmButton: false,
          timer: 1500,
        });
        /*  Swal.fire("Éxito!", data.message, "success").then((result) => {
                   if (result.isConfirmed) {
                     loading();
                     location.reload();
                   }
                 }); */
      } else {
        Swal.fire("Atención!", data.message, "info");
      }
      //--- --- ---//
      //--- --- ---//
    })
    .fail(function (message) {
      VanillaToasts.create({
        title: "Error",
        text: "Ocurrió un error, intentelo nuevamente",
        type: "error",
        timeout: 1200,
        positionClass: "topRight",
      });
    });
});

$(document).on("click", ".sendMailsViatics", function () {
  loading();
  var id_personal = $(this).attr("id-personal");
  $.ajax({
    url: "php/controllers/personal/personal_controller.php",
    method: "POST",
    data: {
      mod: "sendViaticsMailMasive",
    },
  })
    .done(function (data) {
      var data = JSON.parse(data);
      console.log(data);

      if (data.response == true) {
        Swal.fire({
          icon: "success",
          title: "Correo enviado",
          text: data.message,
          showConfirmButton: false,
          timer: 1500,
        });
        /*  Swal.fire("Éxito!", data.message, "success").then((result) => {
                   if (result.isConfirmed) {
                     loading();
                     location.reload();
                   }
                 }); */
      } else {
        Swal.fire("Atención!", data.message, "info");
      }
      //--- --- ---//
      //--- --- ---//
    })
    .fail(function (message) {
      VanillaToasts.create({
        title: "Error",
        text: "Ocurrió un error, intentelo nuevamente",
        type: "error",
        timeout: 1200,
        positionClass: "topRight",
      });
    });
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