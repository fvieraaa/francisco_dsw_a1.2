<?php
// registra_dudas.php
// Versión 1: almacenamiento básico

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  exit("Acceso no permitido");
}

$correo = $_POST["correo"] ?? '';
$modulo = $_POST["modulo"] ?? '';
$asunto = $_POST["asunto"] ?? '';
$descripcion = $_POST["descripcion"] ?? '';

$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\"\n";

$ruta = __DIR__ . "/data/dudas.csv";

// Si el archivo no existe, creamos cabecera
if (!file_exists($ruta)) {
  $cabecera = "\"correo\";\"módulo\";\"asunto\";\"descripción\"\n";
  file_put_contents($ruta, $cabecera, FILE_APPEND);
}

// Añadimos la línea
file_put_contents($ruta, $linea, FILE_APPEND);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Confirmación</title>
</head>
<body>
  <h2>Duda registrada correctamente</h2>
  <p>Gracias por enviar tu duda, <?php echo htmlspecialchars($correo); ?>.</p>
  <a href="formulario.php">Enviar otra duda</a>
</body>
</html>
