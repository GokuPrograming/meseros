<?php
class EliminarCanasta
{
    private $db;
    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function eliminarDeCanasta($id_usuario, $id_producto)
    {
        $query = "DELETE FROM canasta WHERE id_producto = :id_producto AND id_usuario = :id_usuario";
        $rs = $this->db->prepare($query);
        $rs->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $rs->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    
        if ($rs->execute()) {
            // La eliminación se ha realizado correctamente en la base de datos
            echo "¡Se eliminó el elemento!";
            // $this->actualizarStock($producto_id, $cantidad); // Llamamos a la función para actualizar el stock
        } else {
            // Hubo un error al eliminar el elemento
            echo "Error al eliminar el elemento.";
        }
    }
    
}
