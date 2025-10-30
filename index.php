<?php $pageTitle = 'FruTamboExport - Inicio'; include __DIR__.'/includes/header.php'; ?>

<section id="inicio" class="section hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold">Exportamos calidad, frescura y confianza</h1>
        <p class="lead">FruTamboExport conecta los mejores cultivos con el mundo. Cumplimos estándares internacionales y trazabilidad completa.</p>
        <a href="#productos" class="btn btn-primary btn-lg">Ver productos</a>
      </div>
      <div class="col-lg-6 text-center">
        <img class="img-fluid" src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?q=80&w=1200&auto=format&fit=crop" alt="Frutas frescas">
      </div>
    </div>
  </div>
  </section>

<section id="productos" class="section">
  <div class="container">
    <h2 class="mb-4">Productos</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card card-minimal h-100">
          <div class="card-body">
            <h5 class="card-title">Mango</h5>
            <p class="card-text">Selección premium para exportación.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-minimal h-100">
          <div class="card-body">
            <h5 class="card-title">Palta</h5>
            <p class="card-text">Hass certificada con trazabilidad.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-minimal h-100">
          <div class="card-body">
            <h5 class="card-title">Uva</h5>
            <p class="card-text">Variedades sin semilla, excelente calibre.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>

<section id="nosotros" class="section bg-light-soft">
  <div class="container">
    <h2 class="mb-3">Nosotros</h2>
    <p>Somos una empresa peruana dedicada a la exportación de frutas, con estándares de calidad y cumplimiento normativo.</p>
  </div>
  </section>

<section id="contacto" class="section">
  <div class="container">
    <h2 class="mb-3">Contáctanos</h2>
    <form class="row g-3">
      <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Nombre" required>
      </div>
      <div class="col-md-6">
        <input type="email" class="form-control" placeholder="Correo" required>
      </div>
      <div class="col-12">
        <textarea class="form-control" rows="4" placeholder="Mensaje" required></textarea>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </form>
  </div>
  </section>

<section id="ubicacion" class="section bg-light-soft">
  <div class="container">
    <h2 class="mb-3">Ubicación</h2>
    <div class="ratio ratio-16x9 card-minimal">
      <iframe src="https://www.google.com/maps?q=Lima,Peru&output=embed" style="border:0;" allowfullscreen loading="lazy"></iframe>
    </div>
  </div>
  </section>

<?php include __DIR__.'/includes/footer.php'; ?>


