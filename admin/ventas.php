<?php
require __DIR__ . '/_auth.php';
require __DIR__ . '/../config/db.php';
$pdo = (new Database())->getConnection();

$clientes = $pdo->query('SELECT id, nombre FROM clientes ORDER BY nombre')->fetchAll();
$productos = $pdo->query('SELECT id, nombre, precio FROM productos ORDER BY nombre')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $cliente_id = intval($_POST['cliente_id'] ?? 0);
    $producto_id = intval($_POST['producto_id'] ?? 0);
    $cantidad = intval($_POST['cantidad'] ?? 1);
    $fecha = $_POST['fecha'] ?: date('Y-m-d');
    if ($cliente_id && $producto_id && $cantidad > 0) {
        if ($id > 0) {
            $pdo->prepare('UPDATE ventas SET cliente_id=?, producto_id=?, cantidad=?, fecha=? WHERE id=?')->execute([$cliente_id, $producto_id, $cantidad, $fecha, $id]);
        } else {
            $pdo->prepare('INSERT INTO ventas (cliente_id, producto_id, cantidad, fecha) VALUES (?,?,?,?)')->execute([$cliente_id, $producto_id, $cantidad, $fecha]);
        }
    }
    header('Location: /admin/ventas.php');
    exit;
}

if (($_GET['action'] ?? '') === 'delete') {
    $id = intval($_GET['id'] ?? 0);
    if ($id > 0) $pdo->prepare('DELETE FROM ventas WHERE id=?')->execute([$id]);
    header('Location: /admin/ventas.php');
    exit;
}

$rows = $pdo->query('SELECT v.id, c.nombre AS cliente, p.nombre AS producto, p.precio, v.cantidad, v.fecha, (p.precio*v.cantidad) total
FROM ventas v
JOIN clientes c ON c.id=v.cliente_id
JOIN productos p ON p.id=v.producto_id
ORDER BY v.id DESC')->fetchAll();

ob_start();
?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Ventas</h3>
        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formVenta">Nueva</button>
    </div>
    <div id="formVenta" class="collapse mb-3">
        <div class="card card-minimal p-3">
            <form method="post" class="row g-2">
                <input type="hidden" name="id" id="id">
                <div class="col-md-4">
                    <select class="form-select" name="cliente_id" id="cliente_id" required>
                        <option value="">Cliente...</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="producto_id" id="producto_id" required>
                        <option value="">Producto...</option>
                        <?php foreach ($productos as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2"><input class="form-control" type="number" min="1" name="cantidad" id="cantidad" value="1" required></div>
                <div class="col-md-2"><input class="form-control" type="date" name="fecha" id="fecha" value="<?= date('Y-m-d') ?>" required></div>
                <div class="col-12 d-grid"><button class="btn btn-primary" type="submit">Guardar</button></div>
            </form>
        </div>
    </div>

    <div class="card card-minimal">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= htmlspecialchars($r['cliente']) ?></td>
                            <td><?= htmlspecialchars($r['producto']) ?></td>
                            <td><?= $r['cantidad'] ?></td>
                            <td><?= htmlspecialchars($r['fecha']) ?></td>
                            <td>S/ <?= number_format($r['total'], 2) ?></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-danger" href="?action=delete&id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar venta?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
