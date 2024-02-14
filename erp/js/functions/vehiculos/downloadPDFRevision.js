function downloadReportVehicleRevision(data) {
  console.log(data);
  var table1 = "";
  var table = "";
  //--- --- ---//
  window.jsPDF = window.jspdf.jsPDF;
  var doc = new jsPDF({
    orientation: "p",
    format: "letter",
  });

  doc.addFileToVFS("js/jsPDF/fonts/VarelaRound-Regular.ttf");
  doc.addFont(
    "js/jsPDF/fonts/VarelaRound-Regular.ttf",
    "VarelaRound-Regular",
    "normal"
  );
  //--- --- ---//
  doc.setFontSize(11);
  doc.setFont("VarelaRound-Regular"); // set font
  //--- --- ---//

  //--- --- ---//
  vehicle_name = data.vehicleInfo[0].nombre_vehiculo;
  marca = data.vehicleInfo[0].marca;
  modelo = data.vehicleInfo[0].modelo;
  placas = data.vehicleInfo[0].placas;
  color = data.vehicleInfo[0].color;

  fecha_revision = data.indexInfo[0].date_log;
  fecha_revision = fecha_revision.split(" ");
  fecha_revision2 = fecha_revision[0];
  fecha_revision = fecha_revision[0];

  fecha_revision = fecha_revision.split("-");
  fecha_revision =
    fecha_revision[2] + "/" + fecha_revision[1] + "/" + fecha_revision[0];
  nombre_registro = data.indexInfo[0].nombre_completo;

  doc.addImage(getLogoASBase64(), "png", 8, 5, 40, 20);

  doc.autoTable({
    theme: "plain",
    startY: 5,
    tableWidth: 120,
    margin: {
      left: 55,
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
          content: "INFORME DE REVISIÓN DE VEHÍCULO",
          styles: { halign: "center" },
        },
      ],
      [
        {
          content: (
            "Vehículo: " +
            vehicle_name +
            " " +
            marca +
            " " +
            modelo +
            " PLACAS: " +
            placas
          ).toUpperCase(),
          styles: { fontSize: 9, halign: "center" },
        },
      ],

      [
        {
          content: (
            "Registrado por: " +
            nombre_registro +
            " el " +
            fecha_revision
          ).toUpperCase(),
          styles: { fontSize: 9, halign: "center" },
        },
      ],
    ],
  });

  //--- --- ---//

  var positionYfinal = 45;
  for (let fp = 0; fp < data.dataFamilies.length; fp++) {
    var familia = data.dataFamilies[fp].familia;
    var number = fp + 1;
    doc.autoTable({
      theme: "plain",
      startY: positionYfinal,
      tableWidth: 190,
      margin: {
        left: 12,
      },
      headStyles: {
        halign: "left",
        valign: "middle",
        font: "VarelaRound-Regular",
        fillColor: [18, 48, 97],
        textColor: [255, 255, 255],

        fontSize: 10,
      },
      head: [
        [
          {
            content: number + ". " + familia.toUpperCase(),
          },
        ],
      ],
    });

    //--- --- ---//
    if (data.dataFamilies[fp].grupos.length > 0) {
      var groups_questions = data.dataFamilies[fp].grupos;
      for (let gq = 0; gq < groups_questions.length; gq++) {
        if (positionYfinal > 210) {
          doc.addPage();
          positionYfinal = 30;
          doc.addImage(getLogoASBase64(), "png", 8, 5, 40, 20);
          doc.autoTable({
            theme: "plain",
            startY: 5,
            tableWidth: 120,
            margin: {
              left: 55,
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
                  content: "INFORME DE REVISIÓN DE VEHÍCULO",
                  styles: { halign: "center" },
                },
              ],
              [
                {
                  content: (
                    "Vehículo: " +
                    vehicle_name +
                    " " +
                    marca +
                    " " +
                    modelo +
                    " PLACAS: " +
                    placas
                  ).toUpperCase(),
                  styles: { fontSize: 9, halign: "center" },
                },
              ],

              [
                {
                  content: (
                    "Registrado por: " +
                    nombre_registro +
                    " el " +
                    fecha_revision
                  ).toUpperCase(),
                  styles: { fontSize: 9, halign: "center" },
                },
              ],
            ],
          });
        } else {
          positionYfinal = doc.autoTable.previous.finalY + 5;
        }
        var grupo = groups_questions[gq].grupo;
        var data_questions = [];
        if (groups_questions[gq].preguntas.length > 0) {
          var questions = groups_questions[gq].preguntas;
          /* console.log(questions); */
          for (let q = 0; q < questions.length; q++) {
            var question = questions[q].pregunta;
            if (
              questions[q].respuestas.length==0
            ) {
              var answer = "No hay respuesta registrada";
            } else {
              var answer = questions[q].respuestas[0].respuesta_sys;
            }
            var tr_questions = [];
            tr_questions = [
              {
                content: question,
                styles: { halign: "left" },
              },
              {
                content: answer,
                styles: { halign: "left" },
              },
            ];
            data_questions.push(tr_questions);
          }
        } else {
          questions = [
            {
              content: "No hay preguntas registradas",
              styles: { halign: "center" },
              colSpan: 2,
            },
          ];
          data_questions.push(questions);
        }

        doc.autoTable({
          theme: "grid",
          startY: positionYfinal,
          tableWidth: 190,
          margin: {
            left: 12,
          },
          headStyles: {
            halign: "left",
            valign: "middle",
            font: "VarelaRound-Regular",
            fillColor: [125, 136, 255],
            textColor: [255, 255, 255],
            fontSize: 9,
          },
          head: [
            [
              {
                content: "Sección: " + grupo.toUpperCase(),
                colSpan: 2,
                styles: { halign: "center", fillColor: [95, 108, 245] },
              },
            ],
            [
              {
                content: "Pregunta",
                styles: { halign: "center", fontStyle: "bold" },
              },
              {
                content: "Respuesta",
                styles: { halign: "center", fontStyle: "bold" },
              },
            ],
          ],
          bodyStyles: {
            halign: "left",
            valign: "middle",
            font: "VarelaRound-Regular",
            fillColor: [255, 255, 255],
            textColor: [0, 0, 0],
            fontSize: 9,
          },
          body: data_questions,
        });

        //--- --- ---//
      }
    } else {
      positionYfinal = doc.autoTable.previous.finalY + 5;
      doc.autoTable({
        theme: "plain",
        startY: positionYfinal,
        tableWidth: 190,
        margin: {
          left: 12,
        },
        headStyles: {
          halign: "left",
          valign: "middle",
          font: "VarelaRound-Regular",
          fillColor: [255, 157, 77],
          textColor: [255, 255, 255],
          fontSize: 9,
        },
        head: [
          [
            {
              content: "No hay secciones ni preguntas registradas",
            },
          ],
        ],
        bodyStyles: {
          halign: "left",
          valign: "middle",
          font: "VarelaRound-Regular",
          fillColor: [255, 255, 255],
          textColor: [0, 0, 0],
          fontSize: 9,
        },
      });
    }
    if (positionYfinal > 210) {
      doc.addPage();
      positionYfinal = 45;
      doc.addImage(getLogoASBase64(), "png", 8, 5, 40, 20);
      doc.autoTable({
        theme: "plain",
        startY: 5,
        tableWidth: 120,
        margin: {
          left: 55,
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
              content: "INFORME DE REVISIÓN DE VEHÍCULO",
              styles: { halign: "center" },
            },
          ],
          [
            {
              content: (
                "Vehículo: " +
                vehicle_name +
                " " +
                marca +
                " " +
                modelo +
                " PLACAS: " +
                placas
              ).toUpperCase(),
              styles: { fontSize: 9, halign: "center" },
            },
          ],

          [
            {
              content: (
                "Registrado por: " +
                nombre_registro +
                " el " +
                fecha_revision
              ).toUpperCase(),
              styles: { fontSize: 9, halign: "center" },
            },
          ],
        ],
      });
    } else {
      //--- --- ---//
      positionYfinal = doc.lastAutoTable.finalY + 10;
    }
  }

  //--- --- ---//
  doc.save("REVISIÓN "+vehicle_name +" "+ fecha_revision2.toUpperCase() + ".pdf");
  Swal.close();
  /* var string = doc.output("datauristring");
    var embed = "<embed width='100%' height='100%' src='" + string + "'/>";
    var x = window.open();
    x.document.open();
    x.document.write(embed);
    x.document.close();
     */ //--- --- ---//
}
