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
    <input type="date" id="date" name="date" placeholder="Date: Année-Mois-Jour" />
    <input type="number" id="duree" min="0" placeholder="Durée de la location  "/>
    <input type="text" id="recherche" placeholder="Taper votre recherche" onkeyup="request('categorie','date','duree','recherche','result');"/>
</form>
<p id="result"> </p>


</body>
</html>