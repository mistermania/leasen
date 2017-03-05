<?php
require('../class/Autoloader.php');
Autoloader::register(1);
$newuser = new Utilisateur();
$nom = filter_input(INPUT_POST, 'nom');
$prenom = filter_input(INPUT_POST, 'prenom');
$e_mail = filter_input(INPUT_POST, 'user_email');
$mot_de_passe = filter_input(INPUT_POST, 'pass');
$telephone = filter_input(INPUT_POST, 'numerotel');
$partager_telephone = filter_input(INPUT_POST, 'telchoix');
//echo "$nom / $prenom / $e_mail / $mot_de_passe / $telephone / $partager_telephone <br/>";
$userInfos = array('nom' => $nom, 'prenom' => $prenom, 'e_mail' => $e_mail, 'mot_de_passe' => $mot_de_passe, 'telephone' => $telephone, 'partager_telephone' => (int) $partager_telephone);
$test = $newuser->insert($userInfos);
/**
 * @param $info array contenant : nom, prenom, email, partager_telephone, telephone,statut, mot de passe
 * @return int 1 : nom, prenom et email absent
 * @return int 2 :le numero de telephone n'est pas un numero de telpehone valide
 * @return int 3 : adresse mail invalide
 * @return int 4 : mot de passe trop faible (moins de 8 caractère, absence d'une chiffre, d'une majuscule et d'une minuscule
 * @return int 5 : adresse déja presente dans la base de donnée
 * @return int 6 : numero deja present dans la base de donnée
 * @return int 0 : insertion reussie
 */


if ($test == 0) {
    ?>
    <form name="redirect" action="../pages/connexion.php" method="post">
        <input type="hidden" id="resu" name="resu" value="<?php echo $test; ?>" >
    </form>
    <?php
} else {
    ?>
    <form name="redirect" action="../pages/inscription.php" method="post">
        <input type="hidden" id="resu" name="resu" value="<?php echo $test; ?>" >
    </form>
    <?php
}
include "../fonctions/footer.php";
?>

<script type="text/javascript">
    document.redirect.submit();
</script>