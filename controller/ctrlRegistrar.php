<?php
require_once '../model/crearUsuario.php';
require_once '../model/conexion_model.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    echo 'datos que se reciben' . $nombre . $correo . $password;
    //Realiza las operaciones necesarias con los datos, por ejemplo, insertar en la base de datos
    $user = new crearUsuario();

    // Validación de correo
    $numeroCorreo = $user->validarCorreo($correo);

    if ($numeroCorreo > 0) {
        $response = array(
            'success' => false,
            'message' => 'Error: El correo ya está registrado.'
        );
        // Envía la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $user->crearUsuario($correo, $password);
        //retona el ultimo id, e inserta el cliente
        $id_usuario = $user->buscarID($correo);
        $user->CrearCliente($id_usuario, $nombre);
        $response = array(
            'success' => true,
            'message' => 'Registro exitoso'
        );
        // Envía la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        // header("Location: Admin/ctrlAdmin.php");
    }
} else {
    $response = array(
        'success' => false
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
