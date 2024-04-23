jQuery(document).on('submit', '#forming', function (event) {
    event.preventDefault();

    var correo = jQuery(this).find("input[name='correo']").val();
    var password = jQuery(this).find("input[name='password']").val();

    if (!correo || !password) {
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
        url: '../controller/login_controller.php',
        type: 'POST',
        dataType: 'json',
        data: jQuery(this).serialize(),
        beforeSend: function () {
            // Puedes realizar acciones antes de enviar la solicitud aquí
            jQuery('.botonlg').val('validando...'); // Debes usar jQuery en lugar de $
        }
    })
    .done(function (respuesta) {
        console.log(respuesta);
        // Evaluar la respuesta
        if (!respuesta.error) {
            location.href = '../views/menu.php';
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Credenciales no válidas',
                showConfirmButton: false,
                timer: 2000
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
        console.log("complete");
    });
});
