
$(document).ready(function () {
    $('#btnenviar').click(function () {
        var datos = $('#formcontac').serialize();

        var name = $('#name').val();
        var email = $('#email').val();
        var mensaje = $('#mensaje').val();

        // Validar que todos los campos estén llenos
        if (name.trim() === '' || email.trim() === '' || mensaje.trim() === '') {
            // Mostrar mensaje de error y salir de la función
            $('#mensajeError').html(
                "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" +
                "<strong>Por favor complete todos los campos.</strong>" +
                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
                "</div>"
            );
            return false; // Evitar que se procese el resto del código después de la validación
        }
        


        // Continuar con la llamada AJAX
        var datos = $('#formcontac').serialize();

        $.ajax({
            type: 'POST',
            url: '/erp_as/php/models/regist.php',
            data: datos,
            success: function (r) {
                if (r == 1) {
                    $('#formcontac')[0].reset();/* se limpia los campos del formulario cuando se registra */
                    $('#mensajeExito').html(
                        "<div class='alert alert-success alert-dismissible fade show' role='alert'>" +
                        "<strong>Registro exitoso</strong>" +
                        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
                        "</div>"

                    );
                     // Llamar a la función para enviar el correo electrónico
                     enviarCorreo(name, email, mensaje);

                } else {
                    $('#mensajeExito').html(
                        "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" +
                        "<strong>Fallo al servidor</strong>" +
                        "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
                        "</div>"
                    );
                }
            }
        });

        return false;
    });
});
// Función para enviar el correo electrónico

// Función para enviar el correo electrónico
function enviarCorreo(name, email, mensaje) {
    $.ajax({
        type: 'POST',
        url: '/erp_as/php/models/mail.php',
        data: { name: name, email: email, mensaje: mensaje },
        success: function (respuestaCorreo) {
            // Verificar la respuesta del envío del correo
            if (respuestaCorreo === "1") {
                console.log("Correo enviado exitosamente");
            } else {
                console.log("Fallo al enviar el correo");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}









/* function enviarCorreo(name, email, mensaje) {
    $.ajax({
        type: 'POST',
        url: '/erp_as/php/models/mail.php',
        data: { name: name, email: email, mensaje: mensaje },
        success: function (respuestaCorreo) {
             
            if (respuestaCorreo === "1") {
                 console.log("Correo enviado exitosamente"); 
            } else {
                 console.log("Fallo al enviar el correo"); 
            }
        }
    });
} */
