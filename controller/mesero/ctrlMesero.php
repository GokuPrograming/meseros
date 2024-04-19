<?php
require_once '../../model/conexion_model.php';
require_once '../../model/mostrar/mostrar_productos_model.php';
require_once '../../model/agregar/agregarPedido_model.php';
require_once '../../model/eliminar/eliminarCanasta_model.php';
require_once '../../model/actualizar/actualizar.php';
// require_once '../../model/enviarCorreo.php';
$producto = new Producto();
$agregar_a_pedido = new AgregarPedido();
$elimar_de_canasta = new EliminarCanasta();
$actualizar = new actualizar();


if (isset($_GET['opc'])) {
    $opc = $_GET['opc'];
    switch ($opc) {
            //mostrar los productos
        case '1': {
                if (isset($_SESSION["id_usuario"])) {
                    if ($_SESSION["id_rol"] == 2) {
                        $datosProducto = $producto->mostrar_pedidos();
                        foreach ($datosProducto as $info) {
                            echo '

    <div class="product-list-container">
        <div class="order-info">
            <h2 class="order-number">Número de Pedido:' . $info['id_pedido'] . '</h2>
            ';
                            $informacion = $producto->mostrar_datos_pedido($info['id_pedido']);
                            foreach ($informacion as $infoPedido) {
                                echo '
            <h3 class="user-name">Usuario: ' . $infoPedido['usuario'] . '</h3>
            <span class="table-number">Mesa:  ' . $infoPedido['no_mesa'] . '</span>
            <div class="button-container">
            <button class="accept-button" onclick="tomarOrden(' . $info['id_pedido'] . ')">Aceptar</button>
        </div>
        </div>
        <div class="product-list">
            <ul class="product-items">
            ';
                                $informacion_pedido = $producto->mostrar_datos_pedido_XD($info['id_pedido']);
                                foreach ($informacion_pedido as $infoPedido_datps) {
                                    echo '
                <li class="product-item">
                    <div class="product-details">
                        <h4 class="product-name">' . $infoPedido_datps['producto_nombre'] . '</h4>
                        <span class="product-quantity">Cantidad: ' . $infoPedido_datps['cantidad'] . '</span>
                    </div>
                </li>';
                                }
                                echo '
            </ul>
        </div>
    </div>

                        
                        ';
                            }
                        }
                    };
                };
            }

            break;
        case '2': {
                $id_p = $_GET['id_pedido'];
                $id_p = intval($id_p);
                echo "El valor de pedido feu tomado=" . $id_p;
                // mostrar_datos_pedido
                $informacion = $producto->mostrar_datos_pedido($id_p);
                foreach ($informacion as $infoPedido) {
                    $_SESSION['correo'] =  $infoPedido['usuario'];
                }


                $agregar_a_pedido->agregarPedidoAMesero($_SESSION["id_usuario"], $id_p);
               
                //$agregar_a_pedido->agregarPedido($_SESSION["id_usuario"], $id_p, $contador);
            }
            break;
        case '3': {
                $id_pedido = 0;
                if (isset($_SESSION["id_usuario"])) {
                    if ($_SESSION["id_rol"] == 2) {
                        $datosProducto_atendido = $producto->mostrar_pedido_atendido($_SESSION["id_usuario"]);
                        $datosProducto_atendido_usuario = $producto->mostrar_pedido_atendido_usuario($_SESSION["id_usuario"]);
                        echo '<div class="ticket">
                                <div class="ticket-header">
                                    <h2>Orden</h2>
                                </div>';

                        foreach ($datosProducto_atendido as $infoPedidoTomado) {
                            echo '<div class="ticket-body">
                                    <div class="order-item">
                                        <span>' . $infoPedidoTomado['producto_nombre'] . '</span>
                                        <span>' . $infoPedidoTomado['cantidad'] . '</span>
                                    </div>
                                  </div>';
                        }

                        $pedido = $producto->mostrar_id_pedido($_SESSION["id_usuario"]);

                        echo '<div class="ticket-footer">';



                        foreach ($pedido as $id_pedido) {
                            $id_pedido = $id_pedido['id_pedido'];
                            $_SESSION['id_pedido'] = $id_pedido;
                            echo '<div class="order-details">';

                            foreach ($datosProducto_atendido_usuario as $infoPedidoTomado) {
                                if ($infoPedidoTomado['id_pedido'] == $id_pedido) {

                                    echo '<select id="estadoPedido" onchange="actualizarEstado(' . $id_pedido . ')">';

                                    $opciones = $producto->mostrar_estado_select();
                                    foreach ($opciones as $infoPedidoTomado_select) {
                                        echo '<option value="' . $infoPedidoTomado_select['id_estado_pedido'] . '">' . $infoPedidoTomado_select['estado'] . '</option>';
                                    }

                                    echo '</select>';
                                    echo '<div class="order-info">';
                                    echo 'Cliente: <span>' . $infoPedidoTomado['cliente'] . '</span><br>';
                                    echo 'Atendido por: <span>' . $infoPedidoTomado['mesero'] . '</span><br>';
                                    echo 'Estado: <span>' . $infoPedidoTomado['estado'] . '</span><br>';
                                    echo 'Pedido: <span>' . $infoPedidoTomado['id_pedido'] . '</span><br>';
                                    echo 'Mesa: <span>' . $infoPedidoTomado['no_mesa'] . '</span>';
                                    echo '</div>';
                                }
                            }

                            echo '</div>';
                        }

                        echo '</div></div>';
                    }
                }
            }
            break;
        case 4:
            $id_pedido = $_GET['id_pedido'];
            $id_estado = $_GET['id_estado'];
            // $id_p = intval($id_p);
            echo "El valor del pedido es=" . $id_pedido . "que esta en estado:" . $id_estado;
            $actualizar->actualizar_estado_pedido($id_estado, $id_pedido);
    }
}
