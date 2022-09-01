/* var options = {
    series: [
      {
        name: "Depositado",
        data: [44, 55, 57],
      },
      {
        name: "Comprobado",
        data: [76, 85, 101],
      },
      {
        name: "Pendiente",
        data: [35, 41, 36],
      },
    ],
    chart: {
      type: "bar",
      height: 350,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "60%",
        endingShape: "rounded",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 2,
      colors: ["transparent"],
    },
    xaxis: {
      categories: ["Ene", "Feb", "Mar"],
    },
    yaxis: {
      title: {
        text: "$ (thousands)",
      },
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return "$ " + val + " thousands";
        },
      },
    },
  };
  
  var chart = new ApexCharts(document.querySelector("#dashboardChart1"), options);
  chart.render();
   */

// -- GRAFICA DE PASTEL -- //
$.ajax({
  url: "php/controllers/graficas_inicio/graficas_controller.php",
  method: "POST",
  data: {
    mod: "getPieChartInfo",
  },
})
  .done(function (data) {
    var data = JSON.parse(data);
    console.log(data);

    if (data.response == true) {
      var labels = [];
      var series = [];
      for (let gas = 0; gas < data.data.length; gas++) {
        const concepto = data.data[gas].tipo_gasto;
        const total_gastos = data.data[gas].total_gastos;

        labels.push(concepto);
        series.push(total_gastos);

        //series += total_gastos + ", ";
      }

      //series = series.sub///string(0, series.length - 2);

      graficaPastel(labels, series);
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
console.log(labels);
function graficaPastel(labels, series) {
  series_chart = [];
  for (let ser = 0; ser < series.length; ser++) {
    series_chart.push(series[ser]);
  }
  series_chart = series_chart.join(", ");
  console.log(series_chart);
  var options = {
    series: '['+series_chart+']',

    chart: {
      width: 500,
      type: "pie",
    },
    labels: labels,
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: 200,
          },
          legend: {
            position: "bottom",
          },
        },
      },
    ],
  };

  var chart = new ApexCharts(
    document.querySelector("#dashboardChart2"),
    options
  );
  chart.render();
}
