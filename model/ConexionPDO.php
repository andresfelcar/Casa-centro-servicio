<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=u241751678_casacentros', 'root', '');
    echo 'Conectado';
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>