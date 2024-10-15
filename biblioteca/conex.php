<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>

