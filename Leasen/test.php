<html>
<head>

</head>
<body>
<?php
require('class/Autoloader.php');
Autoloader::register(0);
$calendar = new Calendar();
echo $calendar->afficheCalendrierObjet(7);
?>
</body>
</html>