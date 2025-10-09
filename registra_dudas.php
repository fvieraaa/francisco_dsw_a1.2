<?php
// Desactivar avisos o warnings en pantalla
error_reporting(0);

// evita acceso directo sin POST o GET
if ($_SERVER["REQUEST_METHOD"] !== "POST" && $_SERVER["REQUEST_METHOD"] !== "GET") {
  exit("Acceso no permitido");
}

// incluir las funciones de validación
require_once "includes/validaciones.php";

// Recogemos los datos (protegiendo contra XSS)
$correo = htmlspecialchars($_POST["correo"] ?? $_GET["correo"] ?? "");
$modulo = htmlspecialchars($_POST["modulo"] ?? $_GET["modulo"] ?? "");
$asunto = htmlspecialchars($_POST["asunto"] ?? $_GET["asunto"] ?? "");
$descripcion = htmlspecialchars($_POST["descripcion"] ?? $_GET["descripcion"] ?? "");
$temas = isset($_POST["temas"]) ? $_POST["temas"] : ($_GET["temas"] ?? []);

// Validaciones
$errores = [];

$resultado = validarCorreo($correo); if ($resultado !== true) $errores[] = $resultado;
$resultado = validarModulo($modulo); if ($resultado !== true) $errores[] = $resultado;
$resultado = validarAsunto($asunto); if ($resultado !== true) $errores[] = $resultado;
$resultado = validarDescripcion($descripcion); if ($resultado !== true) $errores[] = $resultado;
$resultado = validarTemas($temas); if ($resultado !== true) $errores[] = $resultado;

// Mostrar errores si los hay
if (count($errores) > 0) {
  echo "<h2>Se han encontrado errores:</h2><ul>";
  foreach ($errores as $error) echo "<li>$error</li>";
  echo "</ul><a href='formulario.php'>Volver al formulario</a>";
  exit();
}

// Guardar en CSV
$ruta = "data/dudas.csv";
if (!file_exists("data")) mkdir("data");
if (!file_exists($ruta)) {
  $cabecera = "\"correo\";\"módulo\";\"asunto\";\"descripción\";\"temas\"\n";
  file_put_contents($ruta, $cabecera);
}

$temas_str = implode(",", $temas);
$linea = "\"$correo\";\"$modulo\";\"$asunto\";\"$descripcion\";\"$temas_str\"\n";
file_put_contents($ruta, $linea, FILE_APPEND);

// Confirmación
echo "<h2>Duda registrada correctamente</h2>";
echo "<p>Gracias por enviar tu duda, $correo.</p>";
echo "<a href='formulario.php'>Enviar otra duda</a>";
?>
