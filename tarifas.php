<?php
include 'config.php';

$result = $conn->query("SELECT * FROM tarifas");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Tarifa: " . $row['nombre'] . " - $" . $row['precio'] . $row['descripcion'] . " - " . $row['equivalencia_yen'] . " - " . $row['equivalencia_cop'] . "</p>";
    }
} else {
    echo "Error al consultar tarifas.";
}
?>