<?php
require_once 'functions.php';

//Declare an array to hold the geometry
$shapes = array();
//pull in shapes from an external file to make it easy to draw in other test data later
//require_once 'testData/testCircles.php';
//require_once 'testData/testPoints.php';
//require_once 'testData/testPointsAndCircles.php';
//require_once 'testData/testPointInPolygon.php';
//require_once 'testData/testPolygonAndPolygon.php';
require_once 'testData/testPolygonAndCircle.php';

for($ix=0;$ix<sizeof($shapes) - 1;$ix++){
	$shape1 = $shapes[$ix];
	for($iv = $ix + 1;$iv < sizeof($shapes);$iv++){
		$shape2 = $shapes[($iv)];
		echo "Detecting collision between " . $shape1->name . " and " . $shape2->name . "\n";
		$collision = detectCollision($shape1,$shape2);
		if($collision){
			echo $shape1->name . " is in collision with " . $shape2->name . "\n";
		}
	}
}
