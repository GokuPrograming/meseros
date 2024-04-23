<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    //header('location: view/main.php');
    // You may want to remove this echo statement unless it's for debugging purposes
    // echo "sesion" . $_SESSION['id_usuario'];
} else {
    //echo "Sesión no iniciada";
    header('location: login3.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/canasta.css">
    <link rel="stylesheet" href="../assets/css/nvar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div id="mostrar"></div>
    <br><br><br><br><br><br><br><br><br><br>
    <div class="page_title">
        <h1>Canasta</h1>
    </div>
    <div class="table-responsive">
        <div id="Nvar"></div>
        <div id="productos"></div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        //    barra();
        // mostrar_subNvar();
        mostrarProductos();
        mostrar_Nvar();
        // carritoContador();
    });

    function mostrar_Nvar() {
        $.ajax({
            url: '../controller/user/nvarController.php?opc=1',
            type: 'GET',
            success: function(response) {
                $('#Nvar').html(response);
            },
            error: function() {
                // Maneja errores si la solicitud AJAX falla
                //  redirigirAVentana("login.html");
            }
        });
        // carritoContador();
    }

    function mostrarProductos() {
        $.ajax({
            url: '../controller/user/ctrlUser.php?opc=6',
            type: 'GET',
            success: function(response) {
                $('#productos').html(response);
            },
            error: function() {
                // Maneja errores si la solicitud AJAX falla
                //  redirigirAVentana("login.html");
            }
        });
        // carritoContador();
    }
    // function quitarDeCanasta() {
    //     $.ajax({
    //         url: '../controller/user/ctrlUser.php?opc=6',
    //         type: 'GET',
    //         success: function(response) {
    //             $('#productos').html(response);
    //         },
    //         error: function() {
    //             // Maneja errores si la solicitud AJAX falla
    //             //  redirigirAVentana("login.html");
    //         }
    //     });
    //     // carritoContador();
    // }

    function quitarDeCanasta(id_producto) {
        $.ajax({
            url: `../controller/user/ctrlUser.php?opc=7&id_producto=${id_producto}`,
            type: 'GET',
            success: function(response) {
                $('#mostrar').html(response);
                // contador = 0;
                // document.getElementById("contador-" + id_producto).innerText = 0;
                mostrarProductos();
                mostrarNotificacion('¡se eliminó de la canasta con éxito!', 'success');

            },
            error: function() {
                // Maneja errores si la solicitud AJAX falla
                $('#mostrar').html('Error al cargar la barra de navegación');
            }
        });
    }

    function mostrarNotificacion(mensaje, tipo) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000, // Duración de la notificación en milisegundos
        };

        if (tipo === 'success') {
            toastr.success(mensaje);
        } else if (tipo === 'error') {
            toastr.error(mensaje);
        } else if (tipo === 'warning') {
            toastr.warning(mensaje);
        } else if (tipo === 'info') {
            toastr.info(mensaje);
        }
    }

    function enviarFormulario() {
        var mesa = document.getElementById('mesa').value;

        if (mesa === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, llenar el campo "mesa"',
            });
            return;
        }

        $.ajax({
            url: '../controller/user/ctrlUser.php',
            type: 'GET',
            data: {
                opc: 8,
                mesa: mesa
            },
            success: function(response) {
                $('#mostrar').html(response);
                // Manejar la respuesta del servidor si es necesario
                // Por ejemplo, mostrar una notificación de éxito
                mostrarProductos();
                Swal.fire({
                    icon: 'success',
                    title: 'Enviado',
                    text: 'El número de mesa se ha enviado correctamente',
                });
            },
            error: function() {
                // Manejar errores si la solicitud AJAX falla
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al enviar el número de mesa',
                });
            }
        });
    }
</script>