$(document).on("click", ".deleteProveedor", function () {
  var id_proveedor = $(this).attr("data-id-proveedor");

  if (id_proveedor == "") {
    Swal.fire({
      icon: "info",
      title: "Atención",
      text: "Ocurrió un error al intentar eliminar el registro",
    });
  } else {
    loading();
    $.ajax({
      url: "php/controllers/compras/material_controller.php",
      method: "POST",
      data: {
        mod: "deleteProveedor",
        id_proveedor: id_proveedor,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: data.message,
            timer: 2000,
          }).then((result) => {
            $("#trProveedor" + id_proveedor).remove();
            //  location.reload();
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

$(".td_editableProveedor").dblclick(function () {
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
      let id = $td.attr("data-id-proveedor");
      let column_name = $td.attr("column_name");

      console.log(remark);
      console.log(id);
      console.log(column_name);

      $td.empty();
      $td.append(
        '<td data-id-proveedor="' +
          id +
          '" class="td_editableProveedor" column_name="' +
          column_name +
          '">' +
          remark +
          "</td>"
      );

      $.ajax({
        url: "php/controllers/compras/material_controller.php",
        method: "POST",
        data: {
          mod: "updateProveedor",
          id_proveedor: id,
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
$(document).on("click", ".deleteUMedida", function () {
  var id_umedida = $(this).attr("data-id-umedida");

  if (id_umedida == "") {
    Swal.fire({
      icon: "info",
      title: "Atención",
      text: "Ocurrió un error al intentar eliminar el registro",
    });
  } else {
    loading();
    $.ajax({
      url: "php/controllers/compras/material_controller.php",
      method: "POST",
      data: {
        mod: "deleteUmedida",
        id_umedida: id_umedida,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: data.message,
            timer: 2000,
          }).then((result) => {
            $("#trUmedida" + id_umedida).remove();
            //  location.reload();
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

$(".td_editableUmedida").dblclick(function () {
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
      let id = $td.attr("data-id-umedida");
      let column_name = $td.attr("column_name");

      console.log(remark);
      console.log(id);
      console.log(column_name);

      $td.empty();
      $td.append(
        '<td data-id-umedida="' +
          id +
          '" class="td_editableUmedida" column_name="' +
          column_name +
          '">' +
          remark +
          "</td>"
      );

      $.ajax({
        url: "php/controllers/compras/material_controller.php",
        method: "POST",
        data: {
          mod: "updateUmedida",
          id_umedida: id,
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

$(document).on("click", ".deleteClasifMAter", function () {
    var id_clasif = $(this).attr("data-id-clasif");
  
    if (id_clasif == "") {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ocurrió un error al intentar eliminar el registro",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/compras/material_controller.php",
        method: "POST",
        data: {
          mod: "deleteClasif",
          id_clasif: id_clasif,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);
          if (data.response == true) {
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: data.message,
              timer: 2000,
            }).then((result) => {
              $("#trClasifMAter" + id_clasif).remove();
              //  location.reload();
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
  
  $(".td_editableClasifMAter").dblclick(function () {
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
        let id = $td.attr("data-id-clasif");
        let column_name = $td.attr("column_name");
  
        console.log(remark);
        console.log(id);
        console.log(column_name);
  
        $td.empty();
        $td.append('<td data-id-clasif="'+id+'" class="td_editableClasifMAter" column_name="'+column_name+'">'+remark+'</td>');
        
  
        $.ajax({
          url: "php/controllers/compras/material_controller.php",
          method: "POST",
          data: {
            mod: "updateClasif",
            id_clasif: id,
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

function loading() {
  $(document).ready(function () {
    Swal.fire({
      title: "Cargando...",
      html: '<img src="images/loading.gif" width="300" height="175">',
      allowOutsideClick: false,
      allowEscapeKey: false,
      showCloseButton: false,
      showCancelButton: false,
      showConfirmButton: false,
    });
  });
}
