<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
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
    
    #tarifa-link {
      transition: all 0.3s ease;
    }
    
    #tarifa-link:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Header/Navbar -->
  <header class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light container">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Mi Empresa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="#inicio">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tarifas2.php">Tarifas</a>
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
      
      <!-- Welcome Section -->
      <section class="text-center py-4">
        <h1 id="welcome" class="display-4 mb-4"></h1>
        <p class="lead mb-4" id="welcome-subtitle"></p>
        <a id="tarifa-link" href="tarifas2.php" class="btn btn-success btn-lg px-4"></a>
      </section>
      
      <!-- Features Section -->
      <section class="row mt-5 g-4">
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title" id="feature1-title"></h5>
              <p class="card-text" id="feature1-text"></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title" id="feature2-title"></h5>
              <p class="card-text" id="feature2-text"></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title" id="feature3-title"></h5>
              <p class="card-text" id="feature3-text"></p>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
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
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

  <script>
    const data = {
      es: {
        welcome: "Bienvenido a Nuestra Empresa",
        welcome_subtitle: "Soluciones innovadoras para tus necesidades",
        tarifa_texto: "Consultar Tarifas",
        feature1_title: "Servicio Rápido",
        feature1_text: "Ofrecemos soluciones rápidas y eficientes para tus problemas.",
        feature2_title: "Profesionales",
        feature2_text: "Nuestro equipo está altamente capacitado y certificado.",
        feature3_title: "Soporte 24/7",
        feature3_text: "Estamos disponibles para ayudarte en cualquier momento.",
        footer_rights: "Todos los derechos reservados."
      },
      ja: {
        welcome: "当社へようこそ",
        welcome_subtitle: "あなたのニーズに合わせた革新的なソリューション",
        tarifa_texto: "料金を見る",
        feature1_title: "迅速なサービス",
        feature1_text: "あなたの問題に対する迅速で効率的なソリューションを提供します。",
        feature2_title: "プロフェッショナル",
        feature2_text: "私たちのチームは高度な訓練を受け、認定されています。",
        feature3_title: "24/7サポート",
        feature3_text: "いつでもご相談いただけます。",
        footer_rights: "すべての権利は保留されています。"
      }
    };

    let currentLang = 'es';

    function setLanguage(lang) {
      currentLang = lang;
      renderPage();
    }

    function renderPage() {
      const langData = data[currentLang];
      
      // Update all text elements
      document.getElementById('welcome').textContent = langData.welcome;
      document.getElementById('welcome-subtitle').textContent = langData.welcome_subtitle;
      
      const tarifaLink = document.getElementById('tarifa-link');
      tarifaLink.textContent = langData.tarifa_texto;
      tarifaLink.href = 'tarifas.html';
      
      // Update features
      document.getElementById('feature1-title').textContent = langData.feature1_title;
      document.getElementById('feature1-text').textContent = langData.feature1_text;
      document.getElementById('feature2-title').textContent = langData.feature2_title;
      document.getElementById('feature2-text').textContent = langData.feature2_text;
      document.getElementById('feature3-title').textContent = langData.feature3_title;
      document.getElementById('feature3-text').textContent = langData.feature3_text;
      
      // Update footer
      document.getElementById('footer-rights').textContent = langData.footer_rights;
      
      // Update html lang attribute
      document.documentElement.lang = currentLang;
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', () => {
      // Try to get language from localStorage
      const savedLang = localStorage.getItem('preferredLanguage');
      if (savedLang) {
        currentLang = savedLang;
      }
      
      // Or detect browser language
      else if (navigator.language.startsWith('ja')) {
        currentLang = 'ja';
      }
      
      renderPage();
      
      // Save language preference when changed
      const langButtons = document.querySelectorAll('.language-switch button');
      langButtons.forEach(button => {
        button.addEventListener('click', function() {
          const lang = this.textContent === 'Español' ? 'es' : 'ja';
          localStorage.setItem('preferredLanguage', lang);
        });
      });
    });

</script>

</body>
</html>