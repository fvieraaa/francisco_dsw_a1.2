<?php
// Versión 3 - Validaciones mediante funciones

// No permitir acceso directo sin enviar el formulario
if ($_SERVER["REQUEST_METHOD"] != "POST") {
  die("Acceso no permitido");
}

//funciones de validacion

function validarCorreo($correo) {
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    return "El correo no tiene un formato válido.";
  }
  return true;
}

function validarModulo($modulo) {
  $modulos_validos = ["DPL", "SOJ", "DOR", "DEW", "IPW", "DSW", "Opcional"];
  if (!in_array($modulo, $modulos_validos)) {
    return "El módulo no es válido.";
  }
  return true;
}

function validarAsunto($asunto) {
  if (strlen($asunto) > 50) {
    return "El asunto no puede tener más de 50 caracteres.";
  }
  if (is_numeric($asunto)) {
    return "El asunto no puede ser solo un número.";
  }
  return true;
}

function validarDescripcion($descripcion) {
  if (strlen($descripcion) > 300) {
    return "La descripción no puede tener más de 300 caracteres.";
  }
  return true;
}

// recogemos los datos del fomulario
$correo = $_POST["correo"];
$modulo = $_POST["modulo"];
$asunto = $_POST["asunto"];
$descripcion = $_POST["descripcion"];

$errores = [];

// valido con funciones


$resultado = validarCorreo($correo);
if ($resultado !== true) $errores[] = $resultado;

$resultado = validarModulo($modulo);
if ($resultado !== true) $errores[] = $resultado;

$resultado = validarAsunto($asunto);
if ($resultado !== true) $errores[] = $resultado;

$resultado = validarDescripcion($descripcion);
if ($resultado !== true) $errores[] = $resultado;

//enseñar los errores

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


// guardo en dudas.csv

$ruta = "data/dudas.csv";

// crear carpeta si no existe
if (!file_exists("data")) {
  mkdir("data");
}

// crear archivo con cabecera si no existe
if (!file_exists($ruta)) {
  $cabecera = "\"correo\";\"módulo\";\"asunto\";\"descripción\"\n";
  file_put_contents($ruta, $cabecera);
}

// añadir los datos
$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\"\n";
file_put_contents($ruta, $linea, FILE_APPEND);

//confirmación
echo "<h2>Duda registrada correctamente</h2>";
echo "<p>Gracias por enviar tu duda, $correo.</p>";
echo "<a href='formulario.php'>Enviar otra duda</a>";
?>
