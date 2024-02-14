$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // mensajes de error o eventos adicionales
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // evitar el comportamiento de envío predeterminado
            // obtener valores de FORM
            var name = $("input#name").val();
            var email = $("input#email").val();
            var message = $("textarea#message").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "././mail/contact_me.php",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    message: message
                },
                cache: false,
                success: function() {
                    // Mensaje de correo enviado
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Tu mensaje ha sido enviado </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    //limpia todos los campos
                    $('#contactForm').trigger("reset");
                },
                error: function() {
                    // Mensaje fallido
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + firstName + ", parece que mi servidor de correo no responde. ¡Por favor, inténtalo de nuevo más tarde!");
                    $('#success > .alert-danger').append('</div>');
                    //Limpia todos los campos
                    $('#contactForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*Al hacer clic en Ocultar cuadros de error / éxito de ocultación completa * /
$('#name').focus(function() {
    $('#success').html('');
});+*/