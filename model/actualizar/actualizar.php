<?php
class actualizar
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function actualizar_estado_pedido($id_estado, $id_pedido)
    {
        $query = "UPDATE pedido 
        SET id_estado_pedido = :id_estado where id_pedido=:id_pedido";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_estado', $id_estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if($id_estado==4){
            $this->validarEstadoPedido($id_pedido);}else{
            echo "Actualizado correctamente";
            }
        } else {
            echo "Error al actualizar";
        }
    }
    public function validarEstadoPedido($id_pedido)
    {
        //poner el pedido como falso
        $query2 = "UPDATE pedido_atendido set status=false where id_pedido=:id_pedido";
        $stmt2 = $this->db->prepare($query2);
        $stmt2->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        if ($stmt2->execute()) {
            echo "Actualizado  a falso correctamente";
        } else {
            echo "Error al actualizar";
        }
    }
}
