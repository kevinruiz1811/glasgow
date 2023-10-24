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
    $mail->Subject = "H&A Medición de Riesgo Psicosocial xd";
    $mail->Body = '<div style="text-align: justify">
            <p style="margin-bottom: 25px">Bogotá DC. xd.</p>
            <p style="margin-bottom: 25px">Respetado(a) Sr(a): ' . $name . '</p>
            <p style="margin-bottom: 25px">Reciba un cordial saludo.</p>
            <p style="margin-bottom: 25px">
              Nos permitimos informarle que la firma <b>H&A CONSULTING</b> ha sido
              contratado por su compañía para la realización de la
              medición de riesgo psicosocial.
            </p>
            <p style="margin-bottom: 25px">
              A continuación, encontrará el usuario y contraseña que le ha sido
              asignado con los cuales usted podrá acceder a la plataforma para
              diligenciar los xd cuestionarios,
              <b
                >recuerde que debe realizar todos los cuestionarios de forma continua
                y no demorarse más de 20 minutos contestando 1 cuestionario debido a que el
                sistema cuando detecta inactividad en la plataforma no guardará ' . $email . '
                datos</b
              >.
            </p>
            <p style="margin-bottom: 25px; border: 1px solid black; width: 400px">
              Usuario: <b>xd/b> ' . $phone . '
              <br />
              Contraseña: <b>xd</b>
            </p>
            <p style="margin-bottom: 25px">
              Antes de iniciar el proceso lo invitamos a ver el siguiente
              <a
                href="https://haconsultingeu.com/home/PGT/videoMRPS.php"
                >video.</a
              >
            </p>
            <p style="margin-bottom: 25px">
              Una vez haya terminado de ver el video puede ingresar dando click
              <a href="https://haconsultingeu.com/home/PGT/ingreso.php">aquí</a>,
              donde digitará su usuario y contraseña. ' . $message . '
            </p>
            <p style="margin-bottom: 25px">
              Para cualquier duda que tenga sobre el proceso puede comunicarse
              mediante el correo electrónico: soporterps@haconsultingeu.com.co.
            </p>
            <p>Atentamente,</p>
            <h5 style="color: #396dd1">H&A CONSULTING LTDA</h5>
            <h5 style="color: #ed6e40">Adivising & Doing</h5>
            <h3 style="color: red; text-align: center">
              ESTE ES UN CORREO AUTOMÁTICO, POR FAVOR, NO RESPONDA.
            </h3>
            </div>';

    $correoEnviado = $mail->send();

    // Envia una respuesta de vuelta a JavaScript
    $respuesta = ["mensaje" => "Datos recibidos correctamente"];
    echo json_encode($correoEnviado);
} else {
    // Maneja la falta de datos adecuadamente
    http_response_code(400);
    echo json_encode(["error" => "No se recibieron datos válidos"]);
}
