//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("click", ".agregarGrupoPreguntas", function () {
    var id_familias_preguntas = $(this).attr("data-id");
    $(".btnGuardarGrupoPregunta").attr("data-id", id_familias_preguntas);
  });
  $(document).on("click", ".editarUnidad", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");
    $(".btnActualizarUnidad").attr("data-id", id_vehiculos);

    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "getInfoVehiculo",
        id_vehiculos: id_vehiculos,
      },
    }).done(function (info_vehicle) {
      var info_vehicle = JSON.parse(info_vehicle);
      if (info_vehicle.response == true) {
        $("#editar_placas").val(info_vehicle.data[0].placas);
        $("#editar_marca").val(info_vehicle.data[0].marca);
        $("#editar_modelo").val(info_vehicle.data[0].modelo);
        $("#editar_color").val(info_vehicle.data[0].color);
        $("#editar_nombre").val(info_vehicle.data[0].nombre_vehiculo);
        $("#editar_observaciones").val(info_vehicle.data[0].observaciones);
        Swal.close();
      } else {
        /* Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
          timer: 2000,
        }); */
      }
    });
  });
  $(document).on("click", ".asignarUnidad", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");

    $(".btnAsignarUnidad").attr("data-id", id_vehiculos);

    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "getAviablePersonalVehiculos",
        id_vehiculos: id_vehiculos,
      },
    }).done(function (personal_aviable) {
      var personal_aviable = JSON.parse(personal_aviable);
      if (personal_aviable.response == true) {
        var id_asignado = personal_aviable.id_asignado;
        html_options = "";
        for (let p = 0; p < personal_aviable.data.length; p++) {
          if (personal_aviable.data[p].id_personal == id_asignado) {
            html_options +=
              '<option selected value="' +
              personal_aviable.data[p].id_personal +
              '">' +
              personal_aviable.data[p].nombre_completo +
              "</option>";
          } else {
            html_options +=
              '<option value="' +
              personal_aviable.data[p].id_personal +
              '">' +
              personal_aviable.data[p].nombre_completo +
              "</option>";
          }
        }
        $("#personalVehiculo").html(html_options);
        Swal.close();
      } else {
        /* Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
          timer: 2000,
        }); */
      }
    });
  });
  $(document).on("click", ".btnAsignarUnidad", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");
    var id_personal = $("#personalVehiculo").val();

    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "asignarVehiculosPersonal",
        id_vehiculos: id_vehiculos,
        id_personal: id_personal,
      },
    }).done(function (personal_aviable) {
      var personal_aviable = JSON.parse(personal_aviable);
      if (personal_aviable.response == true) {
        Swal.fire({
          icon: "success",
          title: "Asignado",
          text: personal_aviable.message,
          timer: 2000,
        }).then((result) => {
          $("#asignarUnidad").modal("hide");
        });
      } else {
        /* Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
          timer: 2000,
        }); */
      }
    });
  });

  $(document).on("click", ".btnAgregarPregunta", function () {
    var id_grupo_pregunta = $(this).attr("data-id");
    $(".btnGuardarPregunta").attr("data-id", id_grupo_pregunta);
  });
  $(document).on("click", ".editPregunta", function () {
    loading();
    var id_pregunta = $(this).attr("data-id");

    $(".btnActualizarPregunta").attr("data-id", id_pregunta);

    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "getInfoPregunta",
        id_pregunta: id_pregunta,
      },
    }).done(function (info_question) {
      var info_question = JSON.parse(info_question);
      if (info_question.response == true) {
        $("#editar_pregunta").val(info_question.data[0].pregunta);
        $("#editar_infoAdicional").val(info_question.data[0].info_adicional);
        TipoPregunta = info_question.data[0].id_tipos_preguntas;
        $.ajax({
          url: "php/controllers/vehiculos/vehiculos_controller.php",
          method: "POST",
          data: {
            mod: "getTypeQuestions",
          },
        }).done(function (questions_types) {
          var questions_types = JSON.parse(questions_types);
          if (questions_types.response == true) {
            var html_options = "";
            for (var i = 0; i < questions_types.data.length; i++) {
              if (questions_types.data[i].id_tipos_preguntas == TipoPregunta) {
                html_options +=
                  '<option selected value="' +
                  questions_types.data[i].id_tipos_preguntas +
                  '">' +
                  questions_types.data[i].descripcion +
                  "</option>";
              } else {
                html_options +=
                  '<option value="' +
                  questions_types.data[i].id_tipos_preguntas +
                  '">' +
                  questions_types.data[i].descripcion +
                  "</option>";
              }
            }
            $("#editar_TipoPregunta").empty().html(html_options);
            Swal.close();
          } else {
            /* Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            }); */
          }
        });
      } else {
        /* Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
          timer: 2000,
        }); */
      }
    });
  });
  $(document).on("click", ".btnActualizarPregunta", function () {
    loading();
    var editar_pregunta = $("#editar_pregunta").val();
    var editar_TipoPregunta = $("#editar_TipoPregunta").val();
    var editar_infoAdicional = $("#editar_infoAdicional").val();
    var id_pregunta = $(this).attr("data-id");
    if (
      editar_pregunta == null ||
      editar_pregunta == "" ||
      editar_TipoPregunta == ""
    ) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "updatePregunta",
          editar_pregunta: editar_pregunta,
          editar_TipoPregunta: editar_TipoPregunta,
          editar_infoAdicional: editar_infoAdicional,
          id_pregunta: id_pregunta,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            $("#editarPregunta input").val("");
            $("#editarPregunta textarea").val("");
            $("#editarPregunta select").val("");
            $("#editarPregunta input[type='checkbox']")
              .prop("checked", false)
              .change();
            $("#editarPregunta").modal("hide");

            $("#td_pregunta" + id_pregunta)
              .empty()
              .html(editar_pregunta);
            $("#tipoPregunta" + id_pregunta).prop("disabled", false);
            $("#tipoPregunta" + id_pregunta).val(editar_TipoPregunta);
            $("#tipoPregunta" + id_pregunta).prop("disabled", true);
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: "Pregunta actualizada correctamente",
              timer: 2000,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
    }
  });
  $(document).on("click", ".btnActualizarUnidad", function () {
    loading();

    var id_vehiculos = $(this).attr("data-id");

    var placas = $("#editar_placas").val();
    var marca = $("#editar_marca").val();
    var modelo = $("#editar_modelo").val();
    var color = $("#editar_color").val();
    var nombre = $("#editar_nombre").val();
    var observaciones = $("#editar_observaciones").val();
    if (
      placas == "" ||
      marca == "" ||
      modelo == "" ||
      color == "" ||
      nombre == ""
    ) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "updateUnidad",
          placas: placas,
          marca: marca,
          modelo: modelo,
          color: color,
          nombre: nombre,
          observaciones: observaciones,
          id_vehiculos: id_vehiculos,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            $("#editarUnidad input").val("");
            $("#editarUnidad textarea").val("");
            $("#editarUnidad select").val("");
            $("#editarUnidad input[type='checkbox']")
              .prop("checked", false)
              .change();
            $("#editarUnidad").modal("hide");

            $("#tdPlacas" + id_vehiculos)
              .empty()
              .html(placas);
            $("#tdMarca" + id_vehiculos)
              .empty()
              .html(marca);
            $("#tdModelo" + id_vehiculos)
              .empty()
              .html(modelo);
            $("#tdColor" + id_vehiculos)
              .empty()
              .html(color);
            $("#tdNombre" + id_vehiculos)
              .empty()
              .html(nombre);
            $("#tdObservaciones" + id_vehiculos)
              .empty()
              .html(observaciones);

            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: "Pregunta actualizada correctamente",
              timer: 2000,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
    }
  });
  $(document).on("click", ".btnGuardarGrupoPregunta", function () {
    loading();
    var grupoPreguntas = $("#grupoPreguntas").val();
    var riesgo = $("#riesgo").val();
    var id_familias_preguntas = $(this).attr("data-id");
    if (grupoPreguntas == null || grupoPreguntas == "") {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "saveGroupQuestion",
          grupoPreguntas: grupoPreguntas,
          riesgo: riesgo,
          id_familias_preguntas: id_familias_preguntas,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            id_grupo = data.id_grupo;
            var html = "";
            html += '<div class="table-responsive">';
            html +=
              "<h5>Grupo de preguntas: " +
              grupoPreguntas +
              ' <br><span class="help-block"><small>RIESGO: ' +
              riesgo +
              "</small></span></h6>";
            html += "<br>";
            html +=
              '<button data-id="' +
              id_grupo +
              '" type="button" class="btn btn-info waves-effect waves-light btnAgregarPregunta" data-bs-toggle="modal" data-bs-target="#agregarPregunta">Agregar pregunta</button>';
            html += "<br>";
            html +=
              '<table class="table table-hover table-centered mb-0 table-responsive tablePreguntasFamilia' +
              id_familias_preguntas +
              '" id="preguntasGrupo' +
              id_grupo +
              '">';
            html += "<thead>";
            html += "<tr>";
            html += "<th>Pregunta</th>";
            html += "<th>T. de Pregunta</th>";
            html += "<th>Info. Adicional</th>";
            html += "<th>Acciones</th>";
            html += "</tr>";
            html += "</thead>";
            html += "<tbody>";
            html += '<tr colspan="100%">';
            html += '<td colspan="100%">';
            html += '<div class="alert alert-danger" role="alert">';
            html += "No hay preguntas registradas";
            html += "</div>";
            html += "</td>";
            html += "</tr>";
            html += "</tbody>";
            html += "</table>";
            html += "</div>";
            html += "<br>";
            html += "<br>";
            var tablesGroup = $(
              ".tablePreguntasFamilia" + id_familias_preguntas
            ).toArray().length;
            if (tablesGroup == 0) {
              html2 =
                '<button data-id="' +
                id_familias_preguntas +
                '" type="button" class="btn btn-primary waves-effect waves-light agregarGrupoPreguntas" data-bs-toggle="modal" data-bs-target="#modalAgregarGrupoPreguntas">Agregar grupo de preguntas</button>';
              $("#accordion" + id_familias_preguntas)
                .empty()
                .html(html);
              $("#accordion" + id_familias_preguntas).prepend(html2);
            } else {
              $("#accordion" + id_familias_preguntas).append(html);
            }
            $("#modalAgregarGrupoPreguntas input").val("");
            $("#modalAgregarGrupoPreguntas textarea").val("");
            $("#modalAgregarGrupoPreguntas select").val("");
            $("#modalAgregarGrupoPreguntas input[type='checkbox']")
              .prop("checked", false)
              .change();
            $("#modalAgregarGrupoPreguntas").modal("hide");

            Swal.fire({
              icon: "success",
              title: "Éxito",
              html: data.message,
            }).then((result) => {
              /* loading();
              location.reload(); */
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
    }
  });
  $(document).on("click", ".btnGuardarPregunta", function () {
    loading();
    var pregunta = $("#pregunta").val();
    var TipoPregunta = $("#TipoPregunta").val();
    var infoAdicional = $("#infoAdicional").val();
    var id_grupo_pregunta = $(this).attr("data-id");
    if (pregunta == null || TipoPregunta == null || TipoPregunta == "") {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "saveQuestion",
          pregunta: pregunta,
          TipoPregunta: TipoPregunta,
          infoAdicional: infoAdicional,
          id_grupo_pregunta: id_grupo_pregunta,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);
          if (data.response == true) {
            var id_pregunta = data.id_pregunta;
            $.ajax({
              url: "php/controllers/vehiculos/vehiculos_controller.php",
              method: "POST",
              data: {
                mod: "getTypeQuestions",
              },
            }).done(function (questions_types) {
              var questions_types = JSON.parse(questions_types);
              if (questions_types.response == true) {
                var html_options = "";
                for (var i = 0; i < questions_types.data.length; i++) {
                  if (
                    questions_types.data[i].id_tipos_preguntas == TipoPregunta
                  ) {
                    html_options +=
                      '<option selected value="' +
                      questions_types.data[i].id_tipos_preguntas +
                      '">' +
                      questions_types.data[i].descripcion +
                      "</option>";
                  } else {
                    html_options +=
                      '<option value="' +
                      questions_types.data[i].id_tipos_preguntas +
                      '">' +
                      questions_types.data[i].descripcion +
                      "</option>";
                  }
                }
                var html_tr = "";
                html_tr += "<tr id='trpregunta" + id_pregunta + "'>";
                html_tr +=
                  "<td id='td_pregunta" +
                  id_pregunta +
                  "'>" +
                  pregunta +
                  "</td>";
                html_tr += "<td>";
                html_tr +=
                  '<select disabled class="form-select selectTipoPregunta" id="tipoPregunta' +
                  id_pregunta +
                  '">';
                html_tr += html_options;
                html_tr += "</select>";
                html_tr += "</td>";
                html_tr += "<td>";
                html_tr += '<div class="input-group">';
                html_tr +=
                  '<i data-id="' +
                  id_pregunta +
                  '" class="fa-solid fa-eye infoAdicional"></i>';
                html_tr += "</div>";
                html_tr += "</td>";
                html_tr += "<td>";
                html_tr += '<div class="btn-group">';
                html_tr +=
                  '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                html_tr += "Opciones";
                html_tr += "</button>";
                html_tr += '<div class="dropdown-menu">';
                html_tr +=
                  '<a class="dropdown-item editPregunta" data-bs-toggle="modal" data-bs-target="#editarPregunta" data-id="' +
                  id_pregunta +
                  '">Editar</a>';
                html_tr +=
                  '<a class="dropdown-item deletePregunta" data-id="' +
                  id_pregunta +
                  '">Eliminar</a>';
                html_tr += "</div>";
                html_tr += "</td>";
                html_tr += "</tr>";

                //$("#preguntasGrupo" + id_grupo_pregunta);
                var table = document.getElementById(
                  "preguntasGrupo" + id_grupo_pregunta
                );
                var rowLength = table;
                var rowLength = table.rows.length;
                var empty_table = 0;
                for (var i = 0; i < rowLength; i += 1) {
                  var row = table.rows[i];
                  var cellLength = row.cells.length;
                  if (cellLength == 1) {
                    empty_table = 1;
                  }
                }
                if (empty_table == 1) {
                  $("#preguntasGrupo" + id_grupo_pregunta)
                    .find("tbody")
                    .empty();
                  $("#preguntasGrupo" + id_grupo_pregunta)
                    .find("tbody")
                    .append(html_tr);
                } else {
                  $("#preguntasGrupo" + id_grupo_pregunta)
                    .find("tbody")
                    .append(html_tr);
                }
                $("#agregarPregunta input").val("");
                $("#agregarPregunta textarea").val("");
                $("#agregarPregunta select").val("");
                $("#agregarPregunta input[type='checkbox']")
                  .prop("checked", false)
                  .change();
                $("#agregarPregunta").modal("hide");
                Swal.fire({
                  icon: "success",
                  title: "Éxito",
                  html: data.message,
                }).then((result) => {});
              } else {
                location.reload();
              }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
    }
  });

  $(document).on("click", ".infoAdicional", function () {
    loading();
    var id_pregunta = $(this).attr("data-id");

    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "getInfoPregunta",
        id_pregunta: id_pregunta,
      },
    }).done(function (info_question) {
      var info_question = JSON.parse(info_question);
      if (info_question.response == true) {
        var info_adicional = info_question.data[0].info_adicional;

        if (info_adicional == null || info_adicional == "") {
          info_adicional = "No hay información adicional";
        }

        Swal.fire({
          icon: "info",
          title: "Información adicional",
          html: info_adicional,
        });
      } else {
        /* Swal.fire({
          icon: "error",
          title: "Error",
          text: data.message,
          timer: 2000,
        }); */
      }
    });
  });
  $(document).on("click", ".deletePregunta", function () {
    loading();
    var id_pregunta = $(this).attr("data-id");

    Swal.fire({
      title: "¿Está seguro de eliminar esta pregunta?",
      text: "No podrá revertir esta acción",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "php/controllers/vehiculos/vehiculos_controller.php",
          method: "POST",
          data: {
            mod: "deletePregunta",
            id_pregunta: id_pregunta,
          },
        }).done(function (info_question) {
          var data = JSON.parse(info_question);
          if (data.response) {
            $("#trpregunta" + id_pregunta).remove();
            Swal.fire({
              icon: "success",
              title: "Éxito",
              html: data.message,
              timer: 2000,
            }).then((result) => {
              //location.reload();
            });
          } else {
            location.reload();
          }
        });
      }
    });
  });

  $(document).on("click", ".btnGuardarFamiliaPregunta", function () {
    loading();
    var familiaPreguntas = $("#familiaPreguntas").val();

    if (familiaPreguntas == null || familiaPreguntas == "") {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "saveFamilyQuestion",
          familiaPreguntas: familiaPreguntas,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            id_familias_preguntas = data.id_familias_preguntas;
            var html = "";
            html += '<div class="col-xl-12">';
            html += '<div class="card card-h-100">';
            html += '<div class="card-body">';
            html +=
              '<div class="d-flex justify-content-between align-items-center mb-2">';
            html +=
              '<h4 class="header-title">' + familiaPreguntas + " <br></h4>";
            html += "<br>";
            html +=
              '<div class="accordion accordion-flush" id="familiaPreguntas' +
              id_familias_preguntas +
              '">';
            html += '<div class="accordion-item">';
            html +=
              '<h2 class="accordion-header" id="flush-heading' +
              id_familias_preguntas +
              '">';
            html +=
              '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#desglosePreguntas' +
              id_familias_preguntas +
              '" aria-expanded="false" aria-controls="desglosePreguntas' +
              id_familias_preguntas +
              '">';
            html += "DESGLOSE DE PREGUNTAS";
            html += "</button>";
            html += "</h2>";
            html +=
              '<div id="desglosePreguntas' +
              id_familias_preguntas +
              '" class="accordion-collapse collapse" aria-labelledby="flush-heading' +
              id_familias_preguntas +
              '" data-bs-parent="#familiaPreguntas' +
              id_familias_preguntas +
              '">';
            html +=
              '<div class="accordion-body" id="accordion' +
              id_familias_preguntas +
              '">';
            html +=
              '<button data-id="' +
              id_familias_preguntas +
              '" type="button" class="btn btn-primary waves-effect waves-light agregarGrupoPreguntas" data-bs-toggle="modal" data-bs-target="#modalAgregarGrupoPreguntas">Agregar grupo de preguntas</button>';
            html += "<br><br>";
            html += '<div class="alert alert-danger" role="alert">';
            html += "No hay grupos de preguntas registradas";
            html += "</div>";
            html += "<br>";
            html += "<br>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            html += "</div>";
            $("#rowFamiliasPreguntas").append(html);

            $("#familiaPreguntas").val("");
            $("#modalAgregarfamiliaPreguntas").modal("hide");
            Swal.fire({
              icon: "success",
              title: "Éxito",
              html: data.message,
              timer: 2000,
            }).then((result) => {
              //location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
    }
  });

  $(document).on("click", ".btnGuardarUnidad", function () {
    loading();
    var placas = $("#placas").val();
    var marca = $("#marca").val();
    var modelo = $("#modelo").val();
    var color = $("#color").val();
    var nombre = $("#nombre").val();
    var observaciones = $("#observaciones").val();

    if (
      placas == "" ||
      marca == "" ||
      modelo == "" ||
      color == "" ||
      nombre == ""
    ) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "saveVehiculo",
          placas: placas,
          marca: marca,
          modelo: modelo,
          color: color,
          nombre: nombre,
          observaciones: observaciones,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            id_vehiculos = data.id_vehiculos;

            if ($(".emptytable").toArray().length > 0) {
              $("#tablaUnidades tbody tr").remove();
            }
            var html = "";
            html += '<tr id="trVehiculo' + id_vehiculos + '">';
            html += '<td id="tdPlacas' + id_vehiculos + '">' + placas + "</td>";
            html +=
              '<td id="tdNombre' + id_vehiculos + '">' + nombre + " </td>";
            html += '<td id="tdMarca' + id_vehiculos + '">' + marca + " </td>";
            html +=
              '<td id="tdModelo' + id_vehiculos + '">' + modelo + " </td>";
            html += '<td id="tdColor' + id_vehiculos + '">' + color + " </td>";
            html +=
              '<td id="tdObservaciones' +
              id_vehiculos +
              '">' +
              observaciones +
              " </td>";
            html += "<td>";
            html += '<div class="btn-group">';
            html +=
              '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</button>';
            html += '<div class="dropdown-menu">';
            html +=
              '<a class="dropdown-item asignarUnidad" data-bs-toggle="modal" data-bs-target="#asignarUnidad" data-id="' +
              id_vehiculos +
              '">Asignar Unidad</a>';
            html +=
              '<a class="dropdown-item registrarRevision"  data-bs-toggle="modal" data-bs-target="#registrarRevision" data-id="' +
              id_vehiculos +
              '">Registrar revisión</a>';
            html +=
              '<a class="dropdown-item historicoRevisiones"  data-bs-toggle="modal" data-bs-target="#historicoRevisiones" data-id="' +
              id_vehiculos +
              '">Histórico de revisiones</a>';
            html +=
              '<a class="dropdown-item historialRevisiones" data-id="' +
              id_vehiculos +
              '" data-tipo-pregunta="' +
              id_vehiculos +
              '" data-bs-target="#historialRevisiones" data-bs-toggle="modal" data-bs-placement="top" title="Histórico de revisiones">Histórico de revisiones</a>';
            html +=
              '<a class="dropdown-item deleteUnidad" data-id="' +
              id_vehiculos +
              '">Eliminar unidad</a>';
            html += "</div>";
            html += "</td>";
            html += "</tr>";

            $("#tablaUnidades tbody").append(html);
            $("#registrarUnidad input").val("");
            $("#registrarUnidad textarea").val("");
            $("#registrarUnidad select").val("");
            $("#registrarUnidad input[type='checkbox']")
              .prop("checked", false)
              .change();
            $("#registrarUnidad").modal("hide");
            Swal.fire({
              icon: "success",
              title: "Éxito",
              html: data.message,
              timer: 2000,
            }).then((result) => {
              //location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
    }
  });

  $(document).on("click", ".deleteUnidad", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");

    Swal.fire({
      title: "¿Está seguro de eliminar esta pregunta?",
      text: "No podrá revertir esta acción",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "php/controllers/vehiculos/vehiculos_controller.php",
          method: "POST",
          data: {
            mod: "deleteVehiculo",
            id_vehiculos: id_vehiculos,
          },
        }).done(function (info_question) {
          var data = JSON.parse(info_question);
          if (data.response) {
            $("#trVehiculo" + id_vehiculos).remove();
            Swal.fire({
              icon: "success",
              title: "Éxito",
              html: data.message,
              timer: 2000,
            }).then((result) => {
              //location.reload();
            });
          } else {
            location.reload();
          }
        });
      }
    });
  });
  $(document).on("click", ".registrarRevision", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");
    $(".guardarRevision").attr("data-id", id_vehiculos);
    Swal.close();
    /*  $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "guardarRevision",
        id_vehiculos: id_vehiculos,
      },
    }).done(function (info_vehicle) {
      var info_vehicle = JSON.parse(info_vehicle);
      if (info_vehicle.response == true) {
        $("#editar_placas").val(info_vehicle.data[0].placas);
        $("#editar_marca").val(info_vehicle.data[0].marca);
        $("#editar_modelo").val(info_vehicle.data[0].modelo);
        $("#editar_color").val(info_vehicle.data[0].color);
        $("#editar_nombre").val(info_vehicle.data[0].nombre_vehiculo);
        $("#editar_observaciones").val(info_vehicle.data[0].observaciones);
        Swal.close();
      } else {
        
      }
    }); */
  });
  $(document).on("click", ".guardarRevision", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");
    var validar = 0;

    var arr_questions = [];
    $(".varialbesPreguntas").each(function () {
      var id_preguntas = $(this).attr("data-id");
      var value = $(this).val();
      var type = $(this).attr("data-type");
      var pregunta = $(this).attr("data-pregunta");

      if (value == "" || value == null || value == undefined) {
        validar++;
      } else {
        arr_questions.push({
          id_preguntas: id_preguntas,
          value: value,
          type: type,
          pregunta: pregunta,
        });
      }
    });
    if (validar > 0) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Debe responder todas las preguntas",
        timer: 2000,
      });
    } else {
      console.log(arr_questions);
      $.ajax({
        url: "php/controllers/vehiculos/vehiculos_controller.php",
        method: "POST",
        data: {
          mod: "guardarRevision",
          arr_questions: arr_questions,
          id_vehiculos: id_vehiculos,
        },
      }).done(function (info_vehicle) {
        var info_vehicle = JSON.parse(info_vehicle);
        if (info_vehicle.response == true) {
          Swal.fire({
            title: "Gracias por responder las preguntas",
          });
          $("#registrarRevision input").val("");
          $("#registrarRevision textarea").val("");
          $("#registrarRevision select").val("");
          $("#registrarRevision input[type='checkbox']")
            .prop("checked", false)
            .change();
          $("#registrarRevision").modal("hide");
        } else {
        }
      });
    }
    /* $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "guardarRevision",
        id_vehiculos: id_vehiculos,
      },
    }).done(function (info_vehicle) {
      var info_vehicle = JSON.parse(info_vehicle);
      if (info_vehicle.response == true) {
        $("#editar_placas").val(info_vehicle.data[0].placas);
        $("#editar_marca").val(info_vehicle.data[0].marca);
        $("#editar_modelo").val(info_vehicle.data[0].modelo);
        $("#editar_color").val(info_vehicle.data[0].color);
        $("#editar_nombre").val(info_vehicle.data[0].nombre_vehiculo);
        $("#editar_observaciones").val(info_vehicle.data[0].observaciones);
        Swal.close();
      } else {
       
      }
    }); */
  });
  $(document).on("click", ".historialRevisiones", function () {
    loading();
    var id_vehiculos = $(this).attr("data-id");
    $("#tableRevisiones").find("tr:gt(0)").remove();

    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "getRevisiones",
        id_vehiculos: id_vehiculos,
      },
    }).done(function (info_revisiones) {
      var info_revisiones = JSON.parse(info_revisiones);

      $("#vehiculoHistorial").html("");
      if (info_revisiones.response == true) {
        var vehicle_name = info_revisiones.data[0].vehiculo;
        $("#vehiculoHistorial").html(vehicle_name);
        var html = "";
        for (var i = 0; i < info_revisiones.data.length; i++) {
          var fecha = info_revisiones.data[i].fecha;
          var nombre = info_revisiones.data[i].nombre_completo;
          var fecha = fecha.split(" ");
          var fecha = fecha[0];
          var fecha = fecha.split("-");
          var fecha = fecha[2] + "/" + fecha[1] + "/" + fecha[0];

          html += "<tr>";
          html += "<td>" + fecha + "</td>";
          html += "<td>" + nombre + "</td>";
          html +=
            '<td><button class="btn btn-danger btn-sm generarPDFRevision" data-id-vehiculo="' +
            id_vehiculos +
            '" data-id="' +
            info_revisiones.data[i].id_index_checlist_log +
            '"><i class="fa-solid fa-file-pdf"></i></button></td>';
          html += "</tr>";
        }
        $("#tableRevisiones").append(html);
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se encontraron revisiones",
          timer: 2000,
        });
        var html2 = "";
        html2 += "<tr>";
        html2 += '<td colspan="3">No se encontraron revisiones</td>';
        html2 += "</tr>";
        $("#tableRevisiones").append(html2);
      }
    });
    Swal.close();
  });

  $("#personalVehiculo").select2({
    dropdownParent: $("#asignarUnidad"),
  });
});

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
