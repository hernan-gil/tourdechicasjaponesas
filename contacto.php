<?php
require_once 'includes/config.php';

// Inicializar variables
$nombre = $email = $mensaje = '';
$error = '';
$success = false;

// Procesar formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar inputs
    $nombre = trim($_POST['nombre'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST['mensaje'] ?? '');
    
    // Validaciones
    if (empty($nombre)) {
        $error = 'El nombre es requerido';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El email no es válido';
    } elseif (empty($mensaje)) {
        $error = 'El mensaje es requerido';
    } else {
        // Insertar en base de datos
        $stmt = $conn->prepare("INSERT INTO contactos (nombre, email, mensaje, fecha) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $nombre, $email, $mensaje);
        
        if ($stmt->execute()) {
            $success = true;
            // Limpiar campos después de enviar
            $nombre = $email = $mensaje = '';
        } else {
            $error = 'Error al enviar el mensaje. Por favor intenta más tarde.';
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contacto</title>
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
    
    .contact-form {
      max-width: 600px;
      margin: 0 auto;
    }
    
    .form-section {
      background-color: #f8f9fa;
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .contact-info {
      margin-top: 2rem;
    }
    
    .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .info-icon {
      font-size: 1.5rem;
      margin-right: 1rem;
      color: #0d6efd;
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
              <a class="nav-link" href="tarifas2.php">Tarifas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#contacto">Contacto</a>
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
      <h1 id="title" class="text-center mb-4">Contacto</h1>
      
      <!-- Form Section -->
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="form-section">
            <?php if ($error): ?>
              <div class="alert alert-danger" id="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
              <div class="alert alert-success" id="success-message">
                <span id="success-text">Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.</span>
              </div>
            <?php endif; ?>
            
            <form id="contact-form" method="POST" action="contacto.php">
              <div class="mb-3">
                <label for="nombre" class="form-label" id="label-name">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" 
                       value="<?= htmlspecialchars($nombre) ?>" required>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label" id="label-email">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= htmlspecialchars($email) ?>" required>
              </div>
              
              <div class="mb-3">
                <label for="mensaje" class="form-label" id="label-message">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required><?= htmlspecialchars($mensaje) ?></textarea>
              </div>
              
              <div class="d-grid">
                <button type="submit" class="btn btn-primary" id="submit-btn">Enviar Mensaje</button>
              </div>
            </form>
          </div>
          
          <!-- Contact Info -->
          <div class="contact-info">
            <h3 id="contact-title" class="mb-4">Información de Contacto</h3>
            
            <div class="info-item">
              <i class="bi bi-geo-alt-fill info-icon"></i>
              <div>
                <h5 id="address-title">Dirección</h5>
                <p id="address-text">Calle Principal 123, Ciudad, País</p>
              </div>
            </div>
            
            <div class="info-item">
              <i class="bi bi-telephone-fill info-icon"></i>
              <div>
                <h5 id="phone-title">Teléfono</h5>
                <p id="phone-text">+123 456 7890</p>
              </div>
            </div>
            
            <div class="info-item">
              <i class="bi bi-envelope-fill info-icon"></i>
              <div>
                <h5 id="email-title">Email</h5>
                <p id="email-text">info@empresa.com</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer (igual que en index) -->
  <footer class="bg-dark text-white py-3 mt-auto">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="mb-0">&copy; 2023 Mi Empresa. <span id="footer-rights">Todos los derechos reservados.</span></p>
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
        title: "Contacto",
        labelName: "Nombre",
        labelEmail: "Email",
        labelMessage: "Mensaje",
        submitBtn: "Enviar Mensaje",
        contactTitle: "Información de Contacto",
        addressTitle: "Dirección",
        addressText: "Calle Principal 123, Ciudad, País",
        phoneTitle: "Teléfono",
        phoneText: "+123 456 7890",
        emailTitle: "Email",
        emailText: "info@empresa.com",
        successText: "Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.",
        footer_rights: "Todos los derechos reservados."
      },
      ja: {
        title: "お問い合わせ",
        labelName: "名前",
        labelEmail: "メールアドレス",
        labelMessage: "メッセージ",
        submitBtn: "メッセージを送る",
        contactTitle: "連絡先情報",
        addressTitle: "住所",
        addressText: "メインストリート123番地、市、国",
        phoneTitle: "電話",
        phoneText: "+123 456 7890",
        emailTitle: "メール",
        emailText: "info@empresa.com",
        successText: "お問い合わせありがとうございます。すぐにご連絡いたします。",
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
      document.getElementById('label-name').textContent = langData.labelName;
      document.getElementById('label-email').textContent = langData.labelEmail;
      document.getElementById('label-message').textContent = langData.labelMessage;
      document.getElementById('submit-btn').textContent = langData.submitBtn;
      document.getElementById('contact-title').textContent = langData.contactTitle;
      document.getElementById('address-title').textContent = langData.addressTitle;
      document.getElementById('address-text').textContent = langData.addressText;
      document.getElementById('phone-title').textContent = langData.phoneTitle;
      document.getElementById('phone-text').textContent = langData.phoneText;
      document.getElementById('email-title').textContent = langData.emailTitle;
      document.getElementById('email-text').textContent = langData.emailText;
      
      // Update success message if exists
      const successText = document.getElementById('success-text');
      if (successText) {
        successText.textContent = langData.successText;
      }
      
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