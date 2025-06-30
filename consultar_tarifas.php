<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Tarifas / Tarifas</title>
<style>
  body { font-family: Arial, sans-serif; margin: 20px; }
  h1 { text-align: center; }
  .language-switch { text-align: right; margin-bottom: 20px; }
  button { padding: 8px 12px; margin-left: 10px; }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
  th { background-color: #f4f4f4; }
</style>
</head>
<body>

<div class="language-switch">
  <button onclick="setLanguage('es')">Español</button>
  <button onclick="setLanguage('ja')">日本語</button>
</div>

<h1 id="title"></h1>

<table>
  <thead>
    <tr>
      <th id="th-name"></th>
      <th id="th-price"></th>
      <th id="th-desc"></th>
      <th id="th-yen"></th>
      <th id="th-cop"></th>
    </tr>
  </thead>
  <tbody id="tariff-body">
    <!-- Las tarifas se llenarán aquí con JavaScript -->
  </tbody>
</table>

<script>
  const data = {
    es: {
      title: "Tarifas",
      thName: "Nombre",
      thPrice: "Precio (USD)",
      thDesc: "Descripción",
      thYen: "Equivalencia en Yen",
      thCop: "Equivalencia en COP",
      tariffs: [
        { nombre: "Tarifa Estándar", precio: 1000, descripcion: "Incluye transporte, tours y alojamiento básico.", equivalencia_yen: 100, equivalencia_cop: 450000 },
        { nombre: "Tarifa Premium", precio: 2000, descripcion: "Incluye servicios exclusivos y alojamiento de lujo.", equivalencia_yen: 200, equivalencia_cop: 900000 },
        { nombre: "Tarifa Económica", precio: 700, descripcion: "Solo transporte y tours básicos.", equivalencia_yen: 70, equivalencia_cop: 315000 }
      ]
    },
    ja: {
      title: "料金",
      thName: "名前",
      thPrice: "価格（USD）",
      thDesc: "説明",
      thYen: "円換算",
      thCop: "コロンビアペソ換算",
      tariffs: [
        { nombre: "スタンダード料金", precio: 1000, descripcion: "交通、ツアー、基本宿泊を含む。", equivalencia_yen: 100, equivalencia_cop: 450000 },
        { nombre: "プレミアム料金", precio: 2000, descripcion: "エクスクルーシブサービスとラグジュアリーな宿泊を含む。", equivalencia_yen: 200, equivalencia_cop: 900000 },
        { nombre: "エコノミー料金", precio: 700, descripcion: "交通と基本ツアーのみ。", equivalencia_yen: 70, equivalencia_cop: 315000 }
      ]
    }
  };

  let currentLang = 'es';

  function setLanguage(lang) {
    currentLang = lang;
    renderPage();
  }

  function renderPage() {
    const langData = data[currentLang];
    document.getElementById('title').textContent = langData.title;
    document.getElementById('th-name').textContent = langData.thName;
    document.getElementById('th-price').textContent = langData.thPrice;
    document.getElementById('th-desc').textContent = langData.thDesc;
    document.getElementById('th-yen').textContent = langData.thYen;
    document.getElementById('th-cop').textContent = langData.thCop;

    const tbody = document.getElementById('tariff-body');
    tbody.innerHTML = '';

    langData.tariffs.forEach(tarifa => {
      const row = document.createElement('tr');

      const nameCell = document.createElement('td');
      nameCell.textContent = tarifa.nombre;
      row.appendChild(nameCell);

      const priceCell = document.createElement('td');
      priceCell.textContent = tarifa.precio.toFixed(2);
      row.appendChild(priceCell);

      const descCell = document.createElement('td');
      descCell.textContent = tarifa.descripcion;
      row.appendChild(descCell);

      const yenCell = document.createElement('td');
      yenCell.textContent = tarifa.equivalencia_yen.toFixed(2);
      row.appendChild(yenCell);

      const copCell = document.createElement('td');
      copCell.textContent = tarifa.equivalencia_cop.toFixed(2);
      row.appendChild(copCell);

      tbody.appendChild(row);
    });
  }

  // Inicializar página
  window.onload = () => {
    setLanguage(currentLang);
  };
</script>

</body>
</html>