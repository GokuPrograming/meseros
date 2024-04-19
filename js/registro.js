jQuery(document).on('submit', '#registro', function (event) {
    event.preventDefault();

    jQuery.ajax({
        url: '../controller/ctrlRegistrar.php',
        type: 'POST',
        dataType: 'json',
        data: jQuery(this).serialize(),
        beforeSend: function () {
            // Aquí puedes agregar algún mensaje de "cargando" si lo necesitas
        }
    })
        .done(function (respuesta) {
            if (respuesta.success) {
                alert("Éxito");
                // Actualiza el contenido del div con el mensaje de respuesta
                jQuery('#error').html(respuesta.message);
                jQuery('#error').slideDown('slow');

                $('#successModal').find('.modal-body').html(respuesta.message);
                $('#successModal').modal('show');

                // setTimeout(function () {
                //     // Realiza otra acción aquí, por ejemplo, redirige a otra página
                //     window.location.href = '../views/login3.html';
                // }, 3000);
            } else {
                alert('Correo duplicado');
                jQuery('#error').html(respuesta.message);
                jQuery('#error').slideDown('slow');
                setTimeout(function () {
                    jQuery('#error').slideUp('slow');
                }, 1000);

                console.log('Error: ' + respuesta.message);
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log('Complete');
        });
});
