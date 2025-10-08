<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Enviar duda</title>
</head>
<body>
  <h1>Formulario de envío de dudas</h1>

  <form action="registra_dudas.php" method="post">
    <label>Correo electrónico:</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Módulo:</label><br>
    <select name="modulo" required>
      <option value="DPL">DPL</option>
      <option value="SOJ">SOJ</option>
      <option value="DOR">DOR</option>
      <option value="DEW">DEW</option>
      <option value="IPW">IPW</option>
      <option value="DSW">DSW</option>
      <option value="Opcional">Opcional</option>

    </select><br><br>

    <label>Asunto:</label><br>
    <input type="text" name="asunto" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" rows="5" cols="40" required></textarea><br><br>

    

    <label>Temas relacionados (elige entre 1 y 3):</label><br>
    <input type="checkbox" name="temas[]" value="Linux"> Linux<br>
    <input type="checkbox" name="temas[]" value="Windows"> Windows<br>
    <input type="checkbox" name="temas[]" value="PHP"> PHP<br>
    <input type="checkbox" name="temas[]" value="HTML"> HTML<br>
    <input type="checkbox" name="temas[]" value="Javascript"> Javascript<br>
    <input type="checkbox" name="temas[]" value="Bash"> Bash<br>
    <input type="checkbox" name="temas[]" value="Calificaciones"> Calificaciones<br>
    <input type="checkbox" name="temas[]" value="Actividades"> Actividades<br>
    <input type="checkbox" name="temas[]" value="Exámenes"> Exámenes<br>
    <input type="checkbox" name="temas[]" value="Otros"> Otros<br><br>
    <br>

    <input type="submit" value="Enviar duda">
  </form>

</body>
</html>
