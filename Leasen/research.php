<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=leasen;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$recherche = $_POST['recherche'];
$categorie = $_POST['categorie'];
$date = $_POST['date'];
$sql = "SELECT * FROM objet WHERE nom LIKE '%" . $recherche.'%\'  AND categorie = \''.$categorie.'\' AND date = \''.$date.'\'';
$obj = new Objet();
$req = $bdd->query($sql);

?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Categorie</th>
        <th>Date</th>
        <th>Nom</th>
    </tr>
    <?php
    while ($donnees = $req->fetch()) {
        ?>
        <tr>
            <td><?php echo $donnees['id']; ?> </td>
            <td><?php echo $donnees['categorie']; ?> </td>
            <td><?php echo $donnees['date']; ?> </td>
            <td><?php echo $donnees['nom']; ?> </td>
        </tr>
        <?php
    }
   $req->closeCursor();
    ?>
</table>






