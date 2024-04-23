 <?php
    // Start output buffering
    ob_start();
    // Start the session
    session_start();
    class Conexion
    {
        private $DBServer ='localhost'; // Cambia esto al nombre o dirección IP de tu servidor de base de datos
        private $DBUser = 'usuario'; // Cambia esto a tu nombre de usuario de la base de datos
        private $DBPass = '123'; // Cambia esto a tu contraseña de la base de datos
        private $DBName = 'meseros'; // Cambia esto a tu nombre de base de datos

        public function __construct()
        {
        }

        public function conectar()
        {
            try {
                $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
    }
    // Flush the output buffer
    ob_end_flush();




    // session_start();

    // class Conexion {
    //     private $DBServer;
    //     private $DBUser;
    //     private $DBPass;
    //     private $DBName;

    //     public function __construct() {
    //         // Obtener las variables de entorno
    //         $this->DBServer = getenv('DB_HOST');
    //         $this->DBUser = getenv('DB_USER');
    //         $this->DBPass = getenv('DB_PASS');
    //         $this->DBName = getenv('DB_NAME');
    //     }

    //     public function conectar() {
    //         try {
    //             $conn = new PDO("mysql:host={$this->DBServer};dbname={$this->DBName}", $this->DBUser, $this->DBPass);
    //             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             return $conn;
    //         } catch (PDOException $e) {
    //             die("Error de conexión: " . $e->getMessage());
    //         }
    //     }
    // }
    // 
    ?>

