<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$asunto = $_POST['asunto'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

if (empty($nombre) || empty($email) || empty($mensaje)) {
    echo json_encode(['success' => false, 'message' => 'Campos requeridos faltantes']);
    exit;
}

$to = 'codigoraul@gmail.com, ro.guajardo.vega@gmail.com, contacto@polerasfutbol.cl';
$subject = 'Contacto ProTrabajo - ' . $asunto;
$headers = "From: formulario@protrabajo.cl\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$body = "
<html>
<body style='font-family: Arial, sans-serif;'>
    <h2 style='color: #667eea;'>Nuevo Mensaje de Contacto</h2>
    <p><strong>Nombre:</strong> $nombre</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Teléfono:</strong> $telefono</p>
    <p><strong>Asunto:</strong> $asunto</p>
    <p><strong>Mensaje:</strong><br>$mensaje</p>
</body>
</html>";

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al enviar']);
}
