<?php
// Test simple para ver si PHP funciona
header("Content-Type: text/plain");

echo "TEST PHP - " . date("Y-m-d H:i:s") . "
";
echo "PHP Version: " . phpversion() . "
";
echo "POST data: " . json_encode($_POST) . "
";
echo "¿Función mail existe?: " . (function_exists("mail") ? "SÍ" : "NO") . "
";

// Test básico de correo
$test = mail("codigoraul@gmail.com", "Test desde protrabajo.cl", "Test enviado: " . date("H:i:s"), "From: contacto@protrabajo.cl");
echo "Test mail: " . ($test ? "EXITOSO" : "FALLÓ") . "
";
?>
