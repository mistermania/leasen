<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="js/research.js"></script>
    <script type="text/javascript" src="js/xhr.js"></script>

</head>
<body>
<?php
require('class/Autoloader.php');
Autoloader::register();
$req = 'id_type > 1';
$ty = new Type();
$res=$ty->find($req);
?>
<form>
    <select id="categorie" >
        <option value="0">Toutes les categories</option>
        <?php
        foreach ($res as $k =>$v)
        {
            echo "\t\t\t\t<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>\n";
        }
        ?>

    </select>
    <input type="date" id="date" name="date" />
    <input type="text" id="recherche" onkeyup="request('categorie','date','recherche','result');"/>
</form>
<p id="result"> resultat</p>

<?php
/* $sql = 'SELECT * FROM objet WHERE nom = "velo" AND date = "2017-01-01" AND categorie = "vehicule"';
 $retour = $bdd->query($sql);
 while ($donnees = $retour->fetch()) {
     echo "nom = ".$donnees["nom"]." categorie = ".$donnees["categorie"]." date = ".$donnees["date"]."";
 }*/


?>
</body>
</html>