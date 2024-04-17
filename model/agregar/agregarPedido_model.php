<?php
class AgregarPedido
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function agregarCanasta($id_usuario, $id_producto, $cantidad)
    {
        $query = "INSERT INTO canasta(id_usuario, id_producto, cantidad) VALUES (:id_usuario, :id_producto, :cantidad)";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $rs->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $rs->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);

        if ($rs->execute()) {
            // La compra se ha registrado correctamente en la base de datos
            echo "¡Se agregó a su carrito :D siga comprando!";
            // $this->actualizarStock($producto_id, $cantidad); // Llamamos a la función para actualizar el stock
        } else {
            // Hubo un error al registrar la compra
            echo "Error al registrar la compra.";
        }
    }
    public function agregarPedido($no_mesa, $id_usuario)
    {
        try {
            // Comenzar la transacción
            $this->db->beginTransaction();

            // Obtener los productos del carrito del usuario
            $query = "SELECT c.id_producto, p.producto_nombre, SUM(cantidad) as cantidad, p.descripcion 
                      FROM canasta c
                      INNER JOIN producto p ON c.id_producto = p.id_producto
                      WHERE c.id_usuario = :id_usuario
                      GROUP BY c.id_producto";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $productos = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            // Insertar un nuevo registro en la tabla pedido
            $queryPedido = "INSERT INTO pedido(id_usuario, no_mesa, id_estado_pedido, fecha) VALUES (:id_usuario, :no_mesa, 1, NOW())";
            $stmtPedido = $this->db->prepare($queryPedido);
            $stmtPedido->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmtPedido->bindParam(':no_mesa', $no_mesa, PDO::PARAM_INT);
            $stmtPedido->execute();
            $id_pedido = $this->db->lastInsertId();  // Obtener el ID del pedido recién insertado

            // Insertar los productos del carrito en la tabla canasta_pedido
            foreach ($productos as $producto) {
                $queryCanasta = "INSERT INTO canasta_pedido(id_producto, id_usuario, id_pedido, cantidad) 
                                 VALUES (:id_producto, :id_usuario, :id_pedido, :cantidad)";
                $stmtCanasta = $this->db->prepare($queryCanasta);
                $stmtCanasta->bindParam(':id_producto', $producto['id_producto'], PDO::PARAM_INT);
                $stmtCanasta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmtCanasta->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmtCanasta->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_INT);
                $stmtCanasta->execute();
            }

            // Eliminar los productos de la canasta
            $queryEliminar = "DELETE FROM canasta WHERE id_usuario = :id_usuario";
            $stmtEliminar = $this->db->prepare($queryEliminar);
            $stmtEliminar->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmtEliminar->execute();

            // Confirmar la transacción
            $this->db->commit();

            return $productos;
        } catch (PDOException $e) {
            // Si ocurre un error, deshacer la transacción
            $this->db->rollBack();
            echo "Error al agregar el pedido: " . $e->getMessage();
            return null;
        }
    }




    public function agregarPedidoAMesero($id_usuario, $id_pedido)
    {
        try {

            $query = "select * from pedido_atendido where id_usuario_mesero=:id_usuario and pedido_atendido.status= 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            // Obtener el resultado de la consulta
            $productos = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($productos) { // Verifica si se obtuvo algún producto
                echo 'Tienes una orden activa';
            } else {
                // Comenzar la transacción
                $this->db->beginTransaction();

                // Insertar en la tabla pedido_atendido
                $query1 = "INSERT INTO pedido_atendido(id_pedido, id_usuario_mesero) VALUES (:id_pedido, :id_usuario)";
                $stmt1 = $this->db->prepare($query1);
                $stmt1->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt1->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmt1->execute();

                // Actualizar el estado del pedido
                $query2 = "UPDATE pedido SET id_estado_pedido = 2 WHERE id_pedido = :id_pedido";
                $stmt2 = $this->db->prepare($query2);
                $stmt2->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmt2->execute();
              
                // Confirmar la transacción
                $this->db->commit();
                echo "¡Se agregó a su carrito :D siga comprando!";
            }
        } catch (PDOException $e) {
            // Si ocurre un error, deshacer la transacción
            $this->db->rollBack();
            echo "Error al registrar la compra: " . $e->getMessage();
        }
    }
}
