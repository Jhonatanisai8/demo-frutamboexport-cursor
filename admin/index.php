<?php
require __DIR__ . '/_auth.php';
$content = '<div class="container"><h2 class="mb-4">Bienvenido, ' . htmlspecialchars($_SESSION['user']['username']) . '</h2><div class="row g-3"><div class="col-md-4"><div class="card card-minimal p-3"><h5 class="mb-1">Clientes</h5><a href="/admin/clientes.php" class="stretched-link">Gestionar</a></div></div><div class="col-md-4"><div class="card card-minimal p-3"><h5 class="mb-1">Productos</h5><a href="/admin/productos.php" class="stretched-link">Gestionar</a></div></div><div class="col-md-4"><div class="card card-minimal p-3"><h5 class="mb-1">Ventas</h5><a href="/admin/ventas.php" class="stretched-link">Gestionar</a></div></div></div></div>';
include __DIR__ . '/layout.php';
