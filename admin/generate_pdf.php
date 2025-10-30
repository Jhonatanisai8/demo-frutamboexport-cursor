<?php
require __DIR__ . '/_auth.php';
require __DIR__ . '/../config/db.php';

// Configuración de la página
header('Content-Type: text/html; charset=utf-8');
header('Content-Disposition: attachment; filename="reporte_dashboard_' . date('YmdHis') . '.html"');

try {
    $pdo = (new Database())->getConnection();
    
    // Obtener estadísticas
    $clientes_count = $pdo->query('SELECT COUNT(*) as total FROM clientes')->fetch()['total'];
    $productos_count = $pdo->query('SELECT COUNT(*) as total FROM productos')->fetch()['total'];
    $ventas_count = $pdo->query('SELECT COUNT(*) as total FROM ventas')->fetch()['total'];
    $ingresos = $pdo->query('
        SELECT COALESCE(SUM(p.precio * v.cantidad), 0) as total 
        FROM ventas v 
        JOIN productos p ON p.id = v.producto_id
    ')->fetch()['total'];

    $stats = [
        'clientes' => ['count' => $clientes_count, 'label' => 'Clientes registrados'],
        'productos' => ['count' => $productos_count, 'label' => 'Productos activos'],
        'ventas' => ['count' => $ventas_count, 'label' => 'Ventas realizadas'],
        'ingresos' => ['count' => 'S/ ' . number_format($ingresos, 2), 'label' => 'Ingresos totales']
    ];
    
    // Obtener últimas ventas
    $ultimas_ventas = $pdo->query('
        SELECT v.id, c.nombre as cliente, p.nombre as producto, v.cantidad, 
               (p.precio * v.cantidad) as total, v.fecha
        FROM ventas v
        JOIN clientes c ON c.id = v.cliente_id
        JOIN productos p ON p.id = v.producto_id
        ORDER BY v.fecha DESC
        LIMIT 10
    ')->fetchAll(PDO::FETCH_ASSOC);
    
    // Generar HTML para el reporte
    $html = '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte del Dashboard - FruTamboExport</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                color: #333;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #00916E;
                padding-bottom: 10px;
            }
            .logo {
                max-width: 150px;
                margin-bottom: 10px;
            }
            h1 {
                color: #00916E;
                margin: 5px 0;
            }
            .date {
                color: #666;
                font-style: italic;
                margin-top: 5px;
            }
            .section {
                margin-bottom: 30px;
            }
            h2 {
                color: #00916E;
                border-bottom: 1px solid #ddd;
                padding-bottom: 5px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .footer {
                margin-top: 30px;
                text-align: center;
                font-size: 12px;
                color: #666;
                border-top: 1px solid #ddd;
                padding-top: 10px;
            }
            .text-right {
                text-align: right;
            }
            .text-center {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="data:image/jpeg;base64,' . base64_encode(file_get_contents(__DIR__ . '/../assets/imgs/logo.png')) . '" alt="FruTamboExport Logo" class="logo">
            <h1>Reporte del Dashboard - FruTamboExport</h1>
            <div class="date">Generado el: ' . date('d/m/Y H:i:s') . '</div>
        </div>
        
        <div class="section">
            <h2>Estadísticas Generales</h2>
            <table>
                <thead>
                    <tr>
                        <th>Indicador</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>';
    
    foreach ($stats as $key => $stat) {
        $html .= '
                    <tr>
                        <td>' . htmlspecialchars($stat['label']) . '</td>
                        <td class="text-center">' . htmlspecialchars($stat['count']) . '</td>
                    </tr>';
    }
    
    $html .= '
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <h2>Últimas Ventas</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>';
    
    foreach ($ultimas_ventas as $venta) {
        $html .= '
                    <tr>
                        <td class="text-center">' . htmlspecialchars($venta['id']) . '</td>
                        <td>' . htmlspecialchars($venta['cliente']) . '</td>
                        <td>' . htmlspecialchars($venta['producto']) . '</td>
                        <td class="text-center">' . htmlspecialchars($venta['cantidad']) . '</td>
                        <td class="text-right">S/ ' . number_format($venta['total'], 2) . '</td>
                        <td class="text-center">' . date('d/m/Y', strtotime($venta['fecha'])) . '</td>
                    </tr>';
    }
    
    $html .= '
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p>© ' . date('Y') . ' FruTamboExport. Todos los derechos reservados.</p>
        </div>
    </body>
    </html>';
    
    echo $html;
    
} catch (Exception $e) {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .error { color: red; border: 1px solid red; padding: 10px; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class="error">
            <h2>Error al generar el reporte</h2>
            <p>' . htmlspecialchars($e->getMessage()) . '</p>
        </div>
    </body>
    </html>';
}
?>