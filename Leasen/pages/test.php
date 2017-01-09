<?php
/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 08/12/16
 * Time: 21:54
 */
require('../class/Autoloader.php');
Autoloader::register();
?>
<div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper white">
            
            
            <a href="#" class="brand-logo cyan-text text-darken-4"> Leasen</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">';
            <?php
$page=array('Acceuil'=>array('index.php',1),'Les objets'=>array('proposition.php',2),'Les demandes'=>array('lesdemmandes.php',3),'Proposer un objer'=>array('posterobjet.php',4),'Faire une demande'=>array('fairedemande.php',5),'Guide'=>array('guide.php',6));
       $page_active=1;
      foreach($page as $k =>$v)
      {
      if($page_active==$v[1])
      {
       echo '<li class="active  "><a href="'.$k[0].'" class="cyan-text text-darken-4">'.$k.'</a></li> ';
      }else{
      echo ' <li><a href="'.$k[0].'" class="amber-text text-darken-2">'.$k.'</a></li>';
      }
      }
?>

$page=array('Acceuil'=>array('index.php',1),'Les objets'=>array('proposition.php',2),'Les demandes'=>array('lesdemmandes.php',3),'Proposer un objer'=>array('posterobjet.php',4),'Faire une demande'=>array('fairedemande.php',5),'Guide'=>array('guide.php',6)),'Mon comptes'=>array('moncompte.php',7);
      foreach($page as $k =>$v)
      {
      if($pageactive==$v[1])
      {
       echo '<li class="active  "><a href="'.$k[0].'" class="cyan-text text-darken-4">'.$k.'</a></li> ';
      }else{
      echo ' <li><a href="'.$k[0].'" class="amber-text text-darken-2">'.$k.'</a></li>';
      }
      }
