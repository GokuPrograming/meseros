

<?php
session_start();

class Conexion {
    private $DBServer = 'meseros.cpsio64641e7.us-east-2.rds.amazonaws.com'; // Cambia esto al nombre o dirección IP de tu servidor de base de datos
    private $DBUser = 'admin'; // Cambia esto a tu nombre de usuario de la base de datos
    private $DBPass = 'Miguel123'; // Cambia esto a tu contraseña de la base de datos
    private $DBName = 'meseros'; // Cambia esto a tu nombre de base de datos

    public function __construct() {}

    public function conectar() {
        try {
            $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}




