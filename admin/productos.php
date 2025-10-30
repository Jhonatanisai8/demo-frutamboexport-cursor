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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Productos</h3>
        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formItem">Nuevo</button>
    </div>
    <div id="formItem" class="collapse mb-3">
        <div class="card card-minimal p-3">
            <form method="post" class="row g-2">
                <input type="hidden" name="id" id="id">
                <div class="col-md-6"><input class="form-control" name="nombre" id="nombre" placeholder="Nombre" required></div>
                <div class="col-md-4"><input class="form-control" name="precio" id="precio" type="number" step="0.01" placeholder="Precio" required></div>
                <div class="col-md-2 d-grid"><button class="btn btn-primary" type="submit">Guardar</button></div>
            </form>
        </div>
    </div>

    <div class="card card-minimal">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $it): ?>
                        <tr>
                            <td><?= $it['id'] ?></td>
                            <td><?= htmlspecialchars($it['nombre']) ?></td>
                            <td>S/ <?= number_format($it['precio'], 2) ?></td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="fillForm(<?= $it['id'] ?>,'<?= htmlspecialchars($it['nombre'], ENT_QUOTES) ?>', <?= number_format($it['precio'], 2, '.', '') ?>)" data-bs-toggle="collapse" data-bs-target="#formItem">Editar</button>
                                    <a class="btn btn-sm btn-outline-danger" href="?action=delete&id=<?= $it['id'] ?>" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function fillForm(id, nombre, precio) {
        document.getElementById('id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('precio').value = precio;
    }
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
