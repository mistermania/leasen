<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="js/research.js"></script>
    <script type="text/javascript" src="js/xhr.js"></script>
    <script type="text/javascript" src="js/posterobjet.js"></script>
</head>
<body>
<?php
    require('class/Autoloader.php');
    Autoloader::register();
    $req = 'id_type > 1';
    $ty = new Type();
    $res=$ty->find($req);
?>
<h1>Poster une annonce</h1>
<form method="post" action="./newobjet.php">
    <label for="nom">Titre de l'annonce</label><br />
    <input type="text" id="nom" name="nom" placeholder="Ex: Appareil à Raclette"/><br />

    <select id="categorie" name="categorie" >
        <option value="0">Categories</option>
        <?php
        foreach ($res as $k =>$v)
        {
            echo "\t\t\t\t<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>\n";
        }
        ?>
    </select> <br />

    <label for="description">Description du bien</label><br />
    <textarea name="description" id="description" placeholder="Ex: Appareil pour 8 personnes"></textarea><br />
    <input type="button" value="Ajouter un prix" onclick="afficher_cacher('id_div_prix'); "><br />
    <div id="id_div_prix" style="display:none">
        <label for="prix">Prix de la location à la journée </label><br />
        <input type="number" id="prix" name="prix" min="0" value="0"/>€<br/>
    </div>

    <input type="button" value="Ajouter une caution" onclick="afficher_cacher('id_div_caution');"><br />
    <div id="id_div_caution" style="display:none">
        <input type="number" id="prix_caution" name="prix_caution" min="0" value="0"/>€<br />
    </div>

    <input type="submit"  value="Poster" >
</form>
</body>
</html>