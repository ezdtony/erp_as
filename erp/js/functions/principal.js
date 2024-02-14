$(document).ready(function () {
  $(document).on("click", ".btn_registrar_usuario", function () {
    var accede = 0;
    /*  $("#exampleModal").find("input,textarea,select").val("");
    $("#exampleModal input[type='checkbox']").prop("checked", false).change(); */

    var $inputs = $("#registrarUsuario").find("input,textarea,select"); //INPUTS
    var $selects = $("#registrarUsuario").find("select"); //SELECTS

    $inputs.each(function (index, element) {
      if ($(element).val() == "") {
        $(element).css("border", "solid 2px #FA5858");
        accede = 1;
      }
    });

    $selects.each(function (index, element) {
      if ($(element).val() == "") {
        $(element).css("border-color", "solid 2px #FA5858 !important");
        accede = 1;
      }
    });
    if (accede == 1) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Por favor complete todos los campos",
      });
    } else {
      var nombre = $("#nombres").val();
      var apellido = $("#apellidos").val();
      var titulo = $("#id_titulo").val();
      var area = $("#areas_registrar").val();
      var puesto = $("#areas_puesto").val();
      var telefono = $("#telefono").val();
      var calle = $("#calle").val();
      var numero = $("#numero_dir").val();
      var colonia = $("#colonia_dir").val();
      var cp = $("#cp_dir").val();
      var municipio = $("#municipio_dir").val();
      var estado = $("#estado_dir").val();
      var correo_electronico = $("#correo_electronico").val();
      var password = $("#password").val();

      console.log(nombre);
      console.log(apellido);
      console.log(titulo);
      console.log(area);
      console.log(puesto);
      console.log(telefono);

      console.log(calle);
      console.log(numero);
      console.log(colonia);
      console.log(cp);
      console.log(municipio);
      console.log(estado);
      console.log(correo_electronico);
      console.log(password);

      $.ajax({
        url: "php/controllers/main_controller.php",
        method: "POST",
        data: {
          mod: "saveUser",
          nombre: nombre,
          apellido: apellido,
          titulo: titulo,
          area: area,
          puesto: puesto,
          telefono: telefono,
          calle: calle,
          numero: numero,
          colonia: colonia,
          cp: cp,
          municipio: municipio,
          estado: estado,
          correo_electronico: correo_electronico,
          password: password,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              title: "¡Registro exitoso!",
              text: "Se agregó el usuario correctamente",
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
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
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    }
  });

  $(document).on("click", ".btn_registrar_proveedor", function () {
    var nombre = $("#nombre_prov").val();
    var empresa = $("#empresa_prov").val();
    var telefono = $("#telefono_prov").val();
    var correo_electronico = $("#correo_electronico_prov").val();

    if (nombre == "" || empresa == "" || telefono == "" || correo_electronico == "") {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Por favor complete todos los campos",
      });
    } else {
      $.ajax({
        url: "php/controllers/main_controller.php",
        method: "POST",
        data: {
          mod: "saveProveedor",
          nombre: nombre,
          empresa: empresa,
          telefono: telefono,
          correo_electronico: correo_electronico,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              title: "¡Registro exitoso!",
              text: "Se agregó el proveedor correctamente",
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
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
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    }
  });

  $(document).on("click", ".btn_registrar_utilizacion", function () {
    var nombre = $("#nombre_ut").val();

    if (nombre == ""){
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Por favor complete todos los campos",
      });
    } else {
      $.ajax({
        url: "php/controllers/main_controller.php",
        method: "POST",
        data: {
          mod: "saveUtilizacion",
          nombre: nombre
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              title: "¡Registro exitoso!",
              text: "Se agregó  correctamente",
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
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
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    }
  });
  $(document).on("click", ".btn_registrar_medicion", function () {
    var nombre = $("#nombre_med").val();

    if (nombre == ""){
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Por favor complete todos los campos",
      });
    } else {
      $.ajax({
        url: "php/controllers/main_controller.php",
        method: "POST",
        data: {
          mod: "saveMedicion",
          nombre: nombre
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              title: "¡Registro exitoso!",
              text: "Se agregó correctamente",
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
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
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    }
  });
  $(document).on("click", ".unactive_user", function () {
    var id_user = $(this).attr("id");
    console.log(id_user);
    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusUser",
        id_user: id_user,
        active: "0",
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
          location.reload();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Ocurrió un error al realizar la petición",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });
  $(document).on("click", ".active_user", function () {
    var id_user = $(this).attr("id");

    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusUser",
        id_user: id_user,
        active: "1",
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
          location.reload();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Ocurrió un error al realizar la petición",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });
  $(document).on("click", ".delete_user", function () {
    var id_user = $(this).attr("id");

    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "deleteUser",
        id_user: id_user,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
          location.reload();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Ocurrió un error al realizar la petición",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });

  $(document).on("click", ".unactive_proveedor", function () {
    var id_user = $(this).attr("id");
    console.log(id_user);
    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusProveedor",
        id_user: id_user,
        active: "0",
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
          location.reload();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Ocurrió un error al realizar la petición",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });
  $(document).on("click", ".active_proveedor", function () {
    var id_user = $(this).attr("id");

    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusProveedor",
        id_user: id_user,
        active: "1",
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
          location.reload();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Ocurrió un error al realizar la petición",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });
  $(document).on("click", ".delete_proveedor", function () {
    var id_user = $(this).attr("id");

    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "deleteProveedor",
        id_user: id_user,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
          location.reload();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Ocurrió un error al realizar la petición",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });

  $(document).on("click", "#generate_password", function () {
    $("#password").val(autoCreate(6));
  });
  $(document).on("change", "#areas_registrar", function () {
    var id_area = this.value;
    $.ajax({
      url: "php/controllers/main_controller.php",
      method: "POST",
      data: {
        mod: "getAreaLevelsByAreaCode",
        id_area: id_area,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#areas_puesto").empty();
          $("#areas_puesto").removeAttr("disabled");
          $("#areas_puesto").append(
            '<option value="" disabled>Seleccione un puesto</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#areas_puesto").append(
              '<option value="' +
                data.data[i].id_areas_level +
                '">' +
                data.data[i].level_description +
                "</option>"
            );
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Verifique los datos ingresados",
          });
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
  $(document).on("change", "#estado_dir", function () {
    var id_estado = this.value;
    $.ajax({
      url: "php/controllers/directions_controller.php",
      method: "POST",
      data: {
        mod: "getMunicipios",
        id_estado: id_estado,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#municipio_dir").empty();
          $("#municipio_dir").removeAttr("disabled");
          $("#municipio_dir").append(
            '<option value="" disabled>Seleccione un municipio</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#municipio_dir").append(
              '<option value="' +
                data.data[i].id +
                '">' +
                data.data[i].municipio +
                "</option>"
            );
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Verifique los datos ingresados",
          });
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

  function autoCreate(plength) {
    var chars =
      "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    var password = "";
    for (i = 0; i < plength; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    return password;
  }
  $("#estado_dir").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#municipio_dir").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#areas_registrar").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#areas_puesto").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#id_titulo").select2({
    dropdownParent: $("#registrarUsuario"),
  });
});
