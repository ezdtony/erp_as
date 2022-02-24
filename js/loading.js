$(document).ready(function() {
    Swal.fire({
        title: 'Cargando...',
        html: '<img src="images/loading.gif" width="300" height="175">',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: false,
    })

    setTimeout(function() {
        Swal.close();
    }, 2000);
});