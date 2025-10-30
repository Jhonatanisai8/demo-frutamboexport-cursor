<?php
require __DIR__ . '/_auth.php';
require __DIR__ . '/../config/db.php';
$pdo = (new Database())->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);
    if ($nombre !== '') {
        if ($id > 0) {
            $pdo->prepare('UPDATE productos SET nombre=?, precio=? WHERE id=?')->execute([$nombre, $precio, $id]);
        } else {
            $pdo->prepare('INSERT INTO productos (nombre, precio) VALUES (?,?)')->execute([$nombre, $precio]);
        }
    }
    header('Location: /admin/productos.php');
    exit;
}

if (($_GET['action'] ?? '') === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    if ($id > 0) $pdo->prepare('DELETE FROM productos WHERE id=?')->execute([$id]);
    header('Location: /admin/productos.php');
    exit;
}

$items = $pdo->query('SELECT * FROM productos ORDER BY id DESC')->fetchAll();

ob_start();
?>
<div class="container">
    <div class="page-header">
        <h3 class="page-title"><i class="bi bi-box-seam text-primary"></i> Productos</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal"><i class="bi bi-plus"></i> Nuevo</button>
    </div>

    <div class="card card-minimal">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $it): ?>
                        <tr>
                            <td><span class="badge badge-soft">#<?= $it['id'] ?></span></td>
                            <td><?= htmlspecialchars($it['nombre']) ?></td>
                            <td>S/ <?= number_format($it['precio'], 2) ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" onclick="openEdit(<?= $it['id'] ?>,'<?= htmlspecialchars($it['nombre'], ENT_QUOTES) ?>', <?= number_format($it['precio'], 2, '.', '') ?>)"><i class="bi bi-pencil"></i></button>
                                <a class="btn btn-sm btn-outline-danger" href="?action=delete&id=<?= $it['id'] ?>" onclick="return confirm('¿Eliminar producto?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Producto -->
<div class="modal fade" id="productoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title">Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" name="nombre" id="nombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Precio</label>
            <input class="form-control" name="precio" id="precio" type="number" step="0.01" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
      </form>
    </div>
  </div>
 </div>

<script>
let productoModal;
document.addEventListener('DOMContentLoaded', ()=>{
  const el = document.getElementById('productoModal');
  productoModal = new bootstrap.Modal(el);
});
function openEdit(id, nombre, precio){
  document.getElementById('id').value = id;
  document.getElementById('nombre').value = nombre;
  document.getElementById('precio').value = precio;
  productoModal.show();
}
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
