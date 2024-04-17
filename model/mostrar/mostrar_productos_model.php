<?php


class Producto
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function mostrarProductos()
    {
        //select nombre_producto,precio,foto,stock from producto where producto.status=1;
        $query = "SELECT id_producto,producto_nombre,id_categoria,imagen,descripcion from producto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // Devuelve el array de cursos
    }
    public function mostrarProductos_comida()
    {
        //select nombre_producto,precio,foto,stock from producto where producto.status=1;
        $query = "SELECT id_producto,producto_nombre,id_categoria,imagen,descripcion from producto where id_categoria=1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // Devuelve el array de cursos
    }


    public function mostrarProductos_bebidas()
    {
        //select nombre_producto,precio,foto,stock from producto where producto.status=1;
        $query = "SELECT id_producto,producto_nombre,id_categoria,imagen,descripcion from producto where id_categoria=3";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // Devuelve el array de cursos
    }
    public function mostrarProductos_desechables()
    {
        //select nombre_producto,precio,foto,stock from producto where producto.status=1;
        $query = "SELECT id_producto,producto_nombre,id_categoria,imagen,descripcion from producto where id_categoria=2";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // Devuelve el array de cursos
    }
    public function mostrarProductos_canasta($id_usuario)
    {

        $query = "SELECT c.id_producto,p.producto_nombre,sum(cantidad)as cantidad,imagen,p.descripcion from canasta c
        inner join producto p on c.id_producto = p.id_producto
        where c.id_usuario=$id_usuario
        group by c.id_producto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // Devuelve el array de cursos
    }
    public function mostrar_pedidos()
    {

        $query = "SELECT id_pedido
        from pedido where id_estado_pedido=1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // Devuelve el array de cursos
    }
    public function mostrar_datos_pedido($id_pedido)
    {
        try {
            $query = "SELECT p.id_pedido,
                             u.correo as usuario,
                             no_mesa,
                             ep.estado
                      FROM pedido p
                      JOIN usuario u ON p.id_usuario = u.id_usuario
                      JOIN canasta_pedido cp ON p.id_pedido = cp.id_pedido
                      JOIN producto p2 ON cp.id_producto = p2.id_producto
                      JOIN estado_pedido ep ON p.id_estado_pedido = ep.id_estado_pedido
                      WHERE p.id_estado_pedido = 1 AND p.id_pedido = :id_pedido group by p.id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_datos_pedido_XD($id_pedido)
    {
        try {
            $query = "SELECT p.id_pedido,
                        producto_nombre,
                        cantidad,
                        ep.estado
                        FROM pedido p
                        JOIN usuario u ON p.id_usuario = u.id_usuario
                        JOIN canasta_pedido cp ON p.id_pedido = cp.id_pedido
                        JOIN producto p2 ON cp.id_producto = p2.id_producto
                        JOIN estado_pedido ep ON p.id_estado_pedido = ep.id_estado_pedido
                        WHERE p.id_estado_pedido = 1 AND p.id_pedido = :id_pedido ";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_pedido_atendido($id_usuario)
    {
        try {
            $query = "SELECT producto_nombre,cantidad,no_mesa
            from pedido_atendido pa
            join canasta_pedido cp on pa.id_pedido = cp.id_pedido
            join pedido p on cp.id_pedido = p.id_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            join usuario u on p.id_usuario = u.id_usuario
            join cliente c on u.id_usuario = c.id_usuario
            join cliente c2 on pa.id_usuario_mesero = c2.id_usuario
            join estado_pedido ep on p.id_estado_pedido = ep.id_estado_pedido
            where id_usuario_mesero=:id_usuario and status=1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }
            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_pedido_atendido_usuario($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido,c.nombre as cliente,no_mesa,c2.nombre as mesero,estado
            from pedido_atendido pa
            join canasta_pedido cp on pa.id_pedido = cp.id_pedido
            join pedido p on cp.id_pedido = p.id_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            join usuario u on p.id_usuario = u.id_usuario
            join cliente c on u.id_usuario = c.id_usuario
            join cliente c2 on pa.id_usuario_mesero = c2.id_usuario
            join estado_pedido ep on p.id_estado_pedido = ep.id_estado_pedido
            where id_usuario_mesero=:id_usuario and status=1 group by p.id_pedido";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }
            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_estado_select()
    {
        $query = "SELECT id_estado_pedido,estado from estado_pedido  where estado_pedido.id_estado_pedido not in (1)";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos;
    }
    public function mostrar_id_pedido($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido
            from pedido_atendido pa
            join canasta_pedido cp on pa.id_pedido = cp.id_pedido
            join pedido p on cp.id_pedido = p.id_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            join usuario u on p.id_usuario = u.id_usuario
            join cliente c on u.id_usuario = c.id_usuario
            join cliente c2 on pa.id_usuario_mesero = c2.id_usuario
            join estado_pedido ep on p.id_estado_pedido = ep.id_estado_pedido
            where id_usuario_mesero=:id_usuario group by p.id_pedido";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }
            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }


    public function mostrar_Todos_Pedidos($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido, p.fecha,no_mesa,estado
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            where p.id_usuario = :id_usuario
            group by p.id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_Todos_Pedidos_modal($id_usuario, $id_pedido)
    {
        try {
            $query = "SELECT producto_nombre ,cantidad,p.id_pedido
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            where p.id_usuario =:id_usuario and p.id_pedido=:id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_En_espera($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido, p.fecha,no_mesa,estado
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            where p.id_usuario = :id_usuario and p.id_estado_pedido=1
            group by p.id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_En_espera_modal($id_usuario, $id_pedido)
    {
        try {
            $query = "SELECT producto_nombre ,cantidad,p.id_pedido
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            where p.id_usuario =:id_usuario and p.id_pedido=:id_pedido and p.id_estado_pedido=1";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }

    public function mostrar_En_Preparacion($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido, p.fecha,no_mesa,estado
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            where p.id_usuario = :id_usuario and p.id_estado_pedido=2
            group by p.id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_En_Preparacion_modal($id_usuario, $id_pedido)
    {
        try {
            $query = "SELECT producto_nombre ,cantidad,p.id_pedido
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            where p.id_usuario =:id_usuario and p.id_pedido=:id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_En_camino($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido, p.fecha,no_mesa,estado
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            where p.id_usuario = :id_usuario and p.id_estado_pedido=3
            group by p.id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_En_camino_modal($id_usuario, $id_pedido)
    {
        try {
            $query = "SELECT producto_nombre ,cantidad,p.id_pedido
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            where p.id_usuario =:id_usuario and p.id_pedido=:id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_Entregado($id_usuario)
    {
        try {
            $query = "SELECT p.id_pedido, p.fecha,no_mesa,estado
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            where p.id_usuario = :id_usuario and p.id_estado_pedido=4
            group by p.id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
    public function mostrar_Entregado_modal($id_usuario, $id_pedido)
    {
        try {
            $query = "SELECT producto_nombre ,cantidad,p.id_pedido
            from pedido p
                     join canasta_pedido cp on p.id_pedido = cp.id_pedido
                     join estado_pedido ep on ep.id_estado_pedido = p.id_estado_pedido
            join producto p2 on cp.id_producto = p2.id_producto
            where p.id_usuario =:id_usuario and p.id_pedido=:id_pedido";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

            $stmt->execute();

            $productos = array(); // Inicializa un array para almacenar los productos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = $row;
            }

            return $productos; // Devuelve el array de productos
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return null;
        }
    }
}
