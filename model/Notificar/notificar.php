<?php

class Notificación
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function saberSiAlguienTomoElpedido($id_usuario,$id_pedido)
    {
 
        $query = "SELECT * from pedido_atendido
        join meseros.pedido p on pedido_atendido.id_pedido = p.id_pedido
        where pedido_atendido.status=1 and id_usuario=$id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = array(); // Inicializa un array para almacenar los cursos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }
        return $productos; // D
    }
}
