var briteChartApp = window.briteChartApp || {};
!(function (i, e) {
  "use strict";
  var c = [
    "#727cf5",
    "#0acf97",
    "#6c757d",
    "#fa5c7c",
    "#ffbc00",
    "#39afd1",
    "#e3eaef",
  ];
    (e.createDonutChart = function (e, t) {
      var a = i(e).data("colors"),
        l = a ? a.split(",") : c.concat(),
        n = britecharts.donut(),
        u = britecharts.legend();
      u.width(250).height(200).colorSchema(l).numberFormat("s"),
        n
          .height(300)
          .highlightSliceById(3)
          .colorSchema(l)
          .hasFixedHighlightedSlice(!0)
          .internalRadius(80)
          .on("customMouseOver", function (e) {
            u.highlight(e.data.id);
          })
          .on("customMouseOut", function () {
            u.clearHighlight();
          }),
        d3.select(e).datum(t).call(n),
        d3.select(".legend-chart-container").datum(t).call(u);
    }),
    i(function () {
      var e = [
          { name: "Mon", value: 2100 },
          { name: "Tue", value: 5e3 },
          { name: "Wed", value: 4e3 },
          { name: "Thu", value: 5500 },
          { name: "Fri", value: 6500 },
          { name: "Sat", value: 4500 },
          { name: "Sun", value: 3500 },
        ],
        t = {
          dataByTopic: [
            {
              topic: 103,
              topicName: "San Francisco",
              dates: [
                {
                  date: "2018-06-27T07:00:00.000Z",
                  value: 1,
                  fullDate: "2018-06-27T07:00:00.000Z",
                },
                {
                  date: "2018-06-28T07:00:00.000Z",
                  value: 1,
                  fullDate: "2018-06-28T07:00:00.000Z",
                },
                {
                  date: "2018-06-29T07:00:00.000Z",
                  value: 4,
                  fullDate: "2018-06-29T07:00:00.000Z",
                },
                {
                  date: "2018-06-30T07:00:00.000Z",
                  value: 2,
                  fullDate: "2018-06-30T07:00:00.000Z",
                },
                {
                  date: "2018-07-01T07:00:00.000Z",
                  value: 3,
                  fullDate: "2018-07-01T07:00:00.000Z",
                },
                {
                  date: "2018-07-02T07:00:00.000Z",
                  value: 3,
                  fullDate: "2018-07-02T07:00:00.000Z",
                },
                {
                  date: "2018-07-03T07:00:00.000Z",
                  value: 0,
                  fullDate: "2018-07-03T07:00:00.000Z",
                },
                {
                  date: "2018-07-04T07:00:00.000Z",
                  value: 3,
                  fullDate: "2018-07-04T07:00:00.000Z",
                },
                {
                  date: "2018-07-05T07:00:00.000",
                  value: 1,
                  fullDate: "2018-07-05T07:00:00.000Z",
                },
                {
                  date: "2018-07-06T07:00:00.000Z",
                  value: 2,
                  fullDate: "2018-07-06T07:00:00.000Z",
                },
                {
                  date: "2018-07-07T07:00:00.000Z",
                  value: 0,
                  fullDate: "2018-07-07T07:00:00.000Z",
                },
                {
                  date: "2018-07-08T07:00:00.000Z",
                  value: 2,
                  fullDate: "2018-07-08T07:00:00.000Z",
                },
                {
                  date: "2018-07-09T07:00:00.000Z",
                  value: 1,
                  fullDate: "2018-07-09T07:00:00.000Z",
                },
                {
                  date: "2018-07-10T07:00:00.000Z",
                  value: 4,
                  fullDate: "2018-07-10T07:00:00.000Z",
                },
                {
                  date: "2018-07-11T07:00:00.000Z",
                  value: 2,
                  fullDate: "2018-07-11T07:00:00.000Z",
                },
                {
                  date: "2018-07-12T07:00:00.000Z",
                  value: 1,
                  fullDate: "2018-07-12T07:00:00.000Z",
                },
                {
                  date: "2018-07-13T07:00:00.000Z",
                  value: 6,
                  fullDate: "2018-07-13T07:00:00.000Z",
                },
                {
                  date: "2018-07-14T07:00:00.000Z",
                  value: 5,
                  fullDate: "2018-07-14T07:00:00.000Z",
                },
                {
                  date: "2018-07-15T07:00:00.000Z",
                  value: 2,
                  fullDate: "2018-07-15T07:00:00.000Z",
                },
              ],
            },
          ],
        },
        a = [
          { name: "aaaaaa", id: 1, quantity: 86, percentage: 5 },
          { name: "Blazing", id: 2, quantity: 300, percentage: 18 },
          { name: "Dazzling", id: 3, quantity: 276, percentage: 16 },
          { name: "Radiant", id: 4, quantity: 195, percentage: 11 },
          { name: "Sparkling", id: 5, quantity: 36, percentage: 2 },
          { name: "Other", id: 0, quantity: 814, percentage: 48 },
        ];
      function u() {
        d3.selectAll(".bar-chart").remove(),
          d3.selectAll(".line-chart").remove(),
          d3.selectAll(".donut-chart").remove(),
          d3.selectAll(".britechart-legend").remove(),
          d3.selectAll(".brush-chart").remove(),
          d3.selectAll(".step-chart").remove(),
          0 < i(".bar-container").length &&
            briteChartApp.createBarChart(".bar-container", e),
          0 < i(".bar-container-horizontal").length &&
            briteChartApp.createHorizontalBarChart(
              ".bar-container-horizontal",
              e
            ),
          0 < i(".line-container").length &&
            briteChartApp.createLineChart(".line-container", t),
          0 < i(".donut-container").length &&
            briteChartApp.createDonutChart(".donut-container", a),
          0 < i(".brush-container").length &&
            briteChartApp.createBrushChart(".brush-container", l),
          0 < i(".step-container").length &&
            briteChartApp.createStepChart(".step-container", n);
      }
      i(window).on("resize", function (e) {
        e.preventDefault(), setTimeout(u, 200);
      }),
        u();
    });
})(jQuery, briteChartApp);
