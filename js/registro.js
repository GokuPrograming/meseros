jQuery(document).on('submit', '#registro', function (event) {
    event.preventDefault();

    var nombre = jQuery(this).find("input[name='nombre']").val();
    var correo = jQuery(this).find("input[name='correo']").val();
    var password = jQuery(this).find("input[name='password']").val();

    if (!nombre || !correo || !password) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, completa todos los campos.',
            showConfirmButton: false,
            timer: 2000
        });
        return;
    }

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
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: respuesta.message,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                // Actualiza el contenido del div con el mensaje de respuesta
                jQuery('#error').html(respuesta.message);
                jQuery('#error').slideDown('slow');

                $('#successModal').find('.modal-body').html(respuesta.message);
                
                // Redirige a la página de login
                window.location.href = '../views/login3.php';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: respuesta.message,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                // Actualiza el contenido del div con el mensaje de respuesta
                jQuery('#error').html(respuesta.message);
                jQuery('#error').slideDown('slow');
            });
        }
    })
    .fail(function (resp) {
        console.log(resp.responseText);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ha ocurrido un error, por favor intenta de nuevo.',
            showConfirmButton: false,
            timer: 2000
        });
    })
    .always(function () {
        console.log('Complete');
    });
});
