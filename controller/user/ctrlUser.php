<?php
require_once '../../model/conexion_model.php';
require_once '../../model/mostrar/mostrar_productos_model.php';
require_once '../../model/agregar/agregarPedido_model.php';
require_once '../../model/eliminar/eliminarCanasta_model.php';
$producto = new Producto();
$agregar_a_pedido = new AgregarPedido();
$elimar_de_canasta = new EliminarCanasta();

if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
    switch ($opc) {
            //mostrar los productos
        case '1': {
                if (isset($_SESSION["id_usuario"])) {
                    if ($_SESSION["id_rol"] == 3) {
                        $datosProducto = $producto->mostrarProductos();
                        if (!empty($datosProducto)) {
                            // <div>sesion de rol:' . $_SESSION["id_rol"] . ' </div>
                            echo '
                        <section id="our_menu" class="pt-5 pb-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="breakfast-tab">
                                                <div class="row">';
                            foreach ($datosProducto as $info) {
                                echo ' <div class="col-md-6 col-lg-4">
                                                        <div class="single_menu">
                                                            <img src="../assets/img/productos/' . $info['imagen'] . '" alt="fried rice" class="img-fluid">
                                                            <div class="menu_content">
                                                                <h4>' . $info['producto_nombre'] . '</h4>
                                                                <p>' . $info['descripcion'] . '</p>
                                                                <div class="menu_actions">
                                                                    <button class="btn btn-sm btn-outline-danger" value="AGREGAR" onclick="actualizarCarrito(' . $info['id_producto'] . ')">Add</button>
                                                                    <div class="counter">
                                                                        <div id="contador-' . $info['id_producto'] . '">0</div>
                                                                        <button onclick="aumentarContador(' . $info['id_producto'] . ')">+</button>
                                                                        <button onclick="disminuirContador(' . $info['id_producto'] . ')">-</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                            }
                            echo '
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <a href="#" class="menu_btn btn btn-danger">view more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>';
                        }
                    } else {
                        echo "el rol es " . $_SESSION["id_rol"];
                    }
                }
            }
            break;
        case '2': {
                if (isset($_SESSION["id_usuario"])) {
                    $datosProducto = $producto->mostrarProductos_comida();
                    if ($_SESSION["id_rol"] == 3) {
                        if (!empty($datosProducto)) {

                            // foreach ($datosProducto as $info) {
                            // echo 'datos:' . $info['producto_nombre'] . 'fin ';
                            echo '
                            <section id="our_menu" class="pt-5 pb-5 margins">
                                <div class="row">
                                    <div class="tab-content col-lg-12" id="myTabContent">
                                        <!-- Breakfast Tab Content -->';
                            foreach ($datosProducto as $info) {
                                echo '
                                        <div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="breakfast-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="single_menu">
                                                    <img src="../assets/img/productos/' . $info['imagen'] . '" alt="fried rice" class="img-fluid">
                                                    <div class="menu_content">
                                                        <h4>' . $info['producto_nombre'] . '</h4>
                                                        <p>' . $info['descripcion'] . '</p>
                                                        <div class="menu_actions">
                                                            <button class="btn btn-sm btn-outline-danger" value="AGREGAR" onclick="actualizarCarrito(' . $info['id_producto'] . ')">Add</button>
                                                            <div class="counter">
                                                                <div id="contador-' . $info['id_producto'] . '">0</div>
                                                                <button onclick="aumentarContador(' . $info['id_producto'] . ')">+</button>
                                                                <button onclick="disminuirContador(' . $info['id_producto'] . ')">-</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                            }
                            echo '
                                    </div>
                                </div>
                            </div>
                        </section>';
                        };
                    }
                }
            }
            break;
        case '3': {
                if (isset($_SESSION["id_usuario"])) {
                    $datosProducto = $producto->mostrarProductos_bebidas();
                    if (!empty($datosProducto)) {

                        // foreach ($datosProducto as $info) {
                        // echo 'datos:' . $info['producto_nombre'] . 'fin ';
                        echo '
                            <section id="our_menu" class="pt-5 pb-5 margins">
                                <div class="row">
                                    <div class="tab-content col-lg-12" id="myTabContent">
                                        <!-- Breakfast Tab Content -->';
                        foreach ($datosProducto as $info) {
                            echo '
                                        <div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="breakfast-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="single_menu">
                                                            <img src="../assets/img/productos/' . $info['imagen'] . '" alt="fried rice" class="img-fluid">
                                                        <div class="menu_content">
                                                            <h4>' . $info['producto_nombre'] . '</h4>
                                                            <p>' . $info['descripcion'] . '</p>
                                                            <div class="menu_actions">
                                                            <button class="btn btn-sm btn-outline-danger" value="AGREGAR" onclick="actualizarCarrito(' . $info['id_producto'] . ')">Add</button>
                                                            <div class="counter">
                                                                <div id="contador-' . $info['id_producto'] . '">0</div>
                                                                   <button onclick="aumentarContador(' . $info['id_producto'] . ')">+</button>
                                                                  <button onclick="disminuirContador(' . $info['id_producto'] . ')">-</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                        }
                        echo '
                                    </div>
                                </div>
                            </div>
                        </section>';
                    };
                }
            }
            break;
        case '4': {
                if (isset($_SESSION["id_usuario"])) {
                    $datosProducto = $producto->mostrarProductos_desechables();
                    if (!empty($datosProducto)) {
                        echo '
                        <section id="our_menu" class="pt-5 pb-5 margins">
                            <div class="row">
                                <div class="tab-content col-lg-12" id="myTabContent">';
                        foreach ($datosProducto as $info) {
                            echo '
                            <div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="breakfast-tab">
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <div class="single_menu">
                                        <img src="../assets/img/productos/' . $info['imagen'] . '" alt="fried rice" class="img-fluid">
                                        <div class="menu_content">
                                                <h4>' . $info['producto_nombre'] . '</h4>
                                                <p>' . $info['descripcion'] . '</p>
                                                <div class="menu_actions">
                                                    <button class="btn btn-sm btn-outline-danger" value="AGREGAR" onclick="actualizarCarrito(' . $info['id_producto'] . ')">Add</button>
                                                    <div class="counter">
                                                        <div id="contador-' . $info['id_producto'] . '">0</div>
                                                        <button onclick="aumentarContador(' . $info['id_producto'] . ')">+</button>
                                                        <button onclick="disminuirContador(' . $info['id_producto'] . ')">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                        echo '
                                </div>
                                <a href="#" class="menu_btn btn btn-danger">view more</a>
                            </div>
                        </div>
                    </section>';
                    };
                }
            }
            break;
        case '5': {
                $contador = $_GET['contador'];
                $id_p = $_GET['id_producto'];
                $contador = intval($contador);
                $id_p = intval($id_p);
                echo "El valor del contador es: " . $contador . "  producto=" . $id_p;
                $agregar_a_pedido->agregarCanasta($_SESSION["id_usuario"], $id_p, $contador);
            }
            break;
            case '6': {
                if (isset($_SESSION["id_usuario"])) {
                    $datosProducto = $producto->mostrarProductos_canasta($_SESSION["id_usuario"]);
                    if (!empty($datosProducto)) {
                        echo '
                        <table class="cart_table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                              
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                          ';
                        foreach ($datosProducto as $info) {
                            echo '
                            <tr class="single_menu">
                            <td>
                                <div class="product_info">
                                <img src="../assets/img/productos/' . $info['imagen'] . '" alt="fried rice" class="img-fluid">
                                <div class="menu_content-text">
                                        <h4>' . $info['producto_nombre'] . '</h4>
                                        <p>' . $info['descripcion'] . '</p>
                                        <p>cantidad: ' . $info['cantidad'] . '</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="menu_actions">
                                    <button class="btn btn-danger" onclick="quitarDeCanasta(' . $info['id_producto'] . ')">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                           ';
                        }
                        echo '
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td>
                                <input type="text" id="mesa" placeholder="mesa" required>
                                <button type="button" onclick="enviarFormulario()">Enviar</button>
                            </td>
                            </tr>
                        </tfoot>
                    </table>';
                    };
                }
            }
            
            break;
        case '7':
            $id_p = $_GET['id_producto'];
            $id_p = intval($id_p);
            echo "El valor del contador es: producto=" . $id_p;
            $elimar_de_canasta->eliminarDeCanasta($_SESSION["id_usuario"], $id_p);
            break;
        case '8':
            $mesa = $_GET['mesa'];
            $mesa = intval($mesa);
            echo "El valor del contador es: producto=" . $mesa;
            $agregar_a_pedido->agregarPedido($mesa, $_SESSION["id_usuario"]);
            break;
            ///notificacion
        case '9':
            $datosProducto = $producto->mostrar_Todos_Pedidos($_SESSION["id_usuario"]);
            foreach ($datosProducto as $info) {
                $id_pedido = $info['id_pedido'];
                echo '
                    <div class="u_container">
                        <div class="pedido-info">
                            <h2>Número de Pedido: ' . $info['id_pedido'] . '</h2>
                            <p>Fecha: ' . $info['fecha'] . '</p>
                            <p>No. mesa: ' . $info['no_mesa'] . '</p>
                            <p>Estado:' . $info['estado'] . '</p>
                        </div>
                        <button type="button" class="open-modal" data-open="modal' . $id_pedido . '">
                            Ver Detalles del Pedido
                        </button>
                    </div>';

                $datosProductoModal = $producto->mostrar_Todos_Pedidos_modal($_SESSION["id_usuario"], $id_pedido);

                echo '
                    <div class="modal" id="modal' . $id_pedido . '">
                        <div class="modal-dialog">
                            <header class="modal-header">
                                Detalles del Pedido #' . $id_pedido . '
                                <button class="close-modal" aria-label="close modal" data-close>
                                    ✕
                                </button>
                            </header>
                            <section class="modal-content">';

                foreach ($datosProductoModal as $infoModal) {
                    echo ' <p>Producto: ' . $infoModal['producto_nombre'] . '</p>
                                  <p>Cantidad: ' . $infoModal['cantidad'] . '</p>
                                  ';
                }

                echo '
                            </section>
                            <footer class="modal-footer">
                               GRACIAS POR SU PREFERENCIA
                            </footer>
                        </div>
                    </div>';
            }
            break;

        case '10':
            $datosProducto = $producto->mostrar_En_espera($_SESSION["id_usuario"]);
            foreach ($datosProducto as $info) {
                $id_pedido = $info['id_pedido'];
                echo '
                        <div class="u_container">
                            <div class="pedido-info">
                                <h2>Número de Pedido: ' . $info['id_pedido'] . '</h2>
                                <p>Fecha: ' . $info['fecha'] . '</p>
                                <p>No. mesa: ' . $info['no_mesa'] . '</p>
                                <p>Estado:' . $info['estado'] . '</p>
                            </div>
                            <button type="button" class="open-modal" data-open="modal' . $id_pedido . '">
                                Ver Detalles del Pedido
                            </button>
                        </div>';

                $datosProductoModal = $producto->mostrar_En_espera_modal($_SESSION["id_usuario"], $id_pedido);
                echo '
                        <div class="modal" id="modal' . $id_pedido . '">
                            <div class="modal-dialog">
                                <header class="modal-header">
                                    Detalles del Pedido #' . $id_pedido . '
                                    <button class="close-modal" aria-label="close modal" data-close>
                                        ✕
                                    </button>
                                </header>
                                <section class="modal-content">';

                foreach ($datosProductoModal as $infoModal) {
                    echo ' <p>Producto: ' . $infoModal['producto_nombre'] . '</p>
                                      <p>Cantidad: ' . $infoModal['cantidad'] . '</p>
                                      ';
                }
                echo '
                                </section>
                                <footer class="modal-footer">
                                   GRACIAS POR SU PREFERENCIA
                                </footer>
                            </div>
                        </div>';
            }

            break;

        case '11':
            $datosProducto = $producto->mostrar_En_Preparacion($_SESSION["id_usuario"]);
            foreach ($datosProducto as $info) {
                $id_pedido = $info['id_pedido'];
                echo '
                            <div class="u_container">
                                <div class="pedido-info">
                                    <h2>Número de Pedido: ' . $info['id_pedido'] . '</h2>
                                    <p>Fecha: ' . $info['fecha'] . '</p>
                                    <p>No. mesa: ' . $info['no_mesa'] . '</p>
                                    <p>Estado:' . $info['estado'] . '</p>
                                </div>
                                <button type="button" class="open-modal" data-open="modal' . $id_pedido . '">
                                    Ver Detalles del Pedido
                                </button>
                            </div>';

                $datosProductoModal = $producto->mostrar_En_Preparacion_modal($_SESSION["id_usuario"], $id_pedido);
                echo '
                            <div class="modal" id="modal' . $id_pedido . '">
                                <div class="modal-dialog">
                                    <header class="modal-header">
                                        Detalles del Pedido #' . $id_pedido . '
                                        <button class="close-modal" aria-label="close modal" data-close>
                                            ✕
                                        </button>
                                    </header>
                                    <section class="modal-content">';

                foreach ($datosProductoModal as $infoModal) {
                    echo ' <p>Producto: ' . $infoModal['producto_nombre'] . '</p>
                                          <p>Cantidad: ' . $infoModal['cantidad'] . '</p>
                                          ';
                }
                echo '
                                    </section>
                                    <footer class="modal-footer">
                                       GRACIAS POR SU PREFERENCIA
                                    </footer>
                                </div>
                            </div>';
            }
            break;

        case '12':
            $datosProducto = $producto->mostrar_En_camino($_SESSION["id_usuario"]);
            foreach ($datosProducto as $info) {
                $id_pedido = $info['id_pedido'];
                echo '
                                <div class="u_container">
                                    <div class="pedido-info">
                                        <h2>Número de Pedido: ' . $info['id_pedido'] . '</h2>
                                        <p>Fecha: ' . $info['fecha'] . '</p>
                                        <p>No. mesa: ' . $info['no_mesa'] . '</p>
                                        <p>Estado:' . $info['estado'] . '</p>
                                    </div>
                                    <button type="button" class="open-modal" data-open="modal' . $id_pedido . '">
                                        Ver Detalles del Pedido
                                    </button>
                                </div>';

                $datosProductoModal = $producto->mostrar_En_camino_modal($_SESSION["id_usuario"], $id_pedido);
                echo '
                                <div class="modal" id="modal' . $id_pedido . '">
                                    <div class="modal-dialog">
                                        <header class="modal-header">
                                            Detalles del Pedido #' . $id_pedido . '
                                            <button class="close-modal" aria-label="close modal" data-close>
                                                ✕
                                            </button>
                                        </header>
                                        <section class="modal-content">';

                foreach ($datosProductoModal as $infoModal) {
                    echo ' <p>Producto: ' . $infoModal['producto_nombre'] . '</p>
                                              <p>Cantidad: ' . $infoModal['cantidad'] . '</p>
                                              ';
                }
                echo '
                                        </section>
                                        <footer class="modal-footer">
                                           GRACIAS POR SU PREFERENCIA
                                        </footer>
                                    </div>
                                </div>';
            }
            break;

        case '13':
            $datosProducto = $producto->mostrar_Entregado($_SESSION["id_usuario"]);
            foreach ($datosProducto as $info) {
                $id_pedido = $info['id_pedido'];
                echo '
                                    <div class="u_container">
                                        <div class="pedido-info">
                                            <h2>Número de Pedido: ' . $info['id_pedido'] . '</h2>
                                            <p>Fecha: ' . $info['fecha'] . '</p>
                                            <p>No. mesa: ' . $info['no_mesa'] . '</p>
                                            <p>Estado:' . $info['estado'] . '</p>
                                        </div>
                                        <button type="button" class="open-modal" data-open="modal' . $id_pedido . '">
                                            Ver Detalles del Pedido
                                        </button>
                                    </div>';

                $datosProductoModal = $producto->mostrar_Entregado_modal($_SESSION["id_usuario"], $id_pedido);
                echo '
                                    <div class="modal" id="modal' . $id_pedido . '">
                                        <div class="modal-dialog">
                                            <header class="modal-header">
                                                Detalles del Pedido #' . $id_pedido . '
                                                <button class="close-modal" aria-label="close modal" data-close>
                                                    ✕
                                                </button>
                                            </header>
                                            <section class="modal-content">';

                foreach ($datosProductoModal as $infoModal) {
                    echo ' <p>Producto: ' . $infoModal['producto_nombre'] . '</p>
                                                  <p>Cantidad: ' . $infoModal['cantidad'] . '</p>
                                                  ';
                }
                echo '
                                            </section>
                                            <footer class="modal-footer">
                                               GRACIAS POR SU PREFERENCIA
                                            </footer>
                                        </div>
                                    </div>';
            }
            break;
    }
} else {
    echo 'no llego ningun opc';
}
