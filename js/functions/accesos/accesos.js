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
            "   <span class='badge badge-outline-warning editSiteName' data-site-code='" +
            site_code +
            "' data-site-name='" +
            site_name +
            "' data-id-sitio='" +
            id_sitio +
            "'><i class='dripicons-pencil'></i></span></h2><br><div id='div_site_name'></div>";
          html_info +=
            "<h4>" +
            data.data[0].direccion_sitio +
            "   <span class='badge badge-outline-warning editAddressSite' data-id-sitio='" +
            id_sitio +
            "'><i class='dripicons-pencil'></i></span></h4>";
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
            "   <span class='badge badge-outline-warning editSiteCentral' data-id-sitio='" +
            id_sitio +
            "'><i class='dripicons-pencil'></i></span></h5>";
          html_info +=
            "<h6>Zona: " +
            data.data[0].nombre_zona +
            "   <span class='badge badge-outline-warning editSiteZone' data-id-sitio='" +
            id_sitio +
            "'><i class='dripicons-pencil'></i></span></h6><br><br>";
          html_info +=
            "<h4>Status del Sitio: " +
            data.data[0].status_operacion +
            "   <span class='badge badge-outline-warning editSiteStatus' data-id-sitio='" +
            id_sitio +
            "'><i class='dripicons-pencil'></i></span></h4>";
          html_info +=
            "<h4>Tipo de Sitio: " +
            data.data[0].tipo_sitio +
            "   <span class='badge badge-outline-warning editSiteStatus' data-id-sitio='" +
            id_sitio +
            "'><i class='dripicons-pencil'></i></span></h4>";

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
            .fail(function (message) {});
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
            .fail(function (message) {});
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
  $(document).on("click", ".editSiteName", function () {
    var id_sitio = $(this).attr("data-id-sitio");
    var site_code = $(this).attr("data-site-code");
    var site_name = $(this).attr("data-site-name");
    var html_edit = "";
    html_edit +=
      '<label for="editSiteName">Editar Nombre y Código del Sitio</label>';
    html_edit += '<div class="input-group mb-3">';
    html_edit +=
      '<input value="' +
      site_code +
      '" type="text" class="form-control" id="editSiteCode" aria-describedby="emailHelp" placeholder="Código de Sitio">';
    html_edit += "</div>";
    html_edit += '<div class="input-group mb-3">';
    html_edit +=
      '<input value="' +
      site_name +
      '" type="text" class="form-control" id="editSiteName" aria-describedby="emailHelp" placeholder="Nombre del Sitio">';
    html_edit += "</div>";
    html_edit +=
      '<button type="button" class="btn btn-primary ms-1 saveEditNameSite" data-id-site="' +
      id_sitio +
      '" data-column-name="nombre_sitio">Guardar</button>';
    html_edit += "<br>";
    $("#div_site_name").empty().append(html_edit);
  });
  $(document).on("click", ".saveEditNameSite", function () {
    var id_sitio = $(this).attr("data-id-site");
    var column_name = $(this).attr("data-column-name");
    var site_code = $("#editSiteCode").val();
    var site_name = $("#editSiteName").val();
    console.log(id_sitio);
    console.log(column_name);
    console.log(site_code);
    console.log(site_name);
    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "editSiteName",
        id_sitio: id_sitio,
        column_name: column_name,
        site_code: site_code,
        site_name: site_name,
      },
    }).done(function (data) {
      var data = JSON.parse(data);
      console.log(data);
      if (data.response == true) {
        Swal.fire({
          icon: "success",
          title: "Nombre y Código del Sitio actualizado",
        });
        $("#div_site_name").empty().append(data.html);
        $("#siteName")
          .empty()
          .text(site_code + " | " + site_name);
      } else {
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error al guardar la información del sitio",
        });
      }
    });
  });

  $(document).on("change", "#na_central", function () {
    var id_central = $(this).val();
    loading();
    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getZonesByCentral",
        id_central: id_central,
      },
    }).done(function (data) {
      Swal.close();
      var data = JSON.parse(data);
      //console.log(data);
      if (data.response == true) {
        console.log(data.data);
        html_options = "";
        html_options +=
          '<option disabled selected value="">Seleccione una zona</option>';
        for (var i = 0; i < data.data.length; i++) {
          html_options +=
            '<option value="' +
            data.data[i].id_zonas_central +
            '">' +
            data.data[i].descripcion +
            "</option>";
        }
        $("#na_zona").empty().append(html_options);
        $("#na_zona").attr("disabled", false);
      } else {
        $("#na_zona").empty().append(html_options);
        $("#na_zona").attr("disabled", true);
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error al obtener las zonas",
          text: data.message,
        });
      }
    });
  });

  $(document).on("change", "#na_zona", function () {
    var id_zona = $(this).val();
    loading();
    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getSitesByZone",
        id_zona: id_zona,
      },
    }).done(function (data) {
      Swal.close();
      var data = JSON.parse(data);
      //console.log(data);
      if (data.response == true) {
        console.log(data.data);
        html_options = "";
        html_options +=
          '<option disabled selected value="">Seleccione una sitio</option>';
        for (var i = 0; i < data.data.length; i++) {
          html_options +=
            '<option value="' +
            data.data[i].id_sitios +
            '">' +
            data.data[i].codigo_sitio +
            " | " +
            data.data[i].nombre_sitio +
            "</option>";
        }
        $("#na_sitio").empty().append(html_options);
        $("#na_sitio").attr("disabled", false);
      } else {
        $("#na_sitio").empty().append(html_options);
        $("#na_sitio").attr("disabled", true);
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error al obtener los sitios",
          text: data.message,
        });
      }
    });
  });
  $(document).on("change", "#na_sitio", function () {
    loading();
    $(".breaker_principal").prop("checked", false);
    $(".planta_emergencia").prop("checked", false);
    $(".at_torre").prop("disabled", true);
    $(".at_centro_carga").prop("disabled", true);
    $(".at_escalerilla").prop("disabled", true);
    $("#breakers_existentes").val("");
    $("#chk_vandalismo").prop("checked", false);
    /* $("#na_perimetro").select2().val("").trigger("change");
    $("#na_limpieza").select2().val("").trigger("change"); */

    $("input[type=radio][name=acceso1]").each(function () {
      $(this).prop("checked", false);
    });
    $("input[type=radio][name=acceso2]").each(function () {
      $(this).prop("checked", false);
    });
    $("input[type=radio][name=acceso3]").each(function () {
      $(this).prop("checked", false);
    });
    $("input[type=radio][name=acceso4]").each(function () {
      $(this).prop("checked", false);
    });
    $("#div_info_sitio").show();
    var id_sitio = $(this).val();
    $(".btnAddGabinete").attr("disabled", false);
    $(".saveGabinete").attr("data-id-sitio", id_sitio);
    $(".bntGuardarAcceso").attr("data-id-sitio", id_sitio);
    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getGabinetesStio",
        id_sitio: id_sitio,
      },
    }).done(function (data) {
      var data = JSON.parse(data);
      //console.log(data);
      Swal.close();
      console.log(data.perim_limp);
      if (data.perim_limp.length > 0) {
        $("#txt_limpieza").text(data.perim_limp[0].limpieza);
        $("#txt_perimetro").text(data.perim_limp[0].perimetro);
      }
      if (data.response == true) {
        $(".at_torre").prop("disabled", false);
        $(".at_centro_carga").prop("disabled", false);
        $(".at_escalerilla").prop("disabled", false);

        var html_gabinetes = data.html_gabinetes;

        for (let i = 0; i < data.access_gates.length; i++) {
          console.log(data.access_gates[i].id_tipos_cerraduras);
          $(
            "#acc" +
              data.access_gates[i].id_tipos_cerraduras +
              "_group" +
              data.access_gates[i].id_puertas_de_acceso +
              ""
          ).prop("checked", true);
        }
        /* for (let i = 0; i < .length; i++) { */
        for (var index in data.electricity[0]) {
          console.log(index);
          var val_index = data.electricity[0][index];
          console.log(val_index);
          if (index == "status") {
            if (val_index == 3) {
              $("#chk_vandalismo").prop("checked", true);
            } else {
              $("#chk_vandalismo").prop("checked", false);
            }
          } else if (index == "breakers_existentes") {
            $("#" + index).val(val_index);
          } else {
            if (val_index == 1) {
              $("." + index).prop("checked", true);
            } else {
              $("." + index).prop("checked", false);
            }
          }
        }
        $("#div_gabinetes").empty().append(html_gabinetes);
      } else {
        $("#div_gabinetes").empty().append(html_gabinetes);
        for (let i = 0; i < data.access_gates.length; i++) {
          console.log(data.access_gates[i].id_tipos_cerraduras);
          $(
            "#acc" +
              data.access_gates[i].id_tipos_cerraduras +
              "_group" +
              data.access_gates[i].id_puertas_de_acceso +
              ""
          ).prop("checked", true);
        }
      }
    });
  });
  $(document).on("click", ".saveGabinete", function () {
    loading();
    var id_sitio = $(this).attr("data-id-sitio");
    var nombre_gabinete = $("#nombre_gabinete").val();
    var baterias_gabinete = $("#baterias_gabinete").val();
    var cerraduras_gabinetes = $("#cerraduras_gabinetes").val();
    var txt_cerradura = $("#cerraduras_gabinetes option:selected").text();

    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "saveGabinete",
        id_sitio: id_sitio,
        nombre_gabinete: nombre_gabinete,
        baterias_gabinete: baterias_gabinete,
        cerraduras_gabinetes: cerraduras_gabinetes,
      },
    }).done(function (data) {
      var data = JSON.parse(data);
      //console.log(data);
      Swal.close();
      if (data.response == true) {
        Swal.fire({
          icon: "success",
          title: data.message,
          timer: 1500,
        });
        id_gabinete = data.last_id;
        var html_gabinete = "";
        html_gabinete +=
          '<div class="col-md-6" id="divGabinete' + id_gabinete + '">';
        html_gabinete += '<div class="card border-primary border">';
        html_gabinete += '<div class="card-body">';
        html_gabinete +=
          '<h5 class="card-title text-primary">' + nombre_gabinete + "</h5>";
        html_gabinete += '<p class="card-text">';
        html_gabinete += "Baterías: " + baterias_gabinete;
        html_gabinete += "</p>";
        html_gabinete += '<p class="card-text">';
        html_gabinete += "Cerradura: " + txt_cerradura;
        html_gabinete += "</p>";
        html_gabinete +=
          '<button type="button" class="btn btn-light deleteGabinete" data-id-gabinete="' +
          id_gabinete +
          '" title="Eliminar"><i class="mdi mdi-trash-can"></i> </button>';
        html_gabinete += "</div>";
        html_gabinete += "</div>";
        html_gabinete += "</div>";
        $("#div_gabinetes").append(html_gabinete);
      } else {
        Swal.fire({
          icon: "error",
          title: data.message,
          timer: 1500,
        });
      }
    });
  });
  $(document).on("click", ".deleteGabinete", function () {
    var id_gabinete = $(this).attr("data-id-gabinete");

    Swal.fire({
      title: "¿Está seguro de eliminar el gabinete?",
      text: "¡No podrá revertir esta acción!",
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
          url: "php/controllers/accesos/accesos_controller.php",
          method: "POST",
          data: {
            mod: "deleteGabinete",
            id_gabinete: id_gabinete,
          },
        }).done(function (data) {
          var data = JSON.parse(data);
          //console.log(data);
          if (data.response == true) {
            Swal.close();
            $("#divGabinete" + id_gabinete).remove();
          } else {
            Swal.close();
            Swal.fire({
              icon: "error",
              title: "Ocurrió un error al eliminar el gabinete",
              timer: 1500,
            });
          }
        });
      } else {
      }
    });
  });
  $(document).on("click", ".bntGuardarAcceso", function () {
    // --- INFORMACIÓN DEL ACCESO ---//

    var id_sitio = $(this).attr("data-id-sitio");
    var empresa = $("#empresa").val();
    var actividad = $("#actividad").val();
    var hora_ingreso = $("#hora_ingreso").val();
    var hora_salida = $("#hora_salida").val();
    var proveedor = $("#proveedor").val();
    var ayudantes = $("#ayudantes").val();
    var comentarios = $("#comentarios").val();
    var id_user = $("#id_user").val();

    // --- INFORMACIÓN DEL SITIO ---//

    // --- GABINETES ---//

    // --- PUERTAS DE ACCESO ---//

    var id_tipos_cerraduras_1 = $(
      "input[type=radio][name=acceso1]:checked"
    ).val();
    var id_puertas_acceso_1 = $("input[type=radio][name=acceso1]").attr(
      "data-id-puertas-acceso"
    );

    var id_tipos_cerraduras_2 = $(
      "input[type=radio][name=acceso2]:checked"
    ).val();
    var id_puertas_acceso_2 = $("input[type=radio][name=acceso2]").attr(
      "data-id-puertas-acceso"
    );

    var id_tipos_cerraduras_3 = $(
      "input[type=radio][name=acceso3]:checked"
    ).val();
    var id_puertas_acceso_3 = $("input[type=radio][name=acceso3]").attr(
      "data-id-puertas-acceso"
    );

    var id_tipos_cerraduras_4 = $(
      "input[type=radio][name=acceso4]:checked"
    ).val();
    var id_puertas_acceso_4 = $("input[type=radio][name=acceso4]").attr(
      "data-id-puertas-acceso"
    );

    // --- INFORMACIÓN ADICIONAL DE PROVEEDOR ---//
    firma_b64 = $("#firma_b64").val();
    const file_input = document.querySelector("#fotografia_proveedor");
    const file = file_input.files[0];
    vidFileLength = file_input.files.length;
    var file_n = file.name;
    var f = file_n.split(".");
    //--- --- ---//
    var name = file_input.getAttribute("name");
    //--- --- ---//
    name += ".";
    name += f[1];

    if (vidFileLength == 0) {
      /* $(".inputAddStudentDocument")
        .siblings(".custom-file-label")
        .removeClass("selected")
        .html("Elegir un archivo"); */
      //Swal.close();
      Swal.fire("Atención!", "Debe elegir un archivo", "info");
      file_input.value = "";
    } else {
      if (
        f[f.length - 1] != "png" &&
        f[f.length - 1] != "jpg" &&
        f[f.length - 1] != "jpeg"
      ) {
        Swal.fire("Atención!", "El archivo debe ser una imagen", "info");
        file_input.value = "";
      } else {
        if (file_input.files[0].size > 20000000) {
          Swal.close();
          Swal.fire(
            "Atención!",
            "El tamaño máximo del archivo a subir es de 20MB",
            "info"
          );
          file_input.value = "";
          return;
        } else {
          folder = "identificaciones_proveedores";
          module_name = "accesos";
          var fData = new FormData();
          fData.append("formData", file);
          fData.append("name", name);
          fData.append("folder", folder);
          fData.append("module_name", module_name);
          fData.append("mod", "saveIdentificacionProveedor");
          $.ajax({
            url: "php/controllers/accesos/accesos_controller.php",
            method: "POST",
            data: fData,
            contentType: false,
            processData: false,
          })
            .done(function (response) {
              console.log(response);

              var json = JSON.parse(response);
              if (json.response) {
                var id_imagen = json.id_archivo;
                if (
                  id_sitio != "" &&
                  empresa != "" &&
                  actividad != "" &&
                  hora_ingreso != "" &&
                  proveedor != "" &&
                  ayudantes != "" &&
                  id_tipos_cerraduras_1 != undefined &&
                  id_tipos_cerraduras_2 != undefined &&
                  id_tipos_cerraduras_3 != undefined &&
                  id_tipos_cerraduras_4 != undefined &&
                  firma_b64 != ""
                ) {
                  Swal.fire({
                    title: "¿Está seguro de guardar el acceso?",
                    text: "Asegurese que toda la información esté correcta",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, guardar!",
                    cancelButtonText: "Cancelar",
                  }).then((result) => {
                    if (result.value) {
                      loading();
                      console.log("save sitio: " + id_sitio);
                      $.ajax({
                        url: "php/controllers/accesos/accesos_controller.php",
                        method: "POST",
                        data: {
                          mod: "saveAcceso",
                          id_sitio: id_sitio,
                          empresa: empresa,
                          actividad: actividad,
                          hora_ingreso: hora_ingreso,
                          proveedor: proveedor,
                          ayudantes: ayudantes,
                          firma_b64: firma_b64,
                          hora_salida: hora_salida,
                          comentarios: comentarios,
                          id_imagen: id_imagen,
                          id_user: id_user,
                        },
                      }).done(function (data) {
                        var data = JSON.parse(data);
                        //console.log(data);
                        if (data.response == true) {
                          Swal.close();
                          Swal.fire(
                            "¡Guardado!",
                            "El acceso se ha guardado correctamente",
                            "success"
                          ).then((result) => {
                            loading();
                            location.reload();
                          });
                        } else {
                          Swal.close();
                          Swal.fire({
                            icon: "error",
                            title: "Ocurrió un error al eliminar el gabinete",
                            timer: 1500,
                          });
                        }
                      });
                    } else {
                    }
                  });
                } else {
                  Swal.fire({
                    icon: "error",
                    title: "Asegurese de ingresar todos los datos obligatorios",
                    timer: 3500,
                  });
                }
              } else {
                Swal.fire(
                  "Error!",
                  "Ocurrió un error al intentar subir la fotografía, intentelo nuevamente por favor",
                  "error"
                );
              }
            })
            .fail(function (error) {
              Swal.fire(
                "Error!",
                "Ocurrió un error al intentar comunicarse con la base de datos :(",
                "error"
              );
              console.log(error);
            });
        }
      }
    }
  });

  $("input[type=radio][name=acceso1]").change(function () {
    var id_tipos_cerraduras = $(this).val();
    var id_puertas_acceso = $(this).attr("data-id-puertas-acceso");
    var id_sitio = $("#na_sitio").val();
    console.log(id_sitio);
    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateCerradurasSitio",
          id_sitio: id_sitio,
          id_tipos_cerraduras: id_tipos_cerraduras,
          id_puertas_acceso: id_puertas_acceso,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("input[type=radio][name=acceso2]").change(function () {
    var id_tipos_cerraduras = $(this).val();
    var id_puertas_acceso = $(this).attr("data-id-puertas-acceso");
    var id_sitio = $("#na_sitio").val();
    console.log(id_sitio);
    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateCerradurasSitio",
          id_sitio: id_sitio,
          id_tipos_cerraduras: id_tipos_cerraduras,
          id_puertas_acceso: id_puertas_acceso,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("input[type=radio][name=acceso3]").change(function () {
    var id_tipos_cerraduras = $(this).val();
    var id_puertas_acceso = $(this).attr("data-id-puertas-acceso");
    var id_sitio = $("#na_sitio").val();
    console.log(id_sitio);
    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateCerradurasSitio",
          id_sitio: id_sitio,
          id_tipos_cerraduras: id_tipos_cerraduras,
          id_puertas_acceso: id_puertas_acceso,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("input[type=radio][name=acceso4]").change(function () {
    var id_tipos_cerraduras = $(this).val();
    var id_puertas_acceso = $(this).attr("data-id-puertas-acceso");
    var id_sitio = $("#na_sitio").val();
    console.log(id_sitio);
    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateCerradurasSitio",
          id_sitio: id_sitio,
          id_tipos_cerraduras: id_tipos_cerraduras,
          id_puertas_acceso: id_puertas_acceso,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#chk_breaker_principal").change(function () {
    if (this.checked) {
      attr_bd = "1";
    } else {
      attr_bd = "0";
    }
    table = "breaker_principal";
    var id_sitio = $("#na_sitio").val();

    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateSiteElectricity",
          id_sitio: id_sitio,
          attr_bd: attr_bd,
          table: table,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#chk_planta_emergencia").change(function () {
    if (this.checked) {
      attr_bd = "1";
    } else {
      attr_bd = "0";
    }
    table = "planta_emergencia";
    var id_sitio = $("#na_sitio").val();

    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateSiteElectricity",
          id_sitio: id_sitio,
          attr_bd: attr_bd,
          table: table,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#chk_att_torre").change(function () {
    if (this.checked) {
      attr_bd = "1";
    } else {
      attr_bd = "0";
    }
    table = "at_torre";
    var id_sitio = $("#na_sitio").val();

    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateSiteElectricity",
          id_sitio: id_sitio,
          attr_bd: attr_bd,
          table: table,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#chk_at_centro_carga").change(function () {
    if (this.checked) {
      attr_bd = "1";
    } else {
      attr_bd = "0";
    }
    table = "at_centro_carga";
    var id_sitio = $("#na_sitio").val();

    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateSiteElectricity",
          id_sitio: id_sitio,
          attr_bd: attr_bd,
          table: table,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#chk_escalerilla").change(function () {
    if (this.checked) {
      attr_bd = "1";
    } else {
      attr_bd = "0";
    }
    table = "at_escalerilla";
    var id_sitio = $("#na_sitio").val();

    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateSiteElectricity",
          id_sitio: id_sitio,
          attr_bd: attr_bd,
          table: table,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#chk_vandalismo").change(function () {
    var id_user = $("#id_user").val();
    if (this.checked) {
      attr_bd = "1";
      id_status_operaciones = "1";
    } else {
      attr_bd = "0";
      id_status_operaciones = "5";
    }
    var id_sitio = $("#na_sitio").val();

    if (id_sitio != null) {
      $.ajax({
        url: "php/controllers/accesos/accesos_controller.php",
        method: "POST",
        data: {
          mod: "updateStatusVandalismo",
          id_sitio: id_sitio,
          attr_bd: attr_bd,
          id_status_operaciones: id_status_operaciones,
          id_user: id_user,
        },
      }).done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        } else {
          $.NotificationApp.send(
            "Propiedad Actualizada",
            "",
            "top-right",
            "#ffffff",
            "success"
          );
        }
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un sitio",
        timer: 1500,
      });
    }
  });
  $("#na_limpieza").change(function () {
    var id_tipos_limpieza = $(this).val();
    var id_sitio = $("#na_sitio").val();

    table = "limpieza";
    var id_sitio = $("#na_sitio").val();
    if (id_tipos_limpieza != null) {
      if (id_sitio != null) {
        $.ajax({
          url: "php/controllers/accesos/accesos_controller.php",
          method: "POST",
          data: {
            mod: "updateSiteElectricity",
            id_sitio: id_sitio,
            attr_bd: id_tipos_limpieza,
            table: table,
          },
        }).done(function (data) {
          var data = JSON.parse(data);
          //console.log(data);
          if (data.response == true) {
            $.NotificationApp.send(
              "Propiedad Actualizada",
              "",
              "top-right",
              "#ffffff",
              "success"
            );
          } else {
            $.NotificationApp.send(
              "Propiedad Actualizada",
              "",
              "top-right",
              "#ffffff",
              "success"
            );
          }
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Debe seleccionar un sitio",
          timer: 1500,
        });
      }
    }
  });
  $("#na_perimetro").change(function () {
    var id_tipo_perimetro = $(this).val();
    var id_sitio = $("#na_sitio").val();

    table = "perimetro";
    var id_sitio = $("#na_sitio").val();
    if (id_tipo_perimetro != null) {
      if (id_sitio != null) {
        $.ajax({
          url: "php/controllers/accesos/accesos_controller.php",
          method: "POST",
          data: {
            mod: "updateSiteElectricity",
            id_sitio: id_sitio,
            attr_bd: id_tipo_perimetro,
            table: table,
          },
        }).done(function (data) {
          var data = JSON.parse(data);
          //console.log(data);
          if (data.response == true) {
            $.NotificationApp.send(
              "Propiedad Actualizada",
              "",
              "top-right",
              "#ffffff",
              "success"
            );
          } else {
            $.NotificationApp.send(
              "Propiedad Actualizada",
              "",
              "top-right",
              "#ffffff",
              "success"
            );
          }
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Debe seleccionar un sitio",
          timer: 1500,
        });
      }
    }
  });

  $(document).on("click", ".infoAcceso", function () {
    var id_acceso = $(this).attr("id");
    $("#divInfoAcceso").empty();
    loading();

    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getinfoAcceso",
        id_acceso: id_acceso,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          var html = "";

          html += "<h3>Sitio: " + data.data[0].sitio + " </h3>";
          html += "<h4>Fecha: " + data.data[0].fecha + " </h4>";
          html += "<h4>Hora de entrado: " + data.data[0].hora + " </h4>";
          html += "<h4>Hora de salida: " + data.data[0].hora_salida + " </h4>";
          html += "<h5>Registrado por: " + data.data[0].personal_as + " </h5>";
          html += "<hr>";
          html += "<h4>Empresa: " + data.data[0].empresa + " </h4>";
          html += "<h4>Actividad: " + data.data[0].actividad + " </h4>";
          html +=
            "<h4>Lider de Cuadrilla: " +
            data.data[0].lider_cuadrilla +
            " </h4>";
          html += "<h4>Acompañantes: " + data.data[0].ayudantes + " </h4>";
          html += "<hr>";
          html += "<h4>Comentarios: " + data.data[0].comentarios + " </h4>";
          $("#divInfoAcceso").append(html);
          Swal.close();
          /*
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
          $("#municipio_sitio").prop("disabled", false); */
        } else {
          Swal.close();
          Swal.fire({
            icon: "error",
            title: "Al parecer este estado no tiene municipios",
          });
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.close();
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error al obtener la información del acceso",
          timer: 1500,
        });
      });
  });

  $(document).on("click", ".deleteAcceso", function () {
    var id_acceso = $(this).attr("id");
    Swal.fire({
      icon: "question",
      title: "¿Está seguro que desea eliminar este registro?",
      text: "Esta acción no puede ser revertida",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        loading();

        $.ajax({
          url: "php/controllers/accesos/accesos_controller.php",
          method: "POST",
          data: {
            mod: "deleteAcceso",
            id_acceso: id_acceso,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              $("#tr_"+id_acceso).remove();
              Swal.close();
              Swal.fire({
                icon: "success",
                title: "Se eliminó el registro con éxito",
              });
              
            } else {
              Swal.close();
              Swal.fire({
                icon: "error",
                title: "Ocurrió un error al eliminar el registro",
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {
            Swal.close();
            Swal.fire({
              icon: "error",
              title: "Ocurrió un error al obtener la información del acceso",
              timer: 1500,
            });
          });
      }
    });
  });

  $("#estado_sitio").select2({
    dropdownParent: $("#nuevoSitio"),
  });

  $("#municipio_sitio").select2({
    dropdownParent: $("#nuevoSitio"),
  });
  $("#na_central").select2({
    dropdownParent: $("#nuevoAcceso"),
  });
  $("#na_sitio").select2({
    dropdownParent: $("#nuevoAcceso"),
  });
  $("#na_zona").select2({
    dropdownParent: $("#nuevoAcceso"),
  });
  $("#na_limpieza").select2({
    dropdownParent: $("#nuevoAcceso"),
  });
  $("#na_perimetro").select2({
    dropdownParent: $("#nuevoAcceso"),
  });

  $("#cerraduras_gabinetes").select2({
    dropdownParent: $("#newGabinete"),
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

function loading() {
  Swal.fire({
    title: "Cargando...",
    html: '<img src="images/loading.gif" width="300" height="175">',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCloseButton: false,
    showCancelButton: false,
    showConfirmButton: false,
  });
}
