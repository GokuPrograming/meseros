<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/pedidoTomado.css">
    <link rel="stylesheet" href="../assets/css/nvar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="Nvar"></div>
    <div id="datos_pedido_tomado"></div>
    <div id="data"></div>
</body>

</html>

<script>
    $(document).ready(function() {
        //    barra();
        // mostrar_subNvar();
        mostrar_Nvar();
        mostrarPedidoTomado();
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

    function mostrarPedidoTomado() {
        $.ajax({
            url: '../controller/mesero/ctrlMesero.php?opc=3',
            type: 'GET',
            success: function(response) {
                $('#datos_pedido_tomado').html(response);
            },
            error: function() {
                console.log("algo salio mal al moemnto de trer el pedido ")
            }
        });
    }

    function actualizarEstado(id_pedido) {
        let estadoSeleccionado = document.getElementById("estadoPedido").value;
        console.log(estadoSeleccionado, id_pedido);
        $.ajax({
            url: '../controller/mesero/ctrlMesero.php',
            type: 'GET',
            data: {
                opc: 4,
                id_estado: estadoSeleccionado,
                id_pedido: id_pedido
            },
            success: function(response) {
                $('#data').html(response);
                mostrarPedidoTomado();
            },
            error: function() {
                console.log("algo salio mal al moemnto de trer el pedido ")
            }
        });
    }
</script>