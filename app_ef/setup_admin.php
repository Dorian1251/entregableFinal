<?php
/**
 * Script para crear o actualizar el usuario administrador
 * 
 * USO: php setup_admin.php [correo] [contrasena]
 */

require __DIR__ . '/vendor/autoload.php';

// Configuración de la base de datos
$host = '192.168.56.250';
$dbname = 'db_ef';
$username = 'dorian';
$password = 'php1251*';

$correo = $argv[1] ?? 'admin@ejemplo.com';
$contrasena = $argv[2] ?? 'Admin123!';

echo "=== Configuración de Usuario Admin ===\n\n";
echo "Correo: {$correo}\n";
echo "Contraseña: {$contrasena}\n\n";

try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    
    // Verificar si existe la columna 'role' y 'active'
    $stmt = $conn->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $alterQueries = [];
    
    if (!in_array('role', $columns)) {
        $alterQueries[] = "ADD COLUMN role ENUM('admin', 'user') NOT NULL DEFAULT 'user' AFTER password";
    }
    
    if (!in_array('active', $columns)) {
        $alterQueries[] = "ADD COLUMN active TINYINT(1) NOT NULL DEFAULT 1 AFTER role";
    }
    
    // Ejecutar ALTER TABLE si es necesario
    if (!empty($alterQueries)) {
        echo "Actualizando estructura de la tabla users...\n";
        foreach ($alterQueries as $query) {
            $conn->exec("ALTER TABLE users " . $query);
        }
        echo "✓ Estructura actualizada\n";
    }
    
    // Verificar si el usuario existe
    $stmt = $conn->prepare("SELECT id, correo FROM users WHERE correo = :correo");
    $stmt->execute([':correo' => $correo]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Actualizar usuario existente
        $sql = "UPDATE users SET 
                password = :password,
                role = 'admin',
                active = 1,
                nombre = COALESCE(nombre, 'Administrador'),
                apellido = COALESCE(apellido, 'Sistema')
                WHERE correo = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':password' => $hash,
            ':correo' => $correo
        ]);
        echo "✓ Usuario actualizado: {$correo}\n";
    } else {
        // Crear nuevo usuario
        $sql = "INSERT INTO users (nombre, apellido, correo, password, role, active) 
                VALUES ('Administrador', 'Sistema', :correo, :password, 'admin', 1)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':correo' => $correo,
            ':password' => $hash
        ]);
        echo "✓ Usuario creado: {$correo}\n";
    }
    
    echo "\n=== Credenciales de Acceso ===\n";
    echo "URL: http://172.25.0.209:8765/login\n";
    echo "Correo: {$correo}\n";
    echo "Contraseña: {$contrasena}\n";
    echo "\n✓ ¡Listo! Ya puedes iniciar sesión.\n";
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
