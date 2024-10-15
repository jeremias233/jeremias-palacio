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

echo "<h2 style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; color: #e74c3c; margin: 30px 0; font-size: 28px; font-weight: 600; text-align: center; text-transform: uppercase; letter-spacing: 2px;'>Libros con más de 3 días de préstamo</h2>";

echo "<script>
function mostrarAlerta(mensaje) {
    Swal.fire({
        title: 'Información del préstamo',
        text: mensaje,
        icon: 'info',
        confirmButtonText: 'Entendido'
    });
}

function confirmarDevolucion(id) {
    Swal.fire({
        title: '¿Confirmar devolución?',
        text: '¿Estás seguro de que quieres marcar este libro como devuelto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-devolucion-' + id).submit();
        }
    });
}
</script>";

echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css'>";
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js'></script>";

$fechaActual = date('Y-m-d');
$fechaLimite = date('Y-m-d', strtotime('-3 days'));

if (isset($_POST['devolver'])) {
    $id = $_POST['id'];
    $sqlDelete = "DELETE FROM students WHERE id = $id";
    if ($conn->query($sqlDelete) === TRUE) {
        echo "<script>
        sessionStorage.setItem('libroDevuelto', 'true');
        window.location.href = window.location.href;
        </script>";
        exit();
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al marcar el libro como devuelto.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}

echo "<script>
window.onload = function() {
    if (sessionStorage.getItem('libroDevuelto') === 'true') {
        Swal.fire({
            title: 'Éxito',
            text: 'El libro ha sido marcado como devuelto y eliminado del registro.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        sessionStorage.removeItem('libroDevuelto');
    }
}
</script>";

$sql = "SELECT * FROM students WHERE fecha <= '$fechaLimite' ORDER BY fecha ASC";
$result = $conn->query($sql);

echo "<div style='display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; padding: 20px;'>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $diasRetraso = floor((strtotime($fechaActual) - strtotime($row['fecha'])) / (60 * 60 * 24));
        $mensaje = "El alumno " . $row['NombreAlum'] . " " . $row['ApellidoAlum'] . " del curso " . $row['CursoAlum'] . " tiene un retraso de " . $diasRetraso . " días con el libro " . $row['NombreLib'];
        echo "<div style='display: flex; flex-direction: column; align-items: center;'>";
        echo "<button onclick='mostrarAlerta(\"" . $mensaje . "\")' style='margin: 5px; padding: 15px; background-color: rgba(52, 152, 219, 0.7); color: white; border: none; border-radius: 8px; cursor: pointer; font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1);'>" . $row['NombreAlum'] . " " . $row['ApellidoAlum'] . "<br>" . $row['CursoAlum'] . "<br>" . $row['NombreLib'] . "</button>";
        echo "<button onclick='confirmarDevolucion(" . $row['id'] . ")' style='margin-top: 5px; padding: 10px; background-color: #2ecc71; color: white; border: none; border-radius: 5px; cursor: pointer; font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; font-size: 12px;'>Marcar como devuelto</button>";
        echo "<form id='form-devolucion-" . $row['id'] . "' method='POST' style='display:none;'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<input type='hidden' name='devolver' value='1'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "<p style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; color: #34495e; font-size: 18px; text-align: center; width: 100%;'>No hay libros con más de 3 días de préstamo.</p>";
}

echo "</div>";

$conn->close();
?>