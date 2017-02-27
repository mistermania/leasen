<?php
$message="";
$Limg="";
var_dump($_FILES);
if (isset($_FILES['fichier'])) $LeFic=trim($_FILES['fichier']['name']);
else $LeFic="";
if(  $LeFic!="" )
{
    $destination="";
    $extensions_ok = array ( ".jpg",".rar",".gif",".png");
    if (in_array(strtolower(substr($LeFic, -4)),$extensions_ok))
    {
        //========= bonne  extention on copie =====
        copy($_FILES['fichier']['tmp_name'],$destination.$LeFic);
    }
}
?>
<html><body><br /><p align=center>
    <br />
<form name="formulaire" method="POST"  action="test.php"  enctype="multipart/form-data" >
    <input id="fichier1"  name="fichier" type="file"  />
    <input value="Valider" name="submit" type="submit" />
</form><br />
</p>
</body></html>