$(document).ready(function () {
  $(".td_editable").dblclick(function () {
    //alert(this.rowIndex);

    var $td = $(this);
    var _t = $td.text().trim();
    var _w = $td.width();
    var _h = $td.height();
    $td.html("");
    let $input = $("<input type = 'text' value =''>");

    $input
      .appendTo($td)
      .width(_w)
      .height(_h)
      .val(_t)
      .focus()
      .blur(function () {
        let remark = $(this).val();
        let id = $td.parent("tr").attr("id");
        let column_name = $td.attr("column_name");

        console.log(remark);
        console.log(id);
        console.log(column_name);

        $td.empty();
        $td.append("<td>" + remark + "</td>");

        $.ajax({
          url: "php/controllers/compras/compras_controller.php",
          method: "POST",
          data: {
            mod: "updatePartida",
            id_desglose_cotizacion: id,
            column_name: column_name,
            value: remark,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
              });

              Toast.fire({
                icon: "info",
                title: data.message,
              });
            } else {
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
              });

              Toast.fire({
                icon: "info",
                title: data.message,
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {});

        /*  $.ajax({
                type:'POST',
                url:'ajax_set_remark',
                data: {id: id,remark:remark},
                dataType:'json',
                success:function(data){
                    if(data.errno == 0){
                        layer.msg(data.errdesc, {icon: 1});
                        $td.html(remark);
                        $("#update_time_"+id).html(data.date);
                    }else{
                        layer.msg(data.errdesc, {icon: 5});
                        $td.html(_t);
                        return false;
                    }
                }
            }); */
      });

    /* input.val(html);
        $(this).html(input); */
  });
  $(document).on("click", ".btn_borrar_partida_desglose", function () {
    var id_desglose_cotizacion = $(this).attr("id");

    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "php/controllers/compras/compras_controller.php",
          method: "POST",
          data: {
            mod: "deletePartida",
            id_desglose_cotizacion: id_desglose_cotizacion,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              Swal.fire({
                title: "Eliminado!",
                icon: "success",
                timer: 1500,
              }).then((result) => {
                location.reload();
              });
            } else {
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener("mouseenter", Swal.stopTimer);
                  toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
              });

              Toast.fire({
                icon: "info",
                title: data.message,
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {});
      } else if (result.isDenied) {
        Swal.close();
      }
    });
  });

  $(".chckPartidaCotizada").change(function () {
    loading();
    var id_partida = $(this).attr("data-id-partida");
    if (this.checked) {
      var cotizada = "1";
    } else {
      var cotizada = "0";
    }

    $.ajax({
      url: "php/controllers/compras/compras_controller.php",
      method: "POST",
      data: {
        mod: "updateStatusPartida",
        id_partida: id_partida,
        cotizada: cotizada,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        /* console.log(data); */

        if (data.response == true) {
        /*   $.NotificationApp.send(
            "Actualziado",
            "Se actualizó la partida correctamente",
            "top-right",
            "#dddddd",
            "success"
          ); */
          Swal.close();
        } else {
          Swal.fire({
            title: "Atención!",
            text: data.message,
            icon: "info",
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
    Swal.close();
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
