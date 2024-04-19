<?php

class crearUsuario
{
    private $db;

    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }
    public function crearUsuario($correo, $password)
    {
        $password_md5 = md5($password);
        $id_rol = 3;
        $query = "INSERT INTO usuario (correo, password, id_rol) VALUES (:correo, :password, :id_rol)";
        $rs = $this->db->prepare($query);
        $rs->bindParam(":correo", $correo);
        $rs->bindParam(":password", $password_md5);
        $rs->bindParam(":id_rol", $id_rol);
        // $rs->bindParam(":nombre", $nombre);
        $rs->execute();
    }
    //insert into cliente(nombre, id_usuario) value ()
    public function CrearCliente($id_usuario, $nombre)
    {
        $query = "INSERT INTO cliente(nombre, id_usuario) VALUES (:nombre,:id_usuario)";
        $rs = $this->db->prepare($query);
        $rs->bindParam(":id_usuario", $id_usuario);
        $rs->bindParam(":nombre", $nombre);
        $rs->execute();
    }

    public function trerCorreo($correo)
    {
        $query = $this->db->prepare("SELECT id_usuario FROM usuario WHERE correo = :correo");
        $query->bindParam(":correo", $correo);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['id_usuario'];
    }
    public function buscarID($correo)
    {
        //         select id_usuario
        // from usuario where correo='verafrancomiguel1d@gmail.com';
        $query = $this->db->prepare("SELECT id_usuario FROM usuario WHERE correo = :correo");
        $query->bindParam(":correo", $correo);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['id_usuario'];
    }


    public function validarCorreo($correo)
    {
        $query = "SELECT count(correo)  from usuario WHERE correo= :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        $existeCompra = $stmt->fetchColumn();
        return $existeCompra;
    }
}
