<?php


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

function validarTemas($temas) {
  if (count($temas) < 1 || count($temas) > 3) {
    return "Debes seleccionar entre 1 y 3 temas relacionados.";
  }
  return true;
}
?>
