<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';
require __DIR__ . '/PHPMailer/Exception.php';

// Configuración
$SMTP_HOST = 'mail.protrabajo.cl';
$SMTP_PORT = 465;
$SMTP_USER = 'formulario@protrabajo.cl';
$SMTP_PASS = 'for20mulario26';
$SMTP_SECURE = 'ssl';

$TO_EMAILS = [
    'codigoraul@gmail.com',
    'rguajardo@protrabajo.cl',
    'contacto@polerasfutbol.cl'
];

$FROM_EMAIL = 'formulario@protrabajo.cl';
$FROM_NAME = 'ProTrabajo';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

// Validaciones
if (empty($nombre) || empty($email) || empty($mensaje)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Campos requeridos faltantes']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

// Crear email con PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración SMTP
    $mail->isSMTP();
    $mail->Host = $SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = $SMTP_USER;
    $mail->Password = $SMTP_PASS;
    $mail->SMTPSecure = $SMTP_SECURE;
    $mail->Port = $SMTP_PORT;
    $mail->CharSet = 'UTF-8';

    // Remitente
    $mail->setFrom($FROM_EMAIL, $FROM_NAME);
    $mail->addReplyTo($email, $nombre);

    // Destinatarios
    foreach ($TO_EMAILS as $toEmail) {
        $mail->addAddress($toEmail);
    }

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = '📧 Nuevo Mensaje de Contacto - ProTrabajo';
    
    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 20px; }
            .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
            .header h1 { margin: 0; font-size: 24px; }
            .content { padding: 30px; }
            .field { margin-bottom: 20px; }
            .label { font-weight: 700; color: #667eea; margin-bottom: 5px; font-size: 14px; }
            .value { background: #f9fafb; padding: 12px; border-radius: 6px; border-left: 3px solid #667eea; font-size: 15px; }
            .footer { text-align: center; padding: 20px; color: #6b7280; font-size: 12px; border-top: 1px solid #e5e7eb; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📧 Nuevo Mensaje de Contacto</h1>
                <p style="margin: 5px 0 0; opacity: 0.9;">ProTrabajo.cl</p>
            </div>
            <div class="content">
                <p style="color: #374151; margin: 0 0 20px;">Hola,</p>
                <p style="color: #6b7280; margin: 0 0 30px;">Has recibido un nuevo mensaje desde el formulario de contacto de tu sitio web.</p>
                
                <div class="field">
                    <div class="label">👤 Nombre</div>
                    <div class="value">' . htmlspecialchars($nombre) . '</div>
                </div>
                
                <div class="field">
                    <div class="label">📧 Email</div>
                    <div class="value">' . htmlspecialchars($email) . '</div>
                </div>
                
                <div class="field">
                    <div class="label">📱 Teléfono</div>
                    <div class="value">' . htmlspecialchars($telefono ?: 'No proporcionado') . '</div>
                </div>
                
                <div class="field">
                    <div class="label">💬 Mensaje</div>
                    <div class="value">' . nl2br(htmlspecialchars($mensaje)) . '</div>
                </div>
                
                <div class="footer">
                    <p style="margin: 5px 0;">Este mensaje fue enviado desde ProTrabajo.cl</p>
                    <p style="margin: 5px 0;">© 2026 ProTrabajo - Todos los derechos reservados</p>
                </div>
            </div>
        </div>
    </body>
    </html>';

    $mail->AltBody = "Nuevo mensaje de contacto\n\nNombre: $nombre\nEmail: $email\nTeléfono: $telefono\n\nMensaje:\n$mensaje";

    $mail->send();
    
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente']);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al enviar: ' . $mail->ErrorInfo]);
}
