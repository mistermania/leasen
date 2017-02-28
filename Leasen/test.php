<html>
<head>
<link href="css/calendar.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
require('class/Autoloader.php');
Autoloader::register(0);
$calendar = new Calendar();

$loc=new Location();
$info=array("id_objet"=>7,"statut_location"=>2);
$res=$loc->find($info);
$c=array();
function dateRange( $first, $last,&$array, $step = '+1 day', $format = 'Y-m-d' ) {

    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        $array[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }

}
foreach ($res as $k)
{
    print_r($k);
    $d=date("Y-m-d",strtotime($k['date_debut']));
    $v=date("Y-m-d",strtotime($k['date_fin']));
    dateRange($d,$v,$c);
}
print_r($c);
echo $calendar->show($c);
?>
</body>
</html>