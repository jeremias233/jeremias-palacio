<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Conexion fallida: " . $conn->connect_error);
}

// Agregar el estilo de fondo a la página
echo "<style>
body {
    background-image: url('FONDOu.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
</style>";

if(isset($_POST['submit'])){
  $NombreAlum = $_POST['NombreAlum'];
  $ApellidoAlum = $_POST['ApellidoAlum'];
  $CursoAlum = $_POST['CursoAlum'];
  $NombreLib = $_POST['NombreLib'];
  $Cantidad = $_POST['Cantidad'];
  $fecha = $_POST['fecha'];
  $hora = $_POST['hora'];

  $sql = "INSERT INTO students (NombreAlum, ApellidoAlum, CursoAlum, NombreLib, Cantidad, fecha, hora)
  VALUES ('$NombreAlum', '$ApellidoAlum', '$CursoAlum', '$NombreLib', '$Cantidad', '$fecha', '$hora')";

  if ($conn->query($sql) === TRUE) {
      echo "Se guardo exitosamente";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Borrar registro
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM students WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro borrado exitosamente";
    } else {
        echo "Error al borrar el registro: " . $conn->error;
    }
}

// Botón de alerta con imagen
// Obtener el número de alertas
$fechaLimite = date('Y-m-d', strtotime('-3 days'));
$sqlAlertas = "SELECT COUNT(*) as total FROM students WHERE fecha <= '$fechaLimite'";
$resultAlertas = $conn->query($sqlAlertas);
$rowAlertas = $resultAlertas->fetch_assoc();
$numAlertas = $rowAlertas['total'];

echo "<div style='position: fixed; top: 20px; right: 20px;'>";
echo "<a href='alertas.php' style='text-decoration: none;'>";
echo "<button style='
    background-color: #3498db;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 30px;
    cursor: pointer;
    display: flex;
    align-items: center;
    font-family: Arial, sans-serif;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
'>";
echo "<img src='alerta.jpg' alt='Alerta' style='width: 24px; height: 24px; margin-right: 12px;'>";
echo "Ver Alertas <span style='
    background-color: #e74c3c;
    color: white;
    border-radius: 50%;
    padding: 2px 8px;
    margin-left: 8px;
    font-size: 14px;
'>$numAlertas</span>";
echo "</button>";
echo "</a>";
echo "</div>";

// Agregar formulario de búsqueda
echo "<div style='text-align: center; margin: 20px 0;'>";
echo "<form method='GET' action=''>";
echo "<input type='text' name='search' placeholder='Buscar por nombre, apellido o libro' style='padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc;'>";
echo "<input type='submit' value='Buscar' style='padding: 10px 20px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;'>";
echo "</form>";
echo "</div>";

// Mostrar lista de registros guardados con nuevo estilo
echo "<h2 style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; color: #e74c3c; margin: 30px 0; font-size: 28px; font-weight: 600; text-align: center; text-transform: uppercase; letter-spacing: 2px;'>Lista de Préstamos</h2>";
echo "<div style='display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 20px;'>";

$sql = "SELECT * FROM students";
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql .= " WHERE NombreAlum LIKE '%$search%' OR ApellidoAlum LIKE '%$search%' OR NombreLib LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            transition: all 0.3s ease;
        '>";
        echo "<h3 style='color: #3498db; margin-top: 0; font-size: 20px;'>" . $row["NombreAlum"]. " " . $row["ApellidoAlum"]. "</h3>";
        echo "<p style='margin: 5px 0; color: #7f8c8d;'><strong>Curso:</strong> " . $row["CursoAlum"]. "</p>";
        echo "<p style='margin: 5px 0; color: #7f8c8d;'><strong>Libro:</strong> " . $row["NombreLib"]. "</p>";
        echo "<p style='margin: 5px 0; color: #7f8c8d;'><strong>Cantidad:</strong> " . $row["Cantidad"]. "</p>";
        echo "<p style='margin: 5px 0; color: #7f8c8d;'><strong>Fecha:</strong> " . $row["fecha"]. "</p>";
        echo "<p style='margin: 5px 0; color: #7f8c8d;'><strong>Hora:</strong> " . $row["hora"]. "</p>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='submit' name='delete' value='Borrar' style='background-color: #e74c3c; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; color: #34495e; font-size: 18px; text-align: center; width: 100%;'>No hay registros de préstamos.</p>";
}
echo "</div>";

$conn->close();
?>