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
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/pedidos.css">
    <link rel="stylesheet" href="../assets/css/nvar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link rel="stylesheet" href="nvar.css"> -->
</head>
<body>
    <a href="./canasta.php">canasta</a>
    <div id="Nvar"></div>
    <br><br><br><br><br><br><br><br><br><br>
    <div id="subNvar"></div>
    <div id="productos"></div>
    <div id="meseros"></div>
    <div id="mostrar"></div>
</body>
</html>
<script>
    // Variable para almacenar el contador
    let contador = 0;

    function aumentarContador(idProducto) {
        var contador = document.getElementById('contador-' + idProducto);
        var valorActual = parseInt(contador.textContent);
        contador.textContent = valorActual + 1;
        actualizarURLCarrito(idProducto, valorActual + 1);
    }

    function disminuirContador(idProducto) {
        var contador = document.getElementById('contador-' + idProducto);
        var valorActual = parseInt(contador.textContent);
        if (valorActual > 0) {
            contador.textContent = valorActual - 1;
            actualizarURLCarrito(idProducto, valorActual - 1);
        }
    }

    function actualizarURLCarrito(idProducto, cantidad) {
        var link = document.getElementById('add-to-cart-link-' + idProducto);
        //  link.href = `../controller/user/ctrlUser.php?opc=2&id=${idProducto}&cantidad=${cantidad}`;
        contador = cantidad;
        console.log("contador= " + contador);

    }

    function actualizarCarrito(id_producto, cantidad) {
        cantidad = contador;
        console.log("cantidad".cantidad);
        $.ajax({
            url: `../controller/user/ctrlUser.php?opc=5&id_producto=${id_producto}&contador=${contador}`,
            type: 'GET',
            success: function(response) {
                $('#mostrar').html(response);
                contador = 0;
                document.getElementById("contador-" + id_producto).innerText = 0;

                mostrarNotificacion('¡se agrego a carrito con éxito!', 'success');
            },
            error: function() {
                // Maneja errores si la solicitud AJAX falla
                $('#mostrar').html('Error al cargar la barra de navegación');
            }
        });
        //  mostrarProductos();
        // carritoContador();


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
    // function carritoContador() {
    //     $.ajax({
    //         url: '../controller/user/ctrlUser.php?opc=8',
    //         type: 'GET',
    //         success: function(response) {
    //             $('#contador-value').html(response);
    //         },
    //         error: function() {
    //             // Maneja errores si la solicitud AJAX falla
    //             $('#contador').html('Error al cargar la barra de navegación');
    //         }
    //     });
    // }
</script>
<script>
    $(document).ready(function() {
        //    barra();
        mostrar_Nvar();
        mostrar_subNvar();
        mostrarProductos();
        mostrarParaMeseros();
        // carritoContador();
    });

    function mostrarProductos() {
        $.ajax({
            url: '../controller/user/ctrlUser.php?opc=1',
            type: 'GET',
            success: function(response) {
                $('#productos').html(response);
            },
            error: function() {
               
            }
        });
    }

    function mostrarParaMeseros() {
        $.ajax({
            url: '../controller/mesero/ctrlMesero.php?opc=1',
            type: 'GET',
            success: function(response) {
                $('#meseros').html(response);
            },
            error: function() {
                // Maneja errores si la solicitud AJAX falla
                //  redirigirAVentana("login.html");
            }
        });
        // carritoContador();
    }

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

    function mostrar_subNvar() {
        $.ajax({
            url: '../controller/user/subNvar_controller.php?opc=1',
            type: 'GET',
            success: function(response) {
                $('#subNvar').html(response);
            },
            error: function() {
                // Maneja errores si la solicitud AJAX falla
                //  redirigirAVentana("login.html");
            }
        });
        // carritoContador();
    }

    function mostrarProductos_comida() {
        $.ajax({
            url: '../controller/user/ctrlUser.php?opc=2',
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

    function mostrarProductos_bebida() {
        $.ajax({
            url: '../controller/user/ctrlUser.php?opc=3',
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

    function mostrarProductos_desechable() {
        $.ajax({
            url: '../controller/user/ctrlUser.php?opc=4',
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


    function tomarOrden(id_pedido) {
        // Mostrar SweetAlert de cargando
        Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: `../controller/mesero/ctrlMesero.php?opc=2&id_pedido=${id_pedido}`,
            type: 'GET',
            success: function(response) {
                // Cerrar SweetAlert de cargando
                Swal.close();

                $('#mostrar').html(response);
                mostrarNotificacion('¡Gracias por tomar el pedido!', 'success');
                mostrarParaMeseros();

                // Espera 2 segundos antes de redireccionar
                setTimeout(function() {
                    window.location.href = "./preparar_pedido.php";
                }, 2000); // 2000 milisegundos = 2 segundos
            },
            error: function() {
                // Cerrar SweetAlert de cargando
                Swal.close();

                // Maneja errores si la solicitud AJAX falla
                $('#mostrar').html('Error al cargar la barra de navegación');
            }
        });
    }
</script>