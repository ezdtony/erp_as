(function (c) {
  "function" === typeof define && define.amd
    ? define(
        ["jquery", "datatables.net", "datatables.net-buttons"],
        function (f) {
          return c(f, window, document);
        }
      )
    : "object" === typeof exports
    ? (module.exports = function (f, b) {
        f || (f = window);
        if (!b || !b.fn.dataTable) b = require("datatables.net")(f, b).$;
        b.fn.dataTable.Buttons || require("datatables.net-buttons")(f, b);
        return c(b, f, f.document);
      })
    : c(jQuery, window, document);
})(function (c, f, b, o) {
  var j = c.fn.dataTable,
    h = b.createElement("a"),
    n = function (a) {
      h.href = a;
      a = h.host;
      -1 === a.indexOf("/") && 0 !== h.pathname.indexOf("/") && (a += "/");
      return h.protocol + "//" + a + h.pathname + h.search;
    };
  j.ext.buttons.print = {
    className: "buttons-print",
    text: function (a) {
      return a.i18n("buttons.print", "Imprimir");
    },
    action: function (a, g, b, i) {
      var a = g.buttons.exportData(
          c.extend({ decodeEntities: !1 }, i.exportOptions)
        ),
        b = g.buttons.exportInfo(i),
        h = g
          .columns(i.exportOptions.columns)
          .flatten()
          .map(function (a) {
            return g.settings()[0].aoColumns[g.column(a).index()].sClass;
          })
          .toArray(),
        l = function (a, b) {
          for (var d = "<tr>", c = 0, e = a.length; c < e; c++)
            d +=
              "<" +
              b +
              " " +
              (h[c] ? 'class="' + h[c] + '"' : "") +
              ">" +
              (null === a[c] || a[c] === o ? "" : a[c]) +
              "</" +
              b +
              ">";
          return d + "</tr>";
        },
        d = '<table class="' + g.table().node().className + '">';
      i.header && (d += "<thead bgcolor= '#91ffb2'>" + l(a.header, "th") + "</thead>");
      for (var d = d + "<tbody>", m = 0, j = a.body.length; m < j; m++)
        d += l(a.body[m], "td");
      d += "</tbody>";
      i.footer && a.footer && (d += "<tfoot>" + l(a.footer, "th") + "</tfoot>");
      var d = d + "</table>",
        e = f.open("", "");
      if (e) {
        e.document.close();

        var titulo = $("#nombre_informe").text();
        var fecha_solicitud = $("#fecha_solicitud").text();
        var obra = $("#obra").text();
        var direccion = $("#direccion").text();
        var codigo_solicitud = $("#codigo_solicitud").text();
        var pedido = $("#pedido").text();
        var solicitante = $("#solicitante").text();

        var k = "<title>" + b.title + "</title>";
        c("style, link").each(function () {
          var a = k,
            b = c(this).clone()[0];
          "link" === b.nodeName.toLowerCase() && (b.href = n(b.href));
          k = a + b.outerHTML;
        });
        try {
          e.document.head.innerHTML = k;
        } catch (p) {
          c(e.document.head).html(k);
        }
        e.document.body.innerHTML =
        "<table><tr><td colspan='3' align='center'><h4>ss"+titulo+"</h4></td></tr><tr><td align='left' valign='top'><br><br><img src='images/logo_chuen_dark.png' height='70px' align='center'></td>" + 
        "<td align='center'  width='140px'></td>" +
          "<td  align='right'<h6>" +
          fecha_solicitud +
          "<h6>" +
          codigo_solicitud +
          "</h6>" +
          "<h6>" +
          obra +
          "</h6>" +
          "<h6>" +
          direccion +
          "</h6>" +
          "<h6>" +
          pedido +
          "</h6>" +
          "<h6>" +
          solicitante +
          "</h6>" +
          "</h6><div></td></tr></table>" +
          (b.messageTop || "") +
          "</div>" +
          d +
          "<div>" +
          (b.messageBottom || "") +
          "</div>";
        c(e.document.body).addClass("dt-print-view");
        c("img", e.document.body).each(function (a, b) {
          b.setAttribute("src", n(b.getAttribute("src")));
        });
        i.customize && i.customize(e, i, g);
        a = function () {
          i.autoPrint && (e.print(), e.close());
        };
        navigator.userAgent.match(/Trident\/\d.\d/)
          ? a()
          : e.setTimeout(a, 1e3);
      } else
        g.buttons.info(
          g.i18n("buttons.printErrorTitle", "Unable to open print view"),
          g.i18n(
            "buttons.printErrorMsg",
            "Please allow popups in your browser for this site to be able to view the print view."
          ),
          5e3
        );
    },
    title: "*",
    messageTop: "*",
    messageBottom: "*",
    exportOptions: {},
    header: !0,
    footer: !1,
    autoPrint: !0,
    customize: null,
  };
  return j.Buttons;
});
