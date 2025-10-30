<?php require __DIR__.'/_auth.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel - FruTamboExport</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
  <nav class="navbar navbar-light bg-white border-bottom">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">Panel Administrativo</span>
      <div class="d-flex align-items-center gap-3">
        <span class="text-muted"><?= htmlspecialchars($_SESSION['user']['username'] ?? '') ?></span>
        <a href="/logout.php" class="btn btn-outline-danger btn-sm">Salir</a>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-9 py-4">
        <?php // content injected by children ?>
        <?= $content ?? '' ?>
      </div>
      <div class="col-lg-3 py-4 admin-sidebar-right">
        <div class="card card-minimal">
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action" href="/admin/index.php">Dashboard</a>
            <a class="list-group-item list-group-item-action" href="/admin/clientes.php">Clientes</a>
            <a class="list-group-item list-group-item-action" href="/admin/productos.php">Productos</a>
            <a class="list-group-item list-group-item-action" href="/admin/ventas.php">Ventas</a>
            <a class="list-group-item list-group-item-action" href="/admin/reportes.php">Reportes</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


