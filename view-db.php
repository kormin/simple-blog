<?php
/**
 * Original author: https://github.com/kormin
 * Created on: April 20, 2016
**/

require_once 'lib/common.php';

$error='';
// connect to database
if (!$error) {
	// print_r(PDO::getAvailableDrivers());
	$pdo = getPDO();
	if($pdo===false){
		$error = 'PDO error.';
		echo $error;
	}
}
// run query
if(!$error){
	$sql1 = "SELECT * FROM post";
	$sql2 = "SELECT * FROM comment";
	$sql3 = "SELECT * FROM user";
	$qry1 = $pdo->query($sql1);
	$qry2 = $pdo->query($sql2);
	$qry3 = $pdo->query($sql3);
	if ($qry1===false || $qry2===false) {
		$error = 'query error';
		echo $error;
	}
}
// display query
if(!$error){
	$dat1 = fetchPDO($qry1);
	$dat2 = fetchPDO($qry2);
	$dat3 = fetchPDO($qry3);
	disp2d($dat1);
	echo "<br>";
	disp2d($dat2);
	echo "<br>";
	disp2d($dat3);
}
// displays 2d array
function disp2d($arr){
	foreach ($arr as $k1 => $v1) {
		foreach ($v1 as $k2 => $v2) {
			echo $k2.': '.$v2, "<br>";
		}
	}
}
// retrieves query and returns as 2d array
function fetchPDO($query){
	$arr = array();
	$i = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$arr[$i] = array();
		$arr[$i++] = $row;
	}
	return $arr;
}