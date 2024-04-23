<?php
require_once '../../model/conexion_model.php';

if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];

    if ($_SESSION["id_rol"] == 3) {
        switch ($opc) {
                //mostrar sub nvar
            case '1': {
                    echo '
                <section id="our_menu" class="pt-5 pb-5 margins">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="page_title mb-4">
                                            <h1>Nuestro Menu</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <ul class="nav nav-tabs menu_tab mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link" id="breakfast-tab" data-toggle="tab" href="#" role="tab" onclick="mostrarProductos_comida()">Platillos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="lunch-tab" data-toggle="tab" href="#" onclick="mostrarProductos_bebida()" role="tab">Bebidas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="dinner-tab" data-toggle="tab" href="#"  onclick="mostrarProductos_desechable()" role="tab">Desechables</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" id="dinner-tab" data-toggle="tab" href="#"  onclick="asistencia()" role="tab">Llamar Mesero</a>
                                    </li>
                                    </ul>
                                </div>';
                }
                break;
            case '2': {
                    echo '
                <section id="our_menu" class="pt-5 pb-5 margins">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="page_title mb-4">
                                            <h1>Nuestro Menu</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <ul class="nav nav-tabs menu_tab mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                        <a class="nav-link" id="breakfast-tab" data-toggle="tab" href="#" role="tab" onclick="mostrarPedidosEnEspera()">En Espera</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="lunch-tab" data-toggle="tab" href="#" onclick="mostrarPedidosEnPreparacion()" role="tab">En Preparacion</a>
                                        </li>
                 
       
                                    </ul>
                                    <ul class="nav nav-tabs menu_tab mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                    <a class="nav-link" id="dinner-tab" data-toggle="tab" href="#"  onclick="mostrarPedidosEnCamino()" role="tab">En camino</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" id="dinner-tab" data-toggle="tab" href="#"  onclick="mostrarPedidosEntegados()" role="tab">Entragados</a>
                            </li>
                                </ul>
                                </div>';
                }
                break;
        }
    }
}
