<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="js/research.js"></script>
        <script type="text/javascript" src="js/xhr.js"></script>
      
    </head>
    <body>
         <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=leasen;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        ?>
        <form> 
                <select id="categorie" >
                    <option value="0">Toutes les categories</option>
                    <?php
                    $req = $bdd->query('SELECT DISTINCT categorie FROM objet');
                    while ($donnees = $req->fetch()) {
                         echo "\t\t\t\t<option value=\"" . $donnees["categorie"] . "\">" . $donnees["categorie"] . "</option>\n";
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