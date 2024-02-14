$(document).ready(function () {
  $(document).on("click", ".generarPDFRevision", function () {
    id_revision = $(this).attr("data-id");
    id_vehicle = $(this).attr("data-id-vehiculo");
    //--- --- ---//
    loading();
    //--- --- ---//
    $.ajax({
      url: "php/controllers/vehiculos/vehiculos_controller.php",
      method: "POST",
      data: {
        mod: "reportVehicleRevision",
        id_index_checlist: id_revision,
        id_vehiculo: id_vehicle,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        if (data.response) {
          /* console.log(data); */
          //--- --- ---//
          if (data.data.dataFamilies.length) {
            //--- --- ---//
            console.log(data.data);
            downloadReportVehicleRevision(data.data);
            Swal.close();
          } else {
            Swal.fire(
              "Atención!",
              "No hay datos para generar el reporte",
              "info"
            );
          }
          //--- --- ---//
          swal.close();
          //--- --- ---//
        } else {
          Swal.fire("Atención!", data.message, "info");
        }
      })
      .fail(function (message) {
        Swal.fire(
          "Error!",
          "Error al intentar conectarse con la Base de Datos :/",
          "error"
        );
      });
    //--- --- ---//
  });
});

function downloadReportVehicleRevision(data) {
  //console.log(data);
  var table1 = "";
  var table = "";
  //--- --- ---//
  window.jsPDF = window.jspdf.jsPDF;
  var doc = new jsPDF({
    orientation: "p",
    format: "letter",
  });

  doc.addFileToVFS("js/vendor/jsPDF/fonts/VarelaRound-Regular.ttf");
  doc.addFont(
    "js/vendor/jsPDF/fonts/VarelaRound-Regular.ttf",
    "VarelaRound-Regular",
    "normal"
  );
  //--- --- ---//
  doc.setFontSize(11);
  doc.setFont("VarelaRound-Regular"); // set font
  //--- --- ---//

  doc.autoTable({
    theme: "plain",
    startY: 5,
    tableWidth: 190,
    margin: {
      left: 12,
    },
    headStyles: {
      halign: "left",
      valign: "middle",
      font: "VarelaRound-Regular",
      fillColor: [255, 255, 255],
      textColor: [0, 0, 0],
      fontSize: 12,
    },
    head: [
      [
        {
          content: "INFORME CUALITATIVO | ENTREGA: " + installment,
          styles: { halign: "center" },
        },
      ],
      [
        {
          content: (
            "Alumno: " +
            data.students.student_code +
            " | " +
            data.students.student_name
          ).toUpperCase(),
          styles: { fontSize: 11, halign: "center" },
        },
      ],
      [
        {
          content: "GRUPO: " + data.students.group_code,
          styles: { fontSize: 11, halign: "center" },
        },
      ],
      [
        {
          content: "MAPAS DE APRENDIZAJE: EVALUACIÓN DE HEBREO",
          styles: { halign: "center" },
        },
      ],
    ],
  });
  doc.addImage(getLogoBangueoloFemalesYKTBase64(), "png", 8, 5, 20, 20);
  //--- --- ---//
  //--- MDA GENERAL ---//
  var positionYfinal = 58;
  if (data.results_evc_normal.length > 0) {
    for (var i = 0; i < data.results_evc_normal.length; i++) {
      if ((data.results_evc_normal[i].topic.id_learning_map = "21")) {
        //--- --- --- ---//
        var catalog_symbol = [];
        for (
          var b = 0;
          b <
          data.results_evc_normal[i].data.questions_evaluations.evaluations
            .length;
          b++
        ) {
          catalog_symbol.push(
            data.results_evc_normal[i].data.questions_evaluations.evaluations[b]
              .symbol
          );
        }
        //--- --- --- ---//
        var header = [
          [
            {
              content: "",
              rowSpan: 2,
              styles: {
                halign: "center",
              },
            },
            {
              content:
                data.results_evc_normal[i].data.assgs[0].assg.teacher_name,
              colSpan:
                data.results_evc_normal[i].data.questions_evaluations
                  .evaluations.length,
              styles: {
                halign: "center",
              },
            },
          ],
          catalog_symbol,
        ];
        //--- LISTA PREGUNTAS ---//
        var body_mda = [];
        //--- --- ---//
        for (
          var f = 0;
          f <
          data.results_evc_normal[i].data.questions_evaluations.questions
            .length;
          f++
        ) {
          //console.log('Pregunta');
          var data_question = [
            data.results_evc_normal[i].data.questions_evaluations.questions[f]
              .question,
          ];
          //--- --- ---//
          var answer_to_question = false;
          //--- --- ---//
          for (
            var b = 0;
            b <
            data.results_evc_normal[i].data.questions_evaluations.evaluations
              .length;
            b++
          ) {
            //--- --- ---/
            var answer = null;
            var answer_find = false;
            //--- --- ---//
            //--- RESPUESTAS ---//
            for (
              var d = 0;
              d < data.results_evc_normal[i].data.assgs[0].answers.length;
              d++
            ) {
              //--- --- ---//
              if (
                data.results_evc_normal[i].data.assgs[0].assg.ascc_lm_assgn ==
                  data.results_evc_normal[i].data.assgs[0].answers[d]
                    .ascc_lm_assgn &&
                data.results_evc_normal[i].topic.assc_mpa_id ==
                  data.results_evc_normal[i].data.assgs[0].answers[d]
                    .assc_mpa_id &&
                data.results_evc_normal[i].data.questions_evaluations.questions[
                  f
                ].id_question_bank ==
                  data.results_evc_normal[i].data.assgs[0].answers[d]
                    .id_question_bank &&
                data.results_evc_normal[i].data.questions_evaluations
                  .evaluations[b].id_evaluation_bank ==
                  data.results_evc_normal[i].data.assgs[0].answers[d]
                    .id_evaluation_bank
              ) {
                answer_find = true;
                answer_to_question = true;
                answer = {
                  content: "",
                  styles: {
                    fillColor:
                      data.results_evc_normal[i].data.questions_evaluations
                        .evaluations[b].colorHTML,
                  },
                };
              }
              //--- --- ---//
            }
            //--- --- ---//
            if (!answer_find) {
              answer = {
                content: "",
                styles: {
                  fillColor: "#FFFFFF",
                },
              };
            }
            data_question.push(answer);
          }
          //--- --- ---//
          body_mda.push(data_question);
          //console.log(data_question);
          //--- --- ---//
        }
        //--- --- ---//
        //--- --- --- ---//
        doc.text(
          23,
          positionYfinal - 3,
          data.results_evc_normal[i].topic.name_question_group.toUpperCase()
        );
        //--- --- ---//
        doc.autoTable({
          startY: positionYfinal,
          margin: {
            left: 22,
          },
          tableWidth: 170,
          headStyles: {
            fillColor: [241, 211, 245],
            textColor: [0, 0, 0],
            lineWidth: 0.1,
            lineColor: [0, 0, 0],
            fontSize: 9,
            halign: "center",
            valign: "middle",
          },
          bodyStyles: {
            fontSize: 7,
            halign: "center",
            lineWidth: 0.1,
            lineColor: [0, 0, 0],
            halign: "center",
            valign: "middle",
          },
          head: header,
          body: body_mda,
          theme: "grid",
        });
        //--- --- ---//
        positionYfinal = doc.lastAutoTable.finalY + 15;
        //--- --- ---//
      }
    }
  }
  //--- COMENTARIOS FINALES ---//
  if (data.final_comments_evc_normal.length > 0) {
    if (data.final_comments_evc_normal[0].comments.length > 0) {
      //--- --- ---//
      //--- --- ---//
      var header = [["FORTALEZAS", "AREAS DE OPORTUNIDAD"]];
      var body_mda = [
        [
          data.final_comments_evc_normal[0].comments[0].comments1,
          data.final_comments_evc_normal[0].comments[0].comments2,
        ],
      ];
      //--- --- ---//
      //--- --- ---//
      positionYfinal += 5;
      doc.text(23, positionYfinal - 3, "COMENTARIOS");
      //--- --- ---//
      doc.autoTable({
        startY: positionYfinal,
        margin: {
          left: 22,
        },
        tableWidth: 170,
        headStyles: {
          fillColor: [241, 211, 245],
          textColor: [0, 0, 0],
          lineWidth: 0.1,
          lineColor: [0, 0, 0],
          fontSize: 9,
          halign: "center",
          valign: "middle",
        },
        bodyStyles: {
          fontSize: 7,
          halign: "center",
          lineWidth: 0.1,
          lineColor: [0, 0, 0],
          halign: "center",
          valign: "middle",
        },
        head: header,
        body: body_mda,
        theme: "grid",
      });
      //--- --- ---//
    }
  }
  //--- --- ---//
  doc.setFontSize(7);
  let date = new Date();
  let output =
    String(date.getDate()).padStart(2, "0") +
    "/" +
    String(date.getMonth() + 1).padStart(2, "0") +
    "/" +
    date.getFullYear();
  doc.text(
    90,
    272,
    "Código de alumno: " +
      data.students.student_code +
      "  |  Grupo iTeach: " +
      data.students.group_code +
      "  |  Fecha de emisión: " +
      output
  );

  //--- --- ---//
  doc.save(data.students.student_name.toUpperCase() + ".pdf");
  Swal.close();
  /* var string = doc.output("datauristring");
    var embed = "<embed width='100%' height='100%' src='" + string + "'/>";
    var x = window.open();
    x.document.open();
    x.document.write(embed);
    x.document.close();
     */ //--- --- ---//
}
