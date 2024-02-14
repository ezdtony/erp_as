$(document).ready(function () {
  graficarDatos();

  function graficarDatos() {
    var mes = $("#select_mes").val();
    $.ajax({
      url: "../../js/graficas/php/dona.php",
      method: "POST",
      data: {
        mes: mes,
      },
      dataType: "json",
      success: function (chart_data) {
        var tipo = [];
        var gasto = [];
        var colores = [];

        var coloresDinamicos = function () {
          var r = Math.round(Math.random() * 255);
          var g = Math.round(Math.random() * 255);
          var b = Math.round(Math.random() * 255);
          return "rgba(" + r + "," + g + "," + b + "," + "0.75)";
        };

        for (var i = 0; i < chart_data.length; i++) {
          tipo.push(chart_data[i].gasto);
          gasto.push(chart_data[i].suma);
          colores.push(coloresDinamicos());
        }
        console.log(tipo);
        console.log(gasto);
        var ctx = document.getElementById("dona_gastos").getContext("2d");
        var myChart = new Chart(ctx, {
          type: "doughnut",
          data: {
            labels: tipo,
            datasets: [
              {
                label: "Tipos de Gasto",
                data: gasto,
                backgroundColor: colores,
                borderColor: ["rgba(255, 255, 255, 1)"],
                borderWidth: 1,
                hoverOffset: 30,
              },
            ],
          },
        });
      },
    });
  }

  $(document).on("change", "#id_proyecto", function () {
    var id_proyecto = $(this).val();
    var txt_proyecto = $(this).find("option:selected").text();
    $("#div_grafica_cont").show();
    var limpiar = "";
    $("#grafica_dona").empty();
    var agregarCanvas =
      '<h5 class="card-title">Gastos por Obra</h5><h5 class="card-title">' +
      txt_proyecto +
      '</h5><canvas id="dona_gastos" width="30%" height="40%"></canvas>';
    $("#grafica_dona").html(agregarCanvas);
    $.ajax({
      url: "php/controllers/graphics_controller.php",
      method: "POST",
      data: {
        id_proyecto: id_proyecto,
        mod: "getChartData",
      },
        dataType: "json",
    })
      .done(function (chart_data) {

        console.log(chart_data);
        //--- --- ---//
        var tipo = [];
        var gasto = [];
        var colores = [];

        var coloresDinamicos = function () {
          var r = Math.round(Math.random() * 255);
          var g = Math.round(Math.random() * 255);
          var b = Math.round(Math.random() * 255);
          return "rgba(" + r + "," + g + "," + b + "," + "0.75)";
        };
        var number = chart_data.length;
        console.log(number);
        if (number == 0) {
          $("#div_grafica_cont").hide();
        }
            
        
        for (var i = 0; i < chart_data.length; i++) {
          tipo.push(chart_data[i].tipo_material);
          gasto.push(chart_data[i].total_pagos);
          colores.push(coloresDinamicos());
        }
        //console.log(tipo);
        //console.log(gasto);
        var ctx = document.getElementById("dona_gastos").getContext("2d");
        var myChart = new Chart(ctx, {
          type: "doughnut",
          data: {
            labels: tipo,
            datasets: [
              {
                label: "Tipos de Gasto",
                data: gasto,
                backgroundColor: colores,
                borderColor: ["rgba(255, 255, 255, 1)"],
                borderWidth: 1,
                hoverOffset: 30,
              },
            ],
          },
          responsive: true,
          maintainAspectRatio: true, 
        });
        //--- --- ---//
      })
      .fail(function (message) {
        console.log(message);
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  });
});
