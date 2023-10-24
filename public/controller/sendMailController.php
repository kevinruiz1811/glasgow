<?php
// Obtiene los datos enviados desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // // Procesa los datos
    // $nombre = $data['nombre'];
    // $correo = $data['correo'];

    // Realiza alguna operación con los datos, por ejemplo, guardar en una base de datos o generar una respuesta
    // Aquí puedes realizar las operaciones necesarias con los datos
    // ...

    // Envia una respuesta de vuelta a JavaScript
    $respuesta = ["mensaje" => "Datos recibidos correctamente"];
    echo json_encode($respuesta);
} else {
    // Maneja la falta de datos adecuadamente
    http_response_code(400);
    echo json_encode(["error" => "No se recibieron datos válidos"]);
}
