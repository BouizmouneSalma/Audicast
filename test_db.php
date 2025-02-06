<?php
// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Début du test...\n";

require_once __DIR__ . '/vendor/autoload.php';
echo "Autoload ok...\n";

try {
    echo "Tentative de connexion à la base de données...\n";
    $db = \App\Core\Database::getInstance();
    echo "Connexion à la base de données réussie !\n";
    
    // Test d'une requête simple
    $result = $db->query("SELECT version();")->fetch();
    echo "Version PostgreSQL : " . $result['version'] . "\n";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    echo "Trace : " . $e->getTraceAsString() . "\n";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>