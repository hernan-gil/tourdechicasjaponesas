<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idioma = $_POST['idioma'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';

    // Validar datos
    if (empty($tipo) || empty($nombre) || empty($email)) {
        die('Por favor completa todos los campos.');
    }

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO suscripciones (idioma, tipo, nombre, email, fecha) VALUES (?, ?, ?, ?, NOW())");
    if ($stmt === false) {
        die('Error en preparar la consulta: ' . $conn->error);
    }

    // Vincular parámetros
    $stmt->bind_param("ssss", $idioma, $tipo, $nombre, $email);

    // Ejecutar
    if ($stmt->execute()) {
        echo 'Suscripción guardada correctamente.';
    } else {
        echo 'Error al guardar: ' . $stmt->error;
    }

    $stmt->close();
}
?>
