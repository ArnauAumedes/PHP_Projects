<?php 
print_r($_GET);
$nom = $_GET['nom'];
$sexe = $_GET['sexe'];
$any = $_GET['any'];
$termes = $_GET['termes'];

?>

<?php
try {
    $conexio = new PDO('mysql:host=localhost;dbname=particules', 'root', '');
    $conexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexió OK" . "<br>";

    // Insertar datos
    $statment = $conexio->prepare("INSERT INTO usuaris (nom, sexe, any, termes) VALUES (:nom, :sexe, :any, :termes)");
    $statment->execute(array(
        ':nom' => $nom,
        ':sexe' => $sexe,
        ':any' => $any,
        ':termes' => $termes
    ));
    
    echo "Dades inserides correctament!<br>";

    // Consultar datos
    $selectStatement = $conexio->prepare("SELECT nom, sexe, any, termes FROM usuaris");
    $selectStatement->execute();

    $resultats = $selectStatement->fetchAll();
    foreach ($resultats as $row) {
        echo $row['nom'] . " - " . $row['sexe'] . " - " . $row['any'] . " - " . $row['termes'] . "<br>";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>