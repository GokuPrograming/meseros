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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Pa' que somos buenos?</title>
    <link rel="stylesheet" href="../assets/css/formulario.css">
    <link rel="stylesheet" href="../assets/css/nvar.css">

</head>

<body>

    <div id="Nvar"></div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="titulo">
        <h1>MESETEC RESUELVE</h1>
    </div>
    <div class="contenido">
        <p>Cuentanos que sucede:</p>
    </div>
    <form id="form" class="contact-form">
        <div class="form-group">
            <label for="asunto">Asunto:</label>
            <select name="asunto" id="asunto" class="form-control">
                <option value="reporte">Reporte</option>
                <option value="asistencia_mesero">Asistencia de Mesero</option>
                <option value="comentario">Solicitud:</option>
                <option value="critica">Crítica</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comentario">Comentario:</label>
            <textarea name="comentario" id="comentario" cols="30" rows="5" class="form-control" placeholder="Si necesitas un mesero, dinos en donde lo necesitaras" required></textarea>
        </div>
        <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Enviar</button>
    </form>
    <!-- <div class="form-group" id="respuesta">aqui debe de responder </div> -->

    <script>
        $(document).ready(function () {
            mostrar_Nvar();
        })

        function enviarFormulario() {
            var datos = $("#form").serialize();
            $.ajax({
                data: datos,
                url: '../controller/user/ctrlUser.php?opc=15',
                type: 'post',
                beforeSend: function () {
                    Swal.fire({
                        title: 'Enviando petición',
                        text: 'Estamos enviando su petición, gracias...',
                        icon: 'info',
                        showConfirmButton: false,
                    });
                },
                success: function (response) {
                    $('#respuesta').html(response);
                    Swal.fire({
                        title: '¡Listo!',
                        text: 'En un momento atenderemos su petición',
                        icon: 'success',
                    }).then(function () {
                        setTimeout(function () {
                            window.location.href = "./menu.php";
                        }, 2000); // Redirige después de 2 segundos
                    });
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al procesar su petición',
                        icon: 'error',
                    });
                }
            });
        }

        function mostrar_Nvar() {
            $.ajax({
                url: '../controller/user/nvarController.php?opc=1',
                type: 'GET',
                success: function (response) {
                    $('#Nvar').html(response);
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al cargar la información',
                        icon: 'error',
                    });
                }
            });
        }
    </script>

</body>

</html>
