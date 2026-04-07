<?php
/**
 * Script para actualizar la contraseña de un usuario a hash bcrypt
 * 
 * USO: php update_password.php correo@ejemplo.com nueva_contrasena
 * 
 * Ejemplo: php update_password.php jose@gmail.com 1251
 */

require __DIR__ . '/vendor/autoload.php';

use Cake\Database\Driver\Mysql;
use Cake\Database\Connection;

$dotenv = parse_ini_file(__DIR__ . '/.env');

$host = $dotenv['DATABASE_HOSTNAME'] ?? 'localhost';
$dbname = $dotenv['DATABASE_NAME'] ?? 'db_ef';
$username = $dotenv['DATABASE_USER'] ?? 'root';
$password = $dotenv['DATABASE_PASS'] ?? '';

if ($argc < 3) {
    echo "Uso: php update_password.php <correo> <nueva_contrasena>\n";
    echo "Ejemplo: php update_password.php jose@gmail.com 1251\n";
    exit(1);
}

$correo = $argv[1];
$contrasena = $argv[2];

try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    
    $sql = "UPDATE users SET password = :password WHERE correo = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':password' => $hash,
        ':correo' => $correo
    ]);
    
    $filas = $stmt->rowCount();
    
    if ($filas > 0) {
        echo "✓ Contraseña actualizada correctamente para: {$correo}\n";
        echo "  Nueva contraseña: {$contrasena}\n";
    } else {
        echo "✗ No se encontró usuario con el correo: {$correo}\n";
        exit(1);
    }
    
} catch (PDOException $e) {
    echo "✗ Error de conexión: " . $e->getMessage() . "\n";
    exit(1);
}
