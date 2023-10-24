<?php
// Obtiene los datos enviados desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    require "../library/PHPMailer/src/PHPMailer.php";
    require "../library/PHPMailer/src/SMTP.php";
    require "../library/PHPMailer/src/Exception.php";

    // Procesa los datos
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $message = $data['message'];

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->CharSet = 'UTF-8';
    $fromEmail = "info@glasgowcompany.com";
    $password = "f=JLkL!A8+7~";
    $fromName = "CONTACT GLASGOW";
    $host = "mail.glasgowcompany.com";
    $port = "25";
    $SMTPAuth = "login";
    $SMTPSecure = "tls";
    $mail->isSMTP();

    $mail->SMTPDebug = 0;
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = $SMTPAuth;
    $mail->SMTPSecure = $SMTPSecure;
    $mail->Username = $fromEmail;
    $mail->Password = $password;

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->addAddress($email);

    $mail->IsHTML(true);
    $mail->Subject = "New website contact us message";
    $mail->Body = '';

    $emailSend = $mail->send();

    if ($emailSend) {
        // Envia una respuesta de vuelta a JavaScript
        $respuesta = ["message" => "Datos recibidos correctamente"];
        echo json_encode($respuesta);
    } else {
        // Maneja la falta de datos adecuadamente
        http_response_code(500);
        echo json_encode(["error" => "Error al enviar el correo electrónico"]);
    }
} else {
    // Maneja la falta de datos adecuadamente
    http_response_code(400);
    echo json_encode(["error" => "No se recibieron datos válidos"]);
}
