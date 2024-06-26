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
    <link rel="stylesheet" href="../assets/css/AboutUs.css">
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Responsive Team Section Using HTML5 , CSS3 , Bootstrap 4</title>
        <link rel="stylesheet" href="../assets/css/nvar.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:500,700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>


    </head>

    <body>
        <div id="Nvar"></div>
        <section class="section-team">
            <div class="container">
                <!-- Start Header Section -->
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header-section">
                            <h3 class="small-title">Our Experts</h3>
                            <h2 class="title">Let's meet with our team members</h2>
                        </div>
                    </div>
                </div>
                <!-- / End Header Section -->
                <div class="row">
                    <!-- Start Single Person -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="single-person">
                            <div class="person-image">
                                <img src="../assets/img/integrantes/1.jpg" alt="">
                                <span class="icon lord-icon-container">
                                    <lord-icon
                                    src="https://cdn.lordicon.com/fmjvulyw.json"
                                    trigger="loop"
                                    delay="2000"
                                    style="width:100%;height:100%">
                                </lord-icon>
                                </span>
                            </div>
                            <div class="person-info">
                                <h3 class="full-name">Jesus Arturo Guevara Hernández </h3>
                                <span class="speciality">Rapido y Servidor</span>
                            </div>
                        </div>
                    </div>
                    <!-- / End Single Person -->
                    <!-- Start Single Person -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="single-person">
                            <div class="person-image">
                                <img src="../assets/img/integrantes/2.jpg" alt="">
                                <span class="icon lord-icon-container">
                                    <lord-icon
                                    src="https://cdn.lordicon.com/bmlkvhui.json"
                                    trigger="loop"
                                    delay="2000"
                                    style="width:100%;height:100%">
                                </lord-icon>
                                </span>
                            </div>
                            <div class="person-info">
                                <h3 class="full-name">John Doe</h3>
                                <span class="speciality">Web Developer</span>
                            </div>
                        </div>
                    </div>
                    <!-- / End Single Person -->
                    <!-- Start Single Person -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="single-person">
                            <div class="person-image">
                                <img src="../assets/img/integrantes/3.jpg" alt="">
                                <span class="icon lord-icon-container">
                                    <lord-icon
                                    src="https://cdn.lordicon.com/jtiihjyw.json"
                                    trigger="loop"
                                    delay="2000"
                                    style="width:100%;height:100%">
                                </lord-icon>
                                </span>
                            </div>
                            <div class="person-info">
                                <h3 class="full-name">Samantha Vázquez Morales </h3>
                                <span class="speciality">La Señora del mantel</span>
                            </div>
                        </div>
                    </div>
                    <!-- / End Single Person -->
                    <!-- Start Single Person -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="single-person">
                            <div class="person-image">
                                <img src="../assets/img/integrantes/4.jpg" alt="">
                                <span class="icon lord-icon-container">
                                    <lord-icon
                                    src="https://cdn.lordicon.com/mebvgwrs.json"
                                    trigger="loop"
                                    delay="2000"
                                    style="width:100%;height:100%">
                                </lord-icon>
                                </span>
                            </div>
                            <div class="person-info">
                                <h3 class="full-name">John Doe</h3>
                                <span class="speciality">Angular Developer</span>
                            </div>
                        </div>
                    </div>
                    <!-- / End Single Person -->
                    <!-- Start Single Person -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="single-person">
                            <div class="person-image">
                                <img src="../assets/img/integrantes/5.jpg" alt="">
                                <span class="icon lord-icon-container">
                                    <lord-icon
                                    src="https://cdn.lordicon.com/wsdieofl.json"
                                    trigger="loop"
                                    delay="2000"
                                    style="width:100%;height:100%">
                                </lord-icon>
                                </span>
                            </div>
                            <div class="person-info">
                                <h3 class="full-name">Miriam Gpe. Corrales Galvan </h3>
                                <span class="speciality">La protectora del Mechudo</span>
                            </div>
                        </div>
                    </div>
                    <!-- / End Single Person -->
                </div>
            </div>
        </section>

    </body>

    </html>
</body>

</html>
<script>
    $(document).ready(function () {
        mostrar_Nvar();

    });
    function mostrar_Nvar() {
        $.ajax({
            url: '../controller/user/nvarController.php?opc=1',
            type: 'GET',
            success: function (response) {
                $('#Nvar').html(response);
            },
            error: function () {
                // Maneja errores si la solicitud AJAX falla
                //  redirigirAVentana("login.html");
            }
        });
        // carritoContador();
    }
</script>