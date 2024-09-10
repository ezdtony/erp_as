$(document).ready(function () {
  createBarCharts();
  createPieChart();
});
/* createBarCharts(); */
function createBarCharts() {
  $.ajax({
    url: "php/controllers/charts/index_charts/index_charts_controller.php",
    method: "POST",
    data: {
      mod: "getBarChartInfo",
    },
  })
    .done(function (data) {
      var data = JSON.parse(data);
      console.log(data);

      if (data.response == true) {
        //dynamic data pass
        var chart_data = [];
        for (var i = 0; i < data.data.length; i++) {
          var total_depositos = parseFloat(
            data.data[i].total_depositos.replace(",", "")
          );
          var total_gastos = parseFloat(
            data.data[i].total_gastos.replace(",", "")
          );
          chart_data.push({
            mes: data.data[i].mes,
            depositos: total_depositos,
            gastos: total_gastos,
          });
        }

        console.log(chart_data);

        am5.ready(function () {
          // Create root element
          // https://www.amcharts.com/docs/v5/getting-started/#Root_element
          var root = am5.Root.new("bar__chart_index");

          // Set themes
          // https://www.amcharts.com/docs/v5/concepts/themes/
          root.setThemes([am5themes_Animated.new(root)]);

          // Create chart
          // https://www.amcharts.com/docs/v5/charts/xy-chart/
          var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
              panX: false,
              panY: false,
              wheelX: "panX",
              wheelY: "zoomX",
              layout: root.verticalLayout,
            })
          );

          // Add legend
          // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
          var legend = chart.children.push(
            am5.Legend.new(root, {
              centerX: am5.p50,
              x: am5.p50,
            })
          );

          var data = chart_data;

          // Create axes
          // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
          var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
              categoryField: "mes",
              renderer: am5xy.AxisRendererX.new(root, {
                cellStartLocation: 0.1,
                cellEndLocation: 0.9,
              }),
              tooltip: am5.Tooltip.new(root, {}),
            })
          );

          xAxis.data.setAll(data);

          var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
              renderer: am5xy.AxisRendererY.new(root, {}),
            })
          );

          // Add series
          // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
          function makeSeries(name, fieldName) {
            var series = chart.series.push(
              am5xy.ColumnSeries.new(root, {
                name: name,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: fieldName,
                categoryXField: "mes",
              })
            );

            series.columns.template.setAll({
              tooltipText: "{name}, {categoryX}:{valueY}",
              width: am5.percent(90),
              tooltipY: 0,
            });

            series.data.setAll(data);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear();

            series.bullets.push(function () {
              return am5.Bullet.new(root, {
                locationY: 0,
                sprite: am5.Label.new(root, {
                  text: "{valueY}",
                  fill: root.interfaceColors.get("alternativeText"),
                  centerY: 0,
                  centerX: am5.p50,
                  populateText: true,
                }),
              });
            });

            legend.data.push(series);
          }
          makeSeries("Depósitos", "depositos");
          makeSeries("Comprobado", "gastos");

          // Make stuff animate on load
          // https://www.amcharts.com/docs/v5/concepts/animations/
          chart.appear(1000, 100);
        });
      } else {
      }

      //--- --- ---//
      //--- --- ---//
    })
    .fail(function (message) {
      /*  VanillaToasts.create({
            title: "Error",
            text: "Ocurrió un error, intentelo nuevamente",
            type: "error",
            timeout: 1200,
            positionClass: "topRight",
          }); */
    });
}

function createPieChart() {
  $.ajax({
    url: "php/controllers/charts/index_charts/index_charts_controller.php",
    method: "POST",
    data: {
      mod: "getPieChartInfo",
    },
  }).done(function (data) {
    var data = JSON.parse(data);
    if (data.response == true) {
      var chart_data = [];
      for (var i = 0; i < data.data.length; i++) {
        var txt_gas = data.data[i].total_gastos;
        /* console.log(txt_gas); */
        var total_gastos = parseFloat(txt_gas);
        chart_data.push({
          value: total_gastos,
          category: data.data[i].tipo_gasto,
        });
      }
      console.log(chart_data);

      am5.ready(function () {
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("pie_chart_index");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([am5themes_Animated.new(root)]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(
          am5percent.PieChart.new(root, {
            layout: root.verticalLayout,
          })
        );

        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(
          am5percent.PieSeries.new(root, {
            valueField: "value",
            categoryField: "category",
          })
        );

        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        series.data.setAll(chart_data);

        // Create legend
        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
        var legend = chart.children.push(
          am5.Legend.new(root, {
            centerX: am5.percent(50),
            x: am5.percent(50),
            marginTop: 15,
            marginBottom: 15,
          })
        );

        legend.data.setAll(series.dataItems);

        // Play initial series animation
        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series

        series.slices.template.set("tooltipText", "{category}: {value}");
        series.appear(1000, 100);


        var total = chart_data.reduce(function(acc, data) {
          return acc + data.value;
        }, 0);

        
        document.getElementById("titleDiv").innerHTML = "Total comprobado: $" + total.toFixed(2);
      }); // end am5.ready()
    } else {
    }
  });

  // Create root and chart
}
