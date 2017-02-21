<?php


$center_x=-93.24;
$center_y=44.99;

$level=3;
$total=pow(4,$level-1);
$cuts=pow(2,$level);

echo $total."<br>";
echo $cuts."<br>";

$interval_x=0.12/$cuts/2;
$interval_y=0.04/$cuts/1.5;

$x_from=$center_x-0.06;
$y_from=$center_y-0.02;

for($i=1;$i<=$cuts;$i++)
{
	for($j=1;$j<=$cuts;$j++)
	{
		echo "(".($x_from+$i*$interval_x).",".($y_from+$j*$interval_y).")";
		getimg($x_from+$i*$interval_x , $y_from+$j*$interval_y , $i, $j);
		//$j++;
	}
	//$i++;
}

function getimg($x,$y,$i,$j)
{
	$url = "http://maps.googleapis.com/maps/api/staticmap?format=jpg&center=".$y.",".$x."&zoom=16&style=feature:road.local|visibility:on&style=feature:landscape.man_made|visibility:on&style=feature:transit.line|visibility:on&style=feature:poi|visibility:on&size=1280x1280&scale=2&key=AIzaSyA7310DYWmSjBtzzYCxGyJo3a5DU7b45pM";

	$ch = curl_init($url);
	$fp = fopen('./cut/'.$i.$j.'.jpg', 'wb');
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);
}

?>

