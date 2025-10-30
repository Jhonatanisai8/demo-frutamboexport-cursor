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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Clientes</h3>
        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formCliente">Nuevo</button>
    </div>
    <div id="formCliente" class="collapse mb-3">
        <div class="card card-minimal p-3">
            <form method="post" class="row g-2">
                <input type="hidden" name="id" id="id">
                <div class="col-md-4"><input class="form-control" name="nombre" id="nombre" placeholder="Nombre" required></div>
                <div class="col-md-4"><input class="form-control" name="email" id="email" type="email" placeholder="Email"></div>
                <div class="col-md-3"><input class="form-control" name="telefono" id="telefono" placeholder="Teléfono"></div>
                <div class="col-md-1 d-grid"><button class="btn btn-primary" type="submit">Guardar</button></div>
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
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['telefono']) ?></td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="fillForm(<?= $c['id'] ?>,'<?= htmlspecialchars($c['nombre'], ENT_QUOTES) ?>','<?= htmlspecialchars($c['email'], ENT_QUOTES) ?>','<?= htmlspecialchars($c['telefono'], ENT_QUOTES) ?>')" data-bs-toggle="collapse" data-bs-target="#formCliente">Editar</button>
                                    <a class="btn btn-sm btn-outline-danger" href="?action=delete&id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar cliente?')">Eliminar</a>
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
    function fillForm(id, nombre, email, telefono) {
        document.getElementById('id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('email').value = email;
        document.getElementById('telefono').value = telefono;
    }
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
