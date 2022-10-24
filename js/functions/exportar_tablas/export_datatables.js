$(document).ready(function () {
  var title_excel = $(".title_excel").text();
  var archive_name = $(".archive_name").text();

  $("#dataTableReport").DataTable({
    language: {
      lengthMenu: "Mostrar _MENU_ resultados por página",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando página _PAGE_ de _PAGES_",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(filtrados de un total de _MAX_ registros)",
      paginate: {
        previous: "Página anterior",
        next: "Página siguiente",
        first: "Primera página",
        last: "Última página",
      },
      search: "Buscar:",
    },
    responsive: true,
    dom: "Bfrtip",
    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i>',
        titleAttr: "Exportar a Excel",
        title: archive_name,
        className: "btn btn-success",
        excelStyles: {
          template: "blue_gray_medium",
        },
        pageStyle: {
          sheetPr: {
            pageSetUpPr: {
              fitToPage: 1,
            },
            printOptions: {
              horizontalCentered: true,
              verticalCentered: true,
            },
            pageSetup: {
              paperSize: 1,
              orientation: "landscape",
              fitToWidth: 1,
              fitToHeight: 0,
            },
          },
        },
        insertCells: [
          {
            cells: "A1",
            content: title_excel,
          },
        ],
      },
      {
        extend: "print",
        text: '<i class="fas fa-print"></i>',
        title: archive_name,
        titleAttr: "Imprimir",
        className: "btn btn-info",
      },
    ],
  });
  $(".dt-buttons").append(
    '<a href="#" class="btn btn-danger" id="export_excel"><span><i class="fas fa-file-pdf"></i></span></a>'
  );
});
