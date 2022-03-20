//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("click", ".editUser", function () {
    var id = $(this).attr("id");
    $(".saveUserChanges").attr("id", id);
    var action = "editUser";
    $.ajax({
      url: "php/controllers/personal/crud_users.php",
      method: "POST",
      data: {
        mod: "getUserData",
        id_user: id,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data.data[0]);

        /* Info general */
        $("#edit_id_area").val(data.data[0].id_area);
        $("#id_area_level").val(data.data[0].id_niveles_areas);
        $("#id_academic_level").val(data.data[0].id_academic_level);
        $("#edit_id_genero").val(data.data[0].genero);
        $("#edit_nombre").val(data.data[0].nombres);
        $("#edit_ap_paterno").val(data.data[0].apellido_paterno);
        $("#edit_ap_materno").val(data.data[0].apellido_materno);
        $("#edit_curp").val(data.data[0].curp);
        $("#edit_nss").val(data.data[0].nss);
        $("#edit_fecha_nacimiento").val(data.data[0].fecha_nacimiento);
        $("#edit_rfc").val(data.data[0].rfc);
        $("#edit_id_estado_civil").val(data.data[0].id_estado_civil);

        /* Info domicilio */
        $("#edit_calle").val(data.data[0].direccion_calle);
        $("#edit_numero").val(data.data[0].direccion_numero_ext);
        $("#edit_edit_colonia").val(data.data[0].direccion_colonia);
        $("#edit_cp").val(data.data[0].direccion_zipcode);
        /* id_municipio = $("#edit_id_municipio option:selected").text(data.data[0].);
        id_estado = $("#edit_id_estado option:selected").text(data.data[0].); */

        /* Info de contacto */
        $("#edit_telefono_pricnipal").val(data.data[0].telefono_pricnipal);
        $("#edit_telefono_secundario").val(data.data[0].telefono_secundario);
        $("#edit_correo_personal").val(data.data[0].correo_electronico);
        $("#edit_telefono_familiar_pricnipal").val(
          data.data[0].telefono_familiar_1
        );
        $("#edit_telefono_familiar_secundario").val(
          data.data[0].telefono_familiar_2
        );

        /* Info de login */
        $("#edit_email_login").val(data.data[0].correo_sesion);
        $("#edit_password").val(data.data[0].password);

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
  $(document).on("click", ".saveUserChanges", function () {
    var id = $(this).attr("id");

   

    id_area = $("#edit_id_area").val();
    id_niveles_areas = $("#edit_id_area_level option:selected").val();
    id_academic_level = $("#edit_id_academic_level option:selected").val();
    id_genero = $("#edit_id_genero").val();
    nombre = $("#edit_nombre").val();
    ap_paterno = $("#edit_ap_paterno").val();
    ap_materno = $("#edit_ap_materno").val();
    curp = $("#edit_curp").val();
    nss = $("#edit_nss").val();
    fecha_nacimiento = $("#edit_fecha_nacimiento").val();
    rfc = $("#edit_rfc").val();
    calle = $("#edit_calle").val();
    numero = $("#edit_numero").val();
    colonia = $("#edit_colonia").val();
    cp = $("#edit_cp").val();
    id_municipio = $("#edit_id_municipio option:selected").text();
    id_estado = $("#edit_id_estado option:selected").text();
    telefono_pricnipal = $("#edit_telefono_pricnipal").val();
    telefono_secundario = $("#edit_telefono_secundario").val();
    correo_personal = $("#edit_correo_personal").val();
    telefono_familiar_pricnipal = $("#edit_telefono_familiar_pricnipal").val();
    telefono_familiar_2 = $("#edit_telefono_familiar_secundario").val();
    email_login = $("#edit_email_login").val();
    password_login = $("#edit_password").val();
    console.log(fecha_nacimiento);
    if (
      id_niveles_areas == "" ||
      id_academic_level == "" ||
      id_genero == "" ||
      fecha_nacimiento == "" ||
      nombre == "" ||
      ap_paterno == "" ||
      ap_materno == "" ||
      curp == "" ||
      calle == "" ||
      numero == "" ||
      colonia == "" ||
      cp == "" ||
      id_municipio == "" ||
      id_estado == "" ||
      telefono_pricnipal == "" ||
      correo_personal == "" ||
      telefono_familiar_pricnipal == "" ||
      email_login == "" ||
      password_login == ""
    ) {
    
      Swal.fire({
        title: "Atención!",
        text: "Debe llenar todos los campos",
        icon: "error",
        confirmButtonText: "Ok",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/personal/crud_users.php",
        method: "POST",
        data: {
          mod: "updateUser",
          id_user: id,
          id_area: id_area,
          id_niveles_areas: id_niveles_areas,
          id_academic_level: id_academic_level,
          id_genero: id_genero,
          nombre: nombre,
          ap_paterno: ap_paterno,
          ap_materno: ap_materno,
          curp: curp,
          nss: nss,
          fecha_nacimiento: fecha_nacimiento,
          rfc: rfc,
          calle: calle,
          numero: numero,
          colonia: colonia,
          cp: cp,
          id_municipio: id_municipio,
          id_estado: id_estado,
          telefono_pricnipal: telefono_pricnipal,
          telefono_secundario: telefono_secundario,
          correo_personal: correo_personal,
          telefono_familiar_pricnipal: telefono_familiar_pricnipal,
          telefono_familiar_2: telefono_familiar_2,
          email_login: email_login,
          password_login: password_login,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          Swal.close();
          if (data.response == true) {
            Swal.fire({
              title: "Datos Actualizados!",
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
          Swal.close();
          Swal.fire({
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    }
  });
  $(document).on("click", ".deleteUser", function () {
    var id = $(this).attr("id");
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Una vez eliminado no podrás recuperar este registro",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        loading();
        $.ajax({
          url: "php/controllers/personal/crud_users.php",
          method: "POST",
          data: {
            mod: "deleteUser",
            id_user: id
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            Swal.close();
            if (data.response == true) {
              Swal.fire({
                title: "Usuario eliminado con éxito!",
                icon: "success",
                timer: 1000,
              }).then((result) => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Error al eliminar colaborador",
              });
            }
            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {
            Swal.close();
            Swal.fire({
              title: "Datos no registrados!",
              text: "Ocurrió un error al guardar la información",
              icon: "info",
            });
          });
      }
    });
     
    
  });
  $(document).on("change", "#edit_id_area", function () {
    const id_area = $(this).val();
    $.ajax({
      url: "php/controllers/personal/personal_controller.php",
      method: "POST",
      data: {
        mod: "getAreaLevelsByAreaID",
        id_area: id_area,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#edit_id_area_level").empty();
          $("#edit_id_area_level").prop("disabled", false);
          $("#edit_id_area_level").append(
            '<option value="">Seleccione un puesto *</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#edit_id_area_level").append(
              '<option value="' +
                data.data[i].id_niveles_areas +
                '">' +
                data.data[i].descripcion_niveles_areas +
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
  $(document).on("change", "#edit_id_estado", function () {
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
        $("#edit_id_municipio").prop("disabled", false);
        if (data.response == true) {
          $("#edit_id_municipio").empty();
          $("#edit_id_municipio").append(
            '<option value="">Seleccione un municipio</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#edit_id_municipio").append(
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
  $(document).on("click", "#generate_password", function () {
    $("#edit_password").val(autoCreate(6));
  });

  $("#edit_id_area").select2({
    dropdownParent: $("#editarUsuario"),
  });
  $("#edit_id_genero").select2({
    dropdownParent: $("#editarUsuario"),
  });
  $("#edit_id_area_level").select2({
    dropdownParent: $("#editarUsuario"),
  });
  $("#edit_id_academic_level").select2({
    dropdownParent: $("#editarUsuario"),
  });

  $("#edit_id_estado").select2({
    dropdownParent: $("#editarUsuario"),
  });

  $("#edit_id_municipio").select2({
    dropdownParent: $("#editarUsuario"),
  });
  $("#edit_id_estado_civil").select2({
    dropdownParent: $("#editarUsuario"),
  });
  $("#edit_id_genero").select2({
    dropdownParent: $("#editarUsuario"),
  });

  $("#editarUsuario").modal({ backdrop: "static", keyboard: false });
  $("#edit_id_academic_level").modal({ backdrop: "static", keyboard: false });

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

  function autoCreate(plength) {
    var chars =
      "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    var password = "";
    for (i = 0; i < plength; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    return password;
  }
});
