console.log("login.js");

$(document).on("click", "#login", function () {
  //    loading();

  if (!$("#user").val() && !$("#password").val()) {
    Swal.fire({
      title: "Ingrese sus datos!",
      icon: "error",
    });
  } else {
    var user = $("#user").val();
    var password = $("#password").val();
    Swal.fire({
      title: "Cargando...",
      html: '<img src="images/loading.gif" width="300" height="175">',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCloseButton: false,
      showCancelButton: false,
      showConfirmButton: false,
    });
    $.ajax({
      url: "php/controllers/login.php",
      method: "POST",
      data: {
        mod: "getUserInfo",
        user: user,
        password: password,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          if (data.data[0].active == 0) {
            Swal.fire({
              title: "¡Usuario no activo!",
              text:
                "Estimado (a) " +
                data.data[0].nombres +
                " su cuenta no esta activa, por favor contacte al administrador",
              icon: "error",
            });
          } else {
            var nombre = data.data[0].nombres;
            Swal.fire({
              icon: "success",
              title: "Bienvenido (a) " + nombre + "!!",
              text: "Logueo exitoso!!",
              showConfirmButton: false,
              timer: 2000,
            }).then((result) => {
              Swal.fire({
                title: "Cargando...",
                html: '<img src="images/loading.gif" width="300" height="175">',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
              });
              location.href = "index.php";
            });
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Verifique los datos ingresados",
            text: "Error al iniciar sesión",
          });
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          icon: "error",
          title: "Verifique los datos ingresados",
          text: "Error al recibir la información",
        });
      });
  }
  /*   */
});
