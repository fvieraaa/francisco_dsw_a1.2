<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
  die("Acceso no permitido");
}

// Recoger los datos del formulario
$correo = $_POST["correo"];
$modulo = $_POST["modulo"];
$asunto = $_POST["asunto"];
$descripcion = $_POST["descripcion"];

$errores = [];

// Validar correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
  $errores[] = "El correo no tiene un formato válido.";
}

// Validar módulo (solo los que hay en el formulario)
$modulos_validos = ["DPL", "SOJ", "DOR", "DEW", "IPW", "DSW", "Opcional"];
if (!in_array($modulo, $modulos_validos)) {
  $errores[] = "El módulo no es válido.";
}

// Validar asunto
if (strlen($asunto) > 50) {
  $errores[] = "El asunto no puede tener más de 50 caracteres.";
}
if (is_numeric($asunto)) {
  $errores[] = "El asunto no puede ser solo un número.";
}

// Validar descripción
if (strlen($descripcion) > 300) {
  $errores[] = "La descripción no puede tener más de 300 caracteres.";
}

// Si hay errores, los mostramos y paramos
if (count($errores) > 0) {
  echo "<h2>Se han encontrado errores:</h2>";
  echo "<ul>";
  foreach ($errores as $error) {
    echo "<li>$error</li>";
  }
  echo "</ul>";
  echo "<a href='formulario.php'>Volver al formulario</a>";
  exit();
}

// Si no hay errores, guardamos los datos
$ruta = "data/dudas.csv";

// Crear la carpeta si no existe
if (!file_exists("data")) {
  mkdir("data");
}

// Si el archivo no existe, añadir la cabecera
if (!file_exists($ruta)) {
  $cabecera = "\"correo\";\"módulo\";\"asunto\";\"descripción\"\n";
  file_put_contents($ruta, $cabecera);
}

// Escribir la línea
$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\"\n";
file_put_contents($ruta, $linea, FILE_APPEND);

// Mostrar mensaje de confirmación
echo "<h2>Duda registrada correctamente</h2>";
echo "<p>Gracias por enviar tu duda, $correo.</p>";
echo "<a href='formulario.php'>Enviar otra duda</a>";
?>
