FruTamboExport

Mini sistema web (PHP 8 + MySQL + Bootstrap 5).

Instalación
- Importa `schema.sql` en MySQL. Usuario: admin / clave: admin123
- Ajusta credenciales en `config/db.php`.
- Sirve el proyecto: `php -S localhost:8000 -t .`

Estructura
- `index.php`: Landing pública
- `login.php`, `login_process.php`, `logout.php`: Autenticación
- `admin/`: Panel administrativo y CRUD
- `assets/`: Estilos y scripts


