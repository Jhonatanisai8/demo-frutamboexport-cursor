<?php
require __DIR__ . '/_auth.php';
require __DIR__ . '/../config/db.php';

$pdo = (new Database())->getConnection();

// Create or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    if ($nombre !== '') {
        if ($id > 0) {
            $stmt = $pdo->prepare('UPDATE clientes SET nombre=?, email=?, telefono=? WHERE id=?');
            $stmt->execute([$nombre, $email, $telefono, $id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO clientes (nombre, email, telefono) VALUES (?,?,?)');
            $stmt->execute([$nombre, $email, $telefono]);
        }
    }
    header('Location: /admin/clientes.php');
    exit;
}

// Delete
if (($_GET['action'] ?? '') === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    if ($id > 0) {
        $pdo->prepare('DELETE FROM clientes WHERE id=?')->execute([$id]);
    }
    header('Location: /admin/clientes.php');
    exit;
}

$clientes = $pdo->query('SELECT * FROM clientes ORDER BY id DESC')->fetchAll();

ob_start();
?>
<div class="container">
    <div class="page-header">
        <h3 class="page-title"><i class="bi bi-people text-primary"></i> Clientes</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clienteModal"><i class="bi bi-plus"></i> Nuevo</button>
    </div>

    <div class="card card-minimal">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><span class="badge badge-soft">#<?= $c['id'] ?></span></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['telefono']) ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" onclick="openEdit(<?= $c['id'] ?>,'<?= htmlspecialchars($c['nombre'], ENT_QUOTES) ?>','<?= htmlspecialchars($c['email'], ENT_QUOTES) ?>','<?= htmlspecialchars($c['telefono'], ENT_QUOTES) ?>')"><i class="bi bi-pencil"></i></button>
                                <a class="btn btn-sm btn-outline-danger" href="?action=delete&id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar cliente?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Cliente -->
<div class="modal fade" id="clienteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h5 class="modal-title">Cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" name="nombre" id="nombre" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" id="email" type="email">
          </div>
          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input class="form-control" name="telefono" id="telefono">
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
let clienteModal;
document.addEventListener('DOMContentLoaded', ()=>{
  const el = document.getElementById('clienteModal');
  clienteModal = new bootstrap.Modal(el);
});
function openEdit(id, nombre, email, telefono){
  document.getElementById('id').value = id;
  document.getElementById('nombre').value = nombre;
  document.getElementById('email').value = email;
  document.getElementById('telefono').value = telefono;
  clienteModal.show();
}
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
