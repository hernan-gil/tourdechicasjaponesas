<?php
include 'includes/config.php';

// Obtener tarifas de la base de datos
$tarifas = [];
$query = "SELECT nombre, precio, descripcion, equivalencia_yen, equivalencia_cop FROM tarifas";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tarifas[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tarifas</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    .main-content {
      flex: 1;
    }
    
    .language-switch {
      margin-bottom: 1rem;
    }
    
    .tariff-table {
      margin-top: 2rem;
    }
    
    .table-responsive {
      overflow-x: auto;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Header/Navbar (igual que en index) -->
  <header class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light container">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Mi Empresa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#tarifas">Tarifas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacto.php">Contacto</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="main-content py-5">
    <div class="container">
      <!-- Language Switch -->
      <div class="language-switch d-flex justify-content-end">
        <div class="btn-group" role="group">
          <button type="button" class="btn btn-outline-primary" onclick="setLanguage('es')">Español</button>
          <button type="button" class="btn btn-outline-primary" onclick="setLanguage('ja')">日本語</button>
        </div>
      </div>
      
      <!-- Title -->
      <h1 id="title" class="text-center mb-4"></h1>
      
      <!-- Tariff Table -->
      <div class="table-responsive tariff-table">
        <table class="table table-striped table-hover">
          <thead class="table-light">
            <tr>
              <th id="th-name"></th>
              <th id="th-price" class="text-end"></th>
              <th id="th-desc"></th>
              <th id="th-yen" class="text-end"></th>
              <th id="th-cop" class="text-end"></th>
            </tr>
          </thead>
          <tbody id="tariff-body">
            <?php foreach ($tarifas as $tarifa): ?>
            <tr>
              <td><?= htmlspecialchars($tarifa['nombre']) ?></td>
              <td class="text-end">$<?= number_format($tarifa['precio'], 2) ?></td>
              <td><?= htmlspecialchars($tarifa['descripcion']) ?></td>
              <td class="text-end">¥<?= number_format($tarifa['equivalencia_yen'], 2) ?></td>
              <td class="text-end">$<?= number_format($tarifa['equivalencia_cop'], 2) ?> COP</td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- Footer (igual que en index) -->
  <footer class="bg-dark text-white py-3 mt-auto">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="mb-0">&copy; 2023 Mi Empresa. <span id="footer-rights"></span></p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
          <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const translations = {
      es: {
        title: "Tarifas",
        thName: "Nombre",
        thPrice: "Precio (USD)",
        thDesc: "Descripción",
        thYen: "Equivalencia en Yen",
        thCop: "Equivalencia en COP",
        footer_rights: "Todos los derechos reservados."
      },
      ja: {
        title: "料金",
        thName: "名前",
        thPrice: "価格（USD）",
        thDesc: "説明",
        thYen: "円換算",
        thCop: "コロンビアペソ換算",
        footer_rights: "すべての権利は保留されています。"
      }
    };

    let currentLang = localStorage.getItem('preferredLanguage') || 'es';

    function setLanguage(lang) {
      currentLang = lang;
      localStorage.setItem('preferredLanguage', lang);
      renderTranslations();
    }

    function renderTranslations() {
      const langData = translations[currentLang];
      
      // Update all text elements
      document.getElementById('title').textContent = langData.title;
      document.getElementById('th-name').textContent = langData.thName;
      document.getElementById('th-price').textContent = langData.thPrice;
      document.getElementById('th-desc').textContent = langData.thDesc;
      document.getElementById('th-yen').textContent = langData.thYen;
      document.getElementById('th-cop').textContent = langData.thCop;
      
      // Update footer
      document.getElementById('footer-rights').textContent = langData.footer_rights;
      
      // Update html lang attribute
      document.documentElement.lang = currentLang;
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', () => {
      // Try to get language from localStorage or detect browser language
      if (!localStorage.getItem('preferredLanguage') && navigator.language.startsWith('ja')) {
        currentLang = 'ja';
      }
      
      renderTranslations();
    });
  </script>
</body>
</html>