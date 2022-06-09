$(document).ready(function () {
  $(document).on("change", "#id_central", function () {
    var id_central = this.value;
    $("#id_zona").empty();
    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getSiteZoneByIDCentral",
        id_central: id_central,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#id_zona").empty();
          $("#id_zona").append(
            '<option value="" disabled selected>Elija una zona*</option><optgroup label="Zonas">'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#id_zona").append(
              '<option value="' +
                data.data[i].id_zonas_central +
                '">' +
                data.data[i].descripcion +
                "</option>"
            );
          }
          $("#id_zona").append("</optgroup>");
          $("#id_zona").prop("disabled", false);
        } else {
          $("#id_zona").prop("disabled", true);
          $.NotificationApp.send(
            "Al parecer ésta central no tiene zonas asignadas",
            "",
            "top-right",
            "#06996f",
            "warning"
          );
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

  $(document).on("change", "#estado_sitio", function () {
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
          $("#municipio_sitio").empty();
          $("#municipio_sitio").append(
            '<option value="">Seleccione un municipio *</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#municipio_sitio").append(
              '<option value="' +
                data.data[i].id +
                '">' +
                data.data[i].municipio +
                "</option>"
            );
          }
          $("#municipio_sitio").prop("disabled", false);
        } else {
          Swal.fire({
            icon: "error",
            title: "Al parecer este estado no tiene municipios",
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

  $(document).on("change", "#check_propietario", function () {
    if (this.checked) {
      $("#div_info_propietario").show();
      //$("#guardar_gasto").prop("disabled", false);
    } else {
      $("#div_info_propietario").hide();
      //$("#guardar_gasto").prop("disabled", false);
    }
  });
  $(document).on("click", "#guardarNuevoSitio", function () {
    var num_sitio_astelecom = $("#numero_sitio_astelecom").val();
    var codigo_sitio = $("#codigo_sitio").val();
    var nombre_sitio = $("#nombre_sitio").val();
    var tipo_sitio = $("input[type=radio][name=tipo_sitio]:checked").val();
    var id_central = $("#id_central").val();
    var id_zona = $("#id_zona").val();
    var tipo_cerradura = $("#tipo_cerradura").val();
    var tipo_perimetro = $("#tipo_perimetro").val();

    /* DIRECCION DE SITIO */
    var calle_sitio = $("#calle_sitio").val();
    var calle_numero_sitio = $("#calle_numero_sitio").val();
    var sitio_colonia = $("#sitio_colonia").val();
    var sitio_zipcode = $("#sitio_zipcode").val();
    var estado_sitio = $("#estado_sitio option:selected").text();
    var municipio_sitio = $("#municipio_sitio option:selected").text();
    var latitud_sitio = $("#latitud_sitio").val();
    var longitud_sitio = $("#longitud_sitio").val();
    var referencias_sitio = $("#referencias_sitio").val();

    if ($("#check_propietario").is(":checked")) {
      if (
        calle_sitio != "" &&
        sitio_colonia != "" &&
        sitio_zipcode != "" &&
        estado_sitio != "" &&
        municipio_sitio != "" &&
        codigo_sitio != "" &&
        nombre_sitio != "" &&
        tipo_sitio != "" &&
        id_central != "" &&
        id_zona != "" &&
        tipo_cerradura != "" &&
        nombre_propietario != "" &&
        apellidos_propietario != "" &&
        telefono_prop_1 != ""
      ) {
        $.ajax({
          url: "php/controllers/accesos/accesos_controller.php",
          method: "POST",
          data: {
            mod: "SaveDirectionSite",
            calle_sitio: calle_sitio,
            sitio_colonia: sitio_colonia,
            sitio_zipcode: sitio_zipcode,
            estado_sitio: estado_sitio,
            municipio_sitio: municipio_sitio,
            codigo_sitio: codigo_sitio,
            calle_numero_sitio: calle_numero_sitio,
            referencias_sitio: referencias_sitio,
            latitud_sitio: latitud_sitio,
            longitud_sitio: longitud_sitio,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              id_direccion_sitio = data.last_id;

              var nombre_propietario = $("#nombre_propietario").val();
              var apellidos_propietario = $("#apellidos_propietario").val();
              var telefono_prop_1 = $("#telefono_prop_1").val();
              var numero_prop_2 = $("#numero_prop_2").val();
              var mail_propietario = $("#mail_propietario").val();

              $.ajax({
                url: "php/controllers/accesos/accesos_controller.php",
                method: "POST",
                data: {
                  mod: "SaveSitePropiety",
                  nombre_propietario: nombre_propietario,
                  apellidos_propietario: apellidos_propietario,
                  telefono_prop_1: telefono_prop_1,
                  numero_prop_2: numero_prop_2,
                  mail_propietario: mail_propietario,
                },
              })
                .done(function (data) {
                  var data = JSON.parse(data);
                  console.log(data);

                  if (data.response == true) {
                    id_propietario = data.last_id;
                    $.ajax({
                      url: "php/controllers/accesos/accesos_controller.php",
                      method: "POST",
                      data: {
                        mod: "SaveNewSite",
                        num_sitio_astelecom: num_sitio_astelecom,
                        codigo_sitio: codigo_sitio,
                        nombre_sitio: nombre_sitio,
                        tipo_sitio: tipo_sitio,
                        id_central: id_central,
                        id_zona: id_zona,
                        tipo_cerradura: tipo_cerradura,
                        tipo_perimetro: tipo_perimetro,
                        id_direccion_sitio: id_direccion_sitio,
                        id_propietarios: id_propietario,
                      },
                    })
                      .done(function (data) {
                        var data = JSON.parse(data);
                        console.log(data);

                        if (data.response == true) {
                          Swal.fire({
                            icon: "success",
                            title: "Sitio guardado con éxito",
                            showConfirmButton: false,
                            timer: 1500,
                          }).then((result) => {
                            location.reload();
                          });
                        } else {
                          Swal.fire({
                            icon: "error",
                            title:
                              "Ocurrió un error al guardar la información del sitio",
                          });
                        }

                        //--- --- ---//
                        //--- --- ---//
                      })
                      .fail(function (message) {
                        Swal.fire({
                          icon: "error",
                          title: "Ocurrió un error, intentelo nuevamente",
                        });
                      });
                  } else {
                    Swal.fire({
                      icon: "error",
                      title:
                        "Ocurrió un error al guardar el propietario, intentelo nuevamente",
                    });
                  }

                  //--- --- ---//
                  //--- --- ---//
                })
                .fail(function (message) {
                  Swal.fire({
                    icon: "error",
                    title:
                      "Ocurrió un error al enviar la información del propietario, intentelo nuevamente",
                  });
                });
            } else {
              Swal.fire({
                icon: "error",
                title: "Ocurrió un error al guardar la dirección",
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {
            Swal.fire({
              icon: "error",
              title: "Ocurrió un error, intentelo nuevamente",
            });
          });
      } else {
        Swal.fire({
          icon: "error",
          title: "Debe llenar todos los campos",
        });
        return false;
      }
    } else {
      if (
        calle_sitio != "" &&
        sitio_colonia != "" &&
        sitio_zipcode != "" &&
        estado_sitio != "" &&
        municipio_sitio != "" &&
        codigo_sitio != "" &&
        nombre_sitio != "" &&
        tipo_sitio != "" &&
        id_central != "" &&
        id_zona != "" &&
        tipo_cerradura != ""
      ) {
        $.ajax({
          url: "php/controllers/accesos/accesos_controller.php",
          method: "POST",
          data: {
            mod: "SaveDirectionSite",
            calle_sitio: calle_sitio,
            sitio_colonia: sitio_colonia,
            sitio_zipcode: sitio_zipcode,
            estado_sitio: estado_sitio,
            municipio_sitio: municipio_sitio,
            codigo_sitio: codigo_sitio,
            calle_numero_sitio: calle_numero_sitio,
            referencias_sitio: referencias_sitio,
            latitud_sitio: latitud_sitio,
            longitud_sitio: longitud_sitio,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              id_direccion_sitio = data.last_id;

              $.ajax({
                url: "php/controllers/accesos/accesos_controller.php",
                method: "POST",
                data: {
                  mod: "SaveNewSite",
                  num_sitio_astelecom: num_sitio_astelecom,
                  codigo_sitio: codigo_sitio,
                  nombre_sitio: nombre_sitio,
                  tipo_sitio: tipo_sitio,
                  id_central: id_central,
                  id_zona: id_zona,
                  tipo_cerradura: tipo_cerradura,
                  tipo_perimetro: tipo_perimetro,
                  id_direccion_sitio: id_direccion_sitio,
                  id_propietarios: "1",
                },
              })
                .done(function (data) {
                  var data = JSON.parse(data);
                  console.log(data);

                  if (data.response == true) {
                    Swal.fire({
                      icon: "success",
                      title: "Sitio guardado con éxito",
                      showConfirmButton: false,
                      timer: 1500,
                    }).then((result) => {
                      location.reload();
                    });
                  } else {
                    Swal.fire({
                      icon: "error",
                      title: "Al parecer este estado no tiene municipios",
                    });
                  }

                  //--- --- ---//
                  //--- --- ---//
                })
                .fail(function (message) {
                  Swal.fire({
                    icon: "error",
                    title: "Ocurrió un error, intentelo nuevamente",
                  });
                });
            } else {
              Swal.fire({
                icon: "error",
                title: "Ocurrió un error al guardar la dirección",
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {
            Swal.fire({
              icon: "error",
              title: "Ocurrió un error, intentelo nuevamente",
            });
          });
      } else {
        Swal.fire({
          icon: "error",
          title: "Debe llenar todos los campos",
        });
        return false;
      }
    }
  });

  $(document).on("click", ".infoSitio", function () {
    var id_sitio = $(this).attr("data-id-site");
    var site_name = $(this).attr("data-site-name");
    var site_code = $(this).attr("data-site-code");
    console.log(id_sitio);
    $("#siteName").text(site_code + " | " + site_name);

    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getFulInfoSite",
        id_sitio: id_sitio,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        var html_info = "";
        if (data.response == true) {
          html_info +=
            "<h2 id=siteName>" +
            data.data[0].codigo_sitio +
            " | " +
            data.data[0].nombre_sitio +
            "   <span class='badge badge-outline-warning editSiteName'><i class='dripicons-pencil'></i></span></h2>";
          html_info +=
            "<h4>" +
            data.data[0].direccion_sitio +
            "   <span class='badge badge-outline-warning editAddressSite'><i class='dripicons-pencil'></i></span></h4>";
          html_info += "<br>";
          /*  html_info +=
            '<button class="btn btn-primary ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#divMapa" aria-expanded="false" aria-controls="divMapa">';
          html_info += "Ver mapa...";
          html_info += "</button>";
          html_info += '<div class="collapse" id="divMapa">';
          html_info += '<div class="card card-body mb-0">';
          html_info +=
            '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d940.5878516970419!2d-99.01901907108459!3d19.5931177305752!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2021a78aadb2f%3A0xd706a2a7c72ee311!2sMuseo%20Soumaya!5e0!3m2!1ses-419!2smx!4v1653594986738!5m2!1ses-419!2smx" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
          html_info += "</div>";
          html_info += "</div>";
          html_info += "<br>"; */
          html_info +=
            "<h5>Central: " +
            data.data[0].nombre_central +
            "   <span class='badge badge-outline-warning editSiteCentral'><i class='dripicons-pencil'></i></span></h5>";
          html_info +=
            "<h6>Zona: " +
            data.data[0].nombre_zona +
            "   <span class='badge badge-outline-warning editSiteZone'><i class='dripicons-pencil'></i></span></h6><br><br>";
          html_info +=
            "<h4>Status del Sitio: " +
            data.data[0].status_operacion +
            "   <span class='badge badge-outline-warning editSiteStatus'><i class='dripicons-pencil'></i></span></h4>";
          html_info +=
            "<h4>Tipo de Sitio: " +
            data.data[0].tipo_sitio +
            "   <span class='badge badge-outline-warning editSiteStatus'><i class='dripicons-pencil'></i></span></h4>";

          $("#div_info").html(html_info);

          //--- OBTENER INFORMACIÓN DE GABINETES ---//

          $.ajax({
            url: "php/controllers/accesos/accesos_controller.php",
            method: "POST",
            data: {
              mod: "getGabinetesInfo",
              id_sitio: id_sitio,
            },
          })
            .done(function (data) {
              var data = JSON.parse(data);
              console.log(data);
              var html_info = "";
              if (data.response == true) {
                $("#div_gabinetes").empty();
                $("#div_gabinetes").html(data.html);
              } else {
                $("#div_gabinetes").empty();
                $("#div_gabinetes").html(data.html);
              }

              //--- --- ---//
              //--- --- ---//
            })
            .fail(function (message) {
             
            });
            $.ajax({
              url: "php/controllers/accesos/accesos_controller.php",
              method: "POST",
              data: {
                mod: "getSiteContactOwner",
                id_sitio: id_sitio,
              },
            })
              .done(function (data) {
                var data = JSON.parse(data);
                console.log(data);
                var html_info = "";
                if (data.response == true) {
                  $("#div_contacto_propietario").empty();
                  $("#div_contacto_propietario").html(data.html);
                } else {
                  $("#div_contacto_propietario").empty();
                  $("#div_contacto_propietario").html(data.html);
                }
  
                //--- --- ---//
                //--- --- ---//
              })
              .fail(function (message) {
               
              });
        } else {
          Swal.fire({
            icon: "error",
            title: "Ocurrió un error al guardar la información del sitio",
          });
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error, intentelo nuevamente",
        });
      });
  });
  $("#estado_sitio").select2({
    dropdownParent: $("#nuevoSitio"),
  });

  $("#municipio_sitio").select2({
    dropdownParent: $("#nuevoSitio"),
  });
});

/* Swal.fire({
    title: "¿Estás seguro?",
    text: "¿Deseas guardar el nuevo sitio?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      $("#form_nuevo_sitio").submit();
    }
  }); */
