<?php
// Archivo index.php - Página principal de FruTamboExport
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> FruTamboExport - Empresa de Mango</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  </style>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      background-color: #fff8ed;
      font-family: 'Poppins', sans-serif;
      line-height: 1.6;
    }
    
    .navbar { 
      background-color: #03BB85; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 12px 0;
    }
    
    .navbar .nav-link { 
      color: white; 
      margin: 0 10px; 
      font-weight: 500; 
      transition: all 0.3s ease;
      position: relative;
      padding: 8px 0;
    }
    
    .navbar .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: white;
      transition: width 0.3s ease;
    }
    
    .navbar .nav-link:hover::after {
      width: 100%;
    }
    
    .navbar .nav-link:hover { 
      color: #FFFFFF; 
    }
    
    .navbar-brand { 
      color: #FFFFFF !important; 
      font-weight: 700; 
      font-size: 1.6rem; 
      letter-spacing: 0.5px;
    }
    
    .navbar .nav-link.active { 
      color: #FFFFFF !important; 
      font-weight: 600; 
    }
    
    .navbar .nav-link.active::after {
      width: 100%;
    }

    .carousel-item img { 
      height: 90vh; 
      object-fit: cover; 
      filter: brightness(85%); 
    }
    
    .carousel-caption { 
      bottom: 25%; 
      background-color: rgba(0,0,0,0.3);
      padding: 20px;
      border-radius: 10px;
      max-width: 80%;
      margin: 0 auto;
    }
    
    .carousel-caption h1 { 
      font-size: 3.2rem; 
      font-weight: bold; 
      color: #ffffff; 
      text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
      margin-bottom: 15px;
    }
    
    .carousel-caption p { 
      font-size: 1.3rem; 
      text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
      margin-bottom: 20px;
    }

    .btn-danger { 
      background-color: #03BB85; 
      border: none; 
      padding: 12px 30px; 
      border-radius: 30px; 
      font-weight: 600; 
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .btn-danger:hover { 
      background-color: #029e71; 
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.3);
    }

    .section-title {
      position: relative;
      margin-bottom: 40px;
      padding-bottom: 15px;
      text-align: center;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      width: 80px;
      height: 3px;
      background-color: #03BB85;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }

    .card { 
      border-radius: 15px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      border: none;
      margin-bottom: 25px;
      background-color: white;
    }

    .card:hover { 
      transform: translateY(-8px); 
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); 
    }
    
    .card-body {
      padding: 1.5rem;
    }
    
    .card-title {
      font-weight: 600;
      color: #03BB85;
      margin-bottom: 0.8rem;
    }
    
    .card-text {
      color: #666;
      margin-bottom: 1.2rem;
    }
    
    .producto-img {
      height: 200px;
      object-fit: cover;
      width: 100%;
    }

    .btn-red { 
      background-color: #03BB85; 
      color: white; 
      font-weight: 600; 
      border-radius: 20px;
      padding: 10px 25px;
      transition: all 0.3s ease;
    }
    
    .btn-red:hover { 
      background-color: #029e71; 
      color: white;
      transform: translateY(-3px);
    }

    .nosotros { 
      background-color: #f8f9fa; 
      padding: 80px 20px;
      border-radius: 0;
    }
    
    .nosotros img {
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    footer { 
      background-color: #03BB85; 
      color: white; 
      padding: 40px 0 20px;
    }
    
    footer a { 
      color: #FFFFFF; 
      text-decoration: none;
      transition: all 0.3s ease;
      margin: 0 10px;
    }
    
    footer a:hover { 
      color: #f0f0f0;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="assets/imgs/logo.jpg" alt="Logo FruTamboExport" width="110" height="90" class="me-2">
        FruTamboExport
      </a>
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" href="#">INICIO</a></li>
          <li class="nav-item"><a class="nav-link" href="#PRODUCTOS">PRODUCTOS</a></li>
          <li class="nav-item"><a class="nav-link" href="#NOSOTROS">NOSOTROS</a></li>
          <li class="nav-item"><a class="nav-link" href="#CONTACTANOS">CONTÁCTANOS</a></li>
          <li class="nav-item"><a class="nav-link" href="#UBICACION">UBICACION</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>


        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO CARRUSEL -->
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/imgs/mango1.png" class="d-block w-100" alt="Mango de exportación">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1> FruTamboExport</h1>
          <p style="color: white; text-align: center;">EXPLORA NUESTRA CALIDAD DE EXPORTACIÓN POR TODO EL MUNDO</p>
          <a href="#PRODUCTOS" class="btn btn-danger btn-lg">Ver productos</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/imgs/palta1.png" class="d-block w-100" alt="Palta de exportación">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1> FruTamboExport</h1>
          <p style="color: white; text-align: center;">EXPLORA NUESTRA CALIDAD DE EXPORTACIÓN POR TODO EL MUNDO</p>
          <a href="#PRODUCTOS" class="btn btn-danger btn-lg">Ver productos</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/imgs/mango2.png" class="d-block w-100" alt="Mango de calidad">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1> FruTamboExport</h1>
          <p style="color: white; text-align: center;">ENCUENTRA LA MEJOR CALIDAD DE MANGO Y PALTA</p>
          <a href="#CONTACTANOS" class="btn btn-danger btn-lg">Contáctanos</a>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>




  <!-- PRODUCTOS -->
  <section id="PRODUCTOS" class="container my-5">
    <h2 class="section-title"><strong><span style="color:#03BB85;">PRODUCTOS DE EXCELENTE CALIDAD</span></strong></h2>
    <div class="row g-4">
      <!-- 1 -->
      <div class="col-md-4">
        <div class="card producto-card text-center h-100">
          <img src="assets/imgs/mango1.png"
            class="producto-img" alt="Mango 1">
          <div class="card-body">
            <h5 class="card-title">MANGO HADEN</h5>
            <p class="card-text small">Fruta de piel rojiza con tonos verdes y amarillos, de pulpa firme y ligeramente fibrosa, con un sabor dulce y refrescante.</p>
          </div>
        </div>
      </div>

      <!-- 2 -->
      <div class="col-md-4">
        <div class="card producto-card text-center h-100">
          <img src="assets/imgs/mango2.png"
            class="producto-img" alt="Mango 2">
          <div class="card-body">
            <h5 class="card-title">MANGO KENT</h5>
            <p class="card-text small">Variedad muy apreciada por su pulpa jugosa, casi sin fibra, y un sabor dulce y suave. Ideal para exportación.</p>
          </div>
        </div>
      </div>

      <!-- 3 -->
      <div class="col-md-4">
        <div class="card producto-card text-center h-100">
          <img src="assets/imgs/mango3.png"
            class="producto-img" alt="Mango 3">
          <div class="card-body">
            <h5 class="card-title">MANGO EDWARD</h5>
            <p class="card-text small">Mango de piel amarilla con matices rosados, de textura cremosa y un sabor dulce y aromático único.</p>
          </div>
        </div>
      </div>

      <!-- 4 -->
      <div class="col-md-4">
        <div class="card producto-card text-center h-100">
          <img src="assets/imgs/palta1.png"
            class="producto-img" alt="Palta 4">
          <div class="card-body">
            <h5 class="card-title">PALTA HASS</h5>
            <p class="card-text small">La favorita a nivel mundial. Su piel rugosa cambia de verde a negro al madurar, con pulpa cremosa y sabor intenso.</p>
          </div>
        </div>
      </div>

      <!-- 5 -->
      <div class="col-md-4">
        <div class="card producto-card text-center h-100">
          <img src="assets/imgs/palta2.png"
            class="producto-img" alt="Palta 5">
          <div class="card-body">
            <h5 class="card-title">PALTA FUERTE</h5>
            <p class="card-text small">De piel verde y lisa, con pulpa suave y menos grasosa, reconocida por su frescura y sabor delicado.</p>
          </div>
        </div>
      </div>

      <!-- 6 -->
      <div class="col-md-4">
        <div class="card producto-card text-center h-100">
          <img src="assets/imgs/palta3.png"
            class="producto-img" alt="Palta 6">
          <div class="card-body">
            <h5 class="card-title">MANGO NAVAL</h5>
            <p class="card-text small">Variedad de piel verde y pulpa consistente, con un equilibrio perfecto entre frescura y sabor.</p>
          </div>
        </div>
      </div>

    </div>
  </section>


  <!-- NOSOTROS -->
  <section id="NOSOTROS" class="nosotros">
    <div class="container">
      <h2 class="text-center mb-4"><strong><span style="color:black;">SOBRE NOSOTROS</span></strong></h2>
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="assets/imgs/sobre-nosotrs.jpg" class="img-fluid rounded" alt="NOSOTROS">
        </div>
        <div class="col-md-6 d-flex align-items-start">
          <div>
            <p style="color: black; text-align;">Somos una agroexportadora comprometida con la excelencia, dedicada a la producción y exportación de frutas frescas como el mango (Haden, Kent y Edward) y la palta (Hass, Fuerte y Naval). Nuestra labor comienza en el campo, trabajando junto a agricultores que aplican buenas prácticas agrícolas para garantizar productos de la más alta calidad, respetando el medio ambiente y fomentando el desarrollo sostenible.</p>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- CONTACTANOS -->
  <section id="CONTACTANOS" class="container my-5">
    <h2 class="text-center mb-4"></b>
      <p style="color: white; text-align: center;">CONTACTANOS</p>
    </h2></b>
    <form class="row g-3" method="post" action="procesar_contacto.php">
      <div class="col-md-6">
        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
      </div>
      <div class="col-md-6">
        <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
      </div>
      <div class="col-12">
        <textarea class="form-control" name="mensaje" rows="4" placeholder="Mensaje"></textarea>
      </div>
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-red">Enviar Mensaje</button>
      </div>
    </form>
  </section>
  <!-- UBICACION -->
  <section id="UBICACION" class="container my-5">
    <h2 class="section-title"><b>
        <p style="color: white; text-align: center;">UBICACIÓN</p>
    </h2></b>
    <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!4v1759523806079!6m8!1m7!1szhV3Lo0itiMYUBpAJqndvw!2m2!1d-4.901185049343534!2d-80.33186588402593!3f58.0253454875436!4f9.952722423727948!5f0.7820865974627469" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </section>
  <!-- FOOTER -->
  <footer>
    <div class="container text-center">
      <p style="color: #FFFFFF; text-align: center;">© <?php echo date('Y'); ?> FruTamboExport - Empresa Agroexportadora. Todos los derechos reservados.</p>
      <p>
        <a href="https://www.facebook.com/profile.php?id=61581807955812">Facebook</a> |
        <a href="https://www.tiktok.com/@frutamboexport?_t=ZS-90EYVJauchc&_r=1">Tiktok</a> |
        <a href="https://wa.me/51960116187" target="_blank">WhatsApp</a>
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>