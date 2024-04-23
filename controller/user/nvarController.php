<?php
require_once '../../model/conexion_model.php';

if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
    if ($_SESSION["id_rol"] == 3) {
        switch ($opc) {
                //mostrar sub nvar
            case '1': {
                    echo '
                    <nav class="navbar">
                    <div class="navcontainer">
                        <a class="navbar-brand" href="#">Restaurant</a>
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="./menu.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./AboutUs.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./canasta.php">Canasta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="usuario_pedido..php">Historial de Pedidos</a>
                            </li>
                            <li>
                            <a class="nav-link" href="../Controller/user/ctrlUser.php?opc=14">
                            CERRAR SESION
                            </li>
                        </ul>
                    </div>
                </nav>';
                }
        }
    }
    if ($_SESSION["id_rol"] == 2) {
        switch ($opc) {
                //mostrar sub nvar
            case '1': {
                    echo '
                    <nav class="navbar">
                    <div class="navcontainer">
                        <a class="navbar-brand" href="#">Restaurant</a>
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="./menu.php">Lista de pedidos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./preparar_pedido.php">Mis Encargos</a>
                            </li>
                            <li class="nav-item">
                            <li>
                            <a class="nav-link" href="../Controller/user/ctrlUser.php?opc=14">
                            CERRAR SESION
                            </li>
                           
                        </ul>
                    </div>
                </nav>
                <br><br>
                <br><br>
                <br><br>
                <br><br>
                <br><br>
                <br><br>
                
                ';
                }
        }
    }
}
