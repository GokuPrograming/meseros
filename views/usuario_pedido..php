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
    <title>Mi historial de Pedidos</title>
    <link rel="stylesheet" href="../assets/css/nvar.css">
    <link rel="stylesheet" href="../assets/css/usuario_pedido.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            mostrar_Nvar();
            mostrar_subNvar();
            mostrar_pedidos();

            const openEls = document.querySelectorAll("[data-open]");
            const closeEls = document.querySelectorAll("[data-close]");
            const isVisible = "is-visible";

            for (const el of openEls) {
                el.addEventListener("click", function() {
                    const modalId = this.dataset.open;
                    document.getElementById(modalId).classList.add(isVisible);
                });
            }

            for (const el of closeEls) {
                el.addEventListener("click", function() {
                    this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                });
            }

            document.addEventListener("click", e => {
                if (e.target == document.querySelector(".modal.is-visible")) {
                    document.querySelector(".modal.is-visible [data-close]").click();
                }
            });

            document.addEventListener("keyup", e => {
                // if we press the ESC
                if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                    document.querySelector(".modal.is-visible [data-close]").click();
                }
            });
        });

        function mostrar_Nvar() {
            $.ajax({
                url: '../controller/user/nvarController.php?opc=1',
                type: 'GET',
                success: function(response) {
                    $('#Nvar').html(response);
                },
                error: function() {
                    console.error("Error al cargar Nvar");
                }
            });
        }

        function mostrar_subNvar() {
            $.ajax({
                url: '../controller/user/subNvar_controller.php?opc=2',
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

        function mostrar_pedidos() {
            $.ajax({
                url: '../controller/user/ctrlUser.php?opc=9',
                type: 'GET',
                success: function(response) {
                    $('#pedidos').html(response);

                    const openEls = document.querySelectorAll("[data-open]");
                    const closeEls = document.querySelectorAll("[data-close]");
                    const isVisible = "is-visible";

                    for (const el of openEls) {
                        el.addEventListener("click", function() {
                            const modalId = this.dataset.open;
                            document.getElementById(modalId).classList.add(isVisible);
                        });
                    }

                    for (const el of closeEls) {
                        el.addEventListener("click", function() {
                            this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                        });
                    }

                    document.addEventListener("click", e => {
                        if (e.target == document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });

                    document.addEventListener("keyup", e => {
                        // if we press the ESC
                        if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });
                },
                error: function() {
                    console.error("Error al cargar los pedidos");
                }
            });
        }

        function mostrarPedidosEnEspera() {
            $.ajax({
                url: '../controller/user/ctrlUser.php?opc=10',
                type: 'GET',
                success: function(response) {
                    $('#pedidos').html(response);
                    $('#pedidos').html(response);

                    const openEls = document.querySelectorAll("[data-open]");
                    const closeEls = document.querySelectorAll("[data-close]");
                    const isVisible = "is-visible";

                    for (const el of openEls) {
                        el.addEventListener("click", function() {
                            const modalId = this.dataset.open;
                            document.getElementById(modalId).classList.add(isVisible);
                        });
                    }

                    for (const el of closeEls) {
                        el.addEventListener("click", function() {
                            this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                        });
                    }

                    document.addEventListener("click", e => {
                        if (e.target == document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });

                    document.addEventListener("keyup", e => {
                        // if we press the ESC
                        if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });
                },
                error: function() {
                    console.error("Error al cargar los pedidos");
                }
            });
        }

        function mostrarPedidosEnPreparacion() {
            $.ajax({
                url: '../controller/user/ctrlUser.php?opc=11',
                type: 'GET',
                success: function(response) {
                    $('#pedidos').html(response);
                    $('#pedidos').html(response);

                    const openEls = document.querySelectorAll("[data-open]");
                    const closeEls = document.querySelectorAll("[data-close]");
                    const isVisible = "is-visible";

                    for (const el of openEls) {
                        el.addEventListener("click", function() {
                            const modalId = this.dataset.open;
                            document.getElementById(modalId).classList.add(isVisible);
                        });
                    }

                    for (const el of closeEls) {
                        el.addEventListener("click", function() {
                            this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                        });
                    }

                    document.addEventListener("click", e => {
                        if (e.target == document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });

                    document.addEventListener("keyup", e => {
                        // if we press the ESC
                        if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });
                },
                error: function() {
                    console.error("Error al cargar los pedidos");
                }
            });
        }

        function mostrarPedidosEnCamino() {
            $.ajax({
                url: '../controller/user/ctrlUser.php?opc=12',
                type: 'GET',
                success: function(response) {
                    $('#pedidos').html(response);
                    $('#pedidos').html(response);

                    const openEls = document.querySelectorAll("[data-open]");
                    const closeEls = document.querySelectorAll("[data-close]");
                    const isVisible = "is-visible";

                    for (const el of openEls) {
                        el.addEventListener("click", function() {
                            const modalId = this.dataset.open;
                            document.getElementById(modalId).classList.add(isVisible);
                        });
                    }

                    for (const el of closeEls) {
                        el.addEventListener("click", function() {
                            this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                        });
                    }

                    document.addEventListener("click", e => {
                        if (e.target == document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });

                    document.addEventListener("keyup", e => {
                        // if we press the ESC
                        if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });
                },
                error: function() {
                    console.error("Error al cargar los pedidos");
                }
            });
        }

        function mostrarPedidosEntegados() {
            $.ajax({
                url: '../controller/user/ctrlUser.php?opc=13',
                type: 'GET',
                success: function(response) {
                    $('#pedidos').html(response);
                    $('#pedidos').html(response);

                    const openEls = document.querySelectorAll("[data-open]");
                    const closeEls = document.querySelectorAll("[data-close]");
                    const isVisible = "is-visible";

                    for (const el of openEls) {
                        el.addEventListener("click", function() {
                            const modalId = this.dataset.open;
                            document.getElementById(modalId).classList.add(isVisible);
                        });
                    }

                    for (const el of closeEls) {
                        el.addEventListener("click", function() {
                            this.parentElement.parentElement.parentElement.classList.remove(isVisible);
                        });
                    }

                    document.addEventListener("click", e => {
                        if (e.target == document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });

                    document.addEventListener("keyup", e => {
                        // if we press the ESC
                        if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
                            document.querySelector(".modal.is-visible [data-close]").click();
                        }
                    });
                },
                error: function() {
                    console.error("Error al cargar los pedidos");
                }
            });
        }
    </script>

</head>

<body>
  
    <div id="Nvar"></div>
    <br><br><br><br>
    <div id="subNvar"></div>
    <div id="pedidos"></div>
</body>

</html>