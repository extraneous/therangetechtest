<?php

function detectCollision($shape1,$shape2){
	if($shape1->type == "point" && $shape2->type == "point"){
		try{
			return detectPointCollision($shape1,$shape2);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == "point" && $shape2->type == "circle"){
		try{
			return detectPointCircleCollision($shape1,$shape2);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == "point" && $shape2->type == "polygon"){
		try{
			return pointInPolygon($shape1,$shape2);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == "circle" && $shape2->type == "point"){
		try{
			return detectPointCircleCollision($shape2,$shape1); 
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	} 
	if($shape1->type == "circle" && $shape2->type == "circle"){
		try{
			return detectCircleCollision($shape1,$shape2);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == 'polygon' && $shape2->type == 'point'){
		try{
			return pointInPolygon($shape2,$shape1);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == 'polygon' && $shape2->type == 'polygon'){
		try{
			return detectPolygonCollision($shape1,$shape2);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == 'polygon' && $shape2->type == 'circle'){
		try{
			return detectCirclePolygonCollision($shape2,$shape1);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
	if($shape1->type == 'circle' && $shape2->type == 'polygon'){
		try{
			return detectCirclePolygonCollision($shape1,$shape2);
		} catch(Exception $e){
			echo "Error " . $e->getMessage() . "\n";
		}
	}
}

function detectPointCollision($point1,$point2){
	/*********************************************
	 * Function detectPointCollision
	 * Param 1: Object with the following properties
	 * 			type: string 'point'
	 * 			name: string
	 * 			centerX: float
	 * 			centerY: float
	 * Param 2: is same as above
	 */
	//Sanitize data
	if(isset($point1->centerX)){
		$point1CenterX = filter_var($point1->centerX,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($point1CenterX)){
			$point1CenterX = false;
		}
	} else {
		$point1CenterX = false;
	}
	if(isset($point1->centerY)){
		$point1CenterY = filter_var($point1->centerY,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($point1CenterY)){
			$point1CenterY = false;
		}
	} else {
		$point1CenterY = false;
	}
	if(isset($point2->centerX)){
		$point2CenterX = filter_var($point2->centerX,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($point2CenterX)){
			$point2CenterX = false;
		}
	} else {
		$point2CenterX = false;
	}
	if(isset($point2->centerY)){
		$point2CenterY = filter_var($point2->centerY,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($point2CenterY)){
			$point2CenterY = false;
		}
	} else {
		$point2CenterY = false;
	}
	if($point1CenterX === false || $point1CenterY === false || $point2CenterX === false || $point2CenterY === false){
		throw new Exception("Bad data passed into detectPointCollision");
	}
	
	if($point1CenterX == $point2CenterX && $point1CenterY == $point2CenterY){
		return true;
	} else {
		return false;
	}
}

function detectPointCircleCollision($point,$circle){
	/**********************************
	 * 
	 */
	//Sanitize data
	if(isset($point->centerX)){
		$pointCenterX = filter_var($point->centerX,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($pointCenterX)){
			$pointCenterX = false;
		}
	} else {
		$pointCenterX = false;
	}
	if(isset($point->centerY)){
		$pointCenterY = filter_var($point->centerY,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($pointCenterY)){
			$pointCenterY = false;
		}
	} else {
		$pointCenterY = false;
	}
	if(isset($circle->radius)){
		$circleRadius = filter_var($circle->radius,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circleRadius)){
			$circleRadius = false;
		}
	} else {
		$circleRadius = false;
	}
	if(isset($circle->centerX)){
		$circleCenterX = filter_var($circle->centerX,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circleCenterX)){
			$circleCenterX = false;
		}
	} else {
		$circleCenterX = false;
	}
	if(isset($circle->centerY)){
		$circleCenterY = filter_var($circle->centerY,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circleCenterY)){
			$circleCenterY = false;
		}
	} else {
		$circleCenterY = false;
	}
	if($pointCenterX === false || $pointCenterY === false || $circleRadius === false || $circleCenterX === false || $circleCenterY === false){
		throw new Exception("Bad data passed into detectPointCircleCollision");
	}	
	if(($pointCenterX == $circleCenterX) && ($pointCenterY == $circleCenterY)){
		return true;
	}
	if($pointCenterX == $circleCenterX){
		//Ensure we allow for numbers that are in the other quadrants (may be negative numbers)
		if($pointCenterY > $circleCenterY){
			$distanceBetweenCenters = abs($pointCenterY - $circleCenterY);
		} else {
			$distanceBetweenCenters = abs($circleCenterY - $pointCenterY);
		}
	} else if($pointCenterY == $circleCenterY){
		if($pointCenterX > $circleCenterX){
			$distanceBetweenCenters = abs($pointCenterX - $circleCenterX);
		} else {
			$distanceBetweenCenters = abs($circleCenterX - $pointCenterX);
		}
	} else {
		//Need to use Pythagoras to calculate distance between center points;
		if($pointCenterX > $circleCenterX){
			$xlength = abs($pointCenterX - $circleCenterX);
		} else {
			$xlength = abs($circleCenterX - $pointCenterX);
		}
		if($pointCenterY > $circleCenterY){
			$ylength = abs($pointCenterY - $circleCenterY);
		} else {
			$ylength = abs($circleCenterY - $pointCenterY);
		}
		$hypotenuse = (pow($xlength,2)) + (pow($ylength,2));
		$distanceBetweenCenters = sqrt($hypotenuse);
	}
		if($distanceBetweenCenters < $circleRadius){
		return true;
	} else {
		return false;
	}
}
function detectCircleCollision($circle1,$circle2){
	//Sanitize data
	if(isset($circle1->radius)){
		$circle1Radius = filter_var($circle1->radius,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circle1Radius)){
			$circle1Radius = false;
		}
	} else {
		$circle1Radius = false;
	}
	if(isset($circle2->radius)){
		$circle2Radius = filter_var($circle2->radius,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circle2Radius)){
			$circle2Radius = false;
		}
	} else {
		$circle2Radius = false;
	}
	if(isset($circle1->centerX)){
		$circle1CenterX = filter_var($circle1->centerX,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circle1CenterX)){
			$circle1CenterX = false;
		}
	} else {
		$circle1CenterX = false;
	}
	if(isset($circle1->centerY)){
		$circle1CenterY = filter_var($circle1->centerY,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circle1CenterY)){
			$circle1CenterY = false;
		}
	} else {
		$circle1CenterY = false;
	}
	if(isset($circle2->centerX)){
		$circle2CenterX = filter_var($circle2->centerX,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circle2CenterX)){
			$circle2CenterX = false;
		}
	} else {
		$circle2CenterX = false;
	}
	if(isset($circle2->centerY)){
		$circle2CenterY = filter_var($circle2->centerY,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		if(!is_numeric($circle2CenterY)){
			$circle2CenterY = false;
		}
	} else {
		$circle2CenterY = false;
	}
	//Throw an error if we have some bad data
	if($circle1Radius === false || $circle2Radius === false || $circle1CenterX === false || $circle1CenterY === false || $circle2CenterX === false || $circle2CenterY === false){
		throw new Exception("Bad data passed into detectCircleCollision");
	}
	
	$radiiSum = $circle1Radius + $circle2Radius;
	if($circle1CenterX == $circle2CenterX){
		//Allow for numbers in different quadrants (i.e. numbers may be negative)
		if($circleCenterY > $circle2CenterY){
			$distanceBetweenCenters = abs($circle1CenterY - $circle2CenterY);
		} else {
			$distanceBetweenCenters = abs($circle1CenterY - $circle2CenterY);
		}
	} else if($circle1CenterY == $circle2CenterY){
		if($circle1CenterX > $circle2CenterX){
			$distanceBetweenCenters = abs($circle1CenterX - $circle2CenterX);
		} else {
			$distanceBetweenCenters = abs($circle2CenterX - $circle1CenterX);
		}
	} else {
		//Need to use Pythagoras to calculate distance between center points;
		if($circle1CenterX > $circle2CenterX){
			$xlength = abs($circle1CenterX - $circle2CenterX);
		} else {
			$xlength = abs($circle2CenterX - $circle1CenterX);
		}
		if($circle1CenterY > $circle2CenterY){
			$ylength = abs($circle1CenterY - $circle2CenterY);
		} else {
			$ylength = abs($circle2CenterY - $circle1CenterY);
		}
		$hypotenuse = (pow($xlength,2)) + (pow($ylength,2));
		$distanceBetweenCenters = sqrt($hypotenuse);
	}
	if($distanceBetweenCenters < $radiiSum){
		return true;
	} else {
		return false;
	}
}

function pointInPolygon($point, $polygon) {
	/***************************************
	 * 
	 */
	function pointOnVertex($point, $vertices) {
		foreach($vertices as $vertex) {
			if ($point == $vertex) {
				return true;
			}
		}
	}
	// Transform string coordinates into arrays with x and y values
	$point = array($point->centerX,$point->centerY);
	$vertices = $polygon->coords; 
	$verticesCount = count($verticess);
	//check to see if the shape is closed
	if ($vertices[$verticesCount - 1] !== $vertices[0]) {
		$vertices[] = $vertices[0];
	}

	// Check if the point sits exactly on a vertex
	if (pointOnVertex($point, $vertices) == true) {
		return true;
	}

	// Check if the point is inside the polygon or on the boundary
	$intersections = 0; 
	$vertices_count = count($vertices);

	for ($i=1; $i < $vertices_count; $i++) {
		$vertex1 = $vertices[$i-1]; 
		$vertex2 = $vertices[$i];
		if ($vertex1[1] == $vertex2[1] and $vertex1[1] == $point[1] and $point[0] > min($vertex1[0], $vertex2[0]) and $point[0] < max($vertex1[0], $vertex2[0])) { // Check if point is on an horizontal polygon boundary
			return true;
		}
		if ($point[1] > min($vertex1[0], $vertex2[0]) and $point[0] <= max($vertex1[0], $vertex2[1]) and $point[0] <= max($vertex1[0], $vertex2[0]) and $vertex1[1] != $vertex2[1]) { 
			$xinters = ($point[1] - $vertex1[1]) * ($vertex2[0] - $vertex1[0]) / ($vertex2[1] - $vertex1[1]) + $vertex1[0]; 
			if ($xinters == $point[0]) { // Check if point is on the polygon boundary (other than horizontal)
				return true;
			}
			if ($vertex1[0] == $vertex2[0] || $point[0] <= $xinters) {
				$intersections++; 
			}
		} 
	} 
	// If the number of edges we passed through is odd, then it's in the polygon. 
	if ($intersections % 2 != 0) {
		return true;
	} else {
		return false;
	}
}

function detectPolygonCollision ($polygon1, $polygon2) {
	/*********************************
	 * 
	 */
    $outputList = $polygon1->coords;
    $cp1 = end($polygon2->coords);
    foreach ($polygon2->coords as $cp2) {
        $inputList = $outputList;
        $outputList = [];
        $s = end($inputList);
        foreach ($inputList as $e) {
            if (inside($e, $cp1, $cp2)) {
                if (!inside($s, $cp1, $cp2)) {
                    $outputList[] = intersection($cp1, $cp2, $e, $s);
                }
                $outputList[] = $e;
            }
            else if (inside($s, $cp1, $cp2)) {
                $outputList[] = intersection($cp1, $cp2, $e, $s);
            }
            $s = $e;
        }
        $cp1 = $cp2;
    }
	if(sizeof($outputList) == 0){
		return false;
	} else {
		return true;
	}
}

function inside ($p, $cp1, $cp2) {
	return ($cp2[0]-$cp1[0])*($p[1]-$cp1[1]) > ($cp2[1]-$cp1[1])*($p[0]-$cp1[0]);
}

function intersection ($cp1, $cp2, $e, $s) {
	$dc = [ $cp1[0] - $cp2[0], $cp1[1] - $cp2[1] ];
	$dp = [ $s[0] - $e[0], $s[1] - $e[1] ];
	$n1 = $cp1[0] * $cp2[1] - $cp1[1] * $cp2[0];
	$n2 = $s[0] * $e[1] - $s[1] * $e[0];
	$n3 = 1.0 / ($dc[0] * $dp[1] - $dc[1] * $dp[0]);

	return [($n1*$dp[0] - $n2*$dc[0]) * $n3, ($n1*$dp[1] - $n2*$dc[1]) * $n3];
}

function detectCirclePolygonCollision($circle,$polygon){
	//First detect if the circle is within the Polygon
	if(cirlceInsidePolygon($circle,$polygon)){
		return true;
	} else {
		//loop through each point of the polgon and test for collision with circle
		for($i=0;$i<sizeof($polygon->coords) -1;$i++){
			$point = new stdClass();
			$point->centerX = $polygon->coords[$i][0];
			$point->centerY = $polygon->coords[$i][1];
			if(detectPointCircleCollision($point,$circle)){
				return true;
			}
		}
	}
	//If we make it to here then check each line of the polygon against the circle
	for($i=0;$i<sizeof($polygon->coords) -1;$i++){
		$line = new stdClass();
		$line->startPoint = $polygon->coords[$i];
		$line->endPoint = $polygon->coords[$i + 1];
		if(checkLineToCircle($line,$circle)){
			return true;
		}
	}
	//If we make it this far then no collisions so return false
	return false;
}

function cirlceInsidePolygon($circle,$polygon){
	$centerX = $circle->centerX;
	$centerY = $circle->centerY;
	$coords = $polygon->coords;
    
    $inside = false;
    for($i = 0, $j = sizeof($coords) - 1; $i < sizeof($coords); $j = $i++) {

        $xi = $coords[$i][0]; 
		$yi = $coords[$i][1];
        $xj = $coords[$j][0];
		$yj = $coords[$j][1];
        
        $intersect = (($yi > $centerY) != ($yj > $centerY))
            && ($centerX < ($xj - $xi) * ($centerY - $yi) / ($yj - $yi) + $xi);
        if ($intersect){
			$inside = !$inside;
		}
    }
    
    return $inside;
}

function checkLineToCircle($line,$circle){
	$x1 = $line->startPoint[0];
	$y1 = $line->startPoint[1];
	$x2 = $line->endPoint[0];
	$y2 = $line->endPoint[1];
	$xc = $circle->centerX;
	$yc = $circle->centerY;
	$rc = $circle->radius;
	
    $ac = [$xc - $x1, $yc - $y1];
    $ab = [$x2 - $x1, $y2 - $y1];
    $ab2 = dot($ab, $ab);
    $acab = dot($ac, $ab);
    $t = $acab / $ab2;
    $t = ($t < 0) ? 0 : $t;
    $t = ($t > 1) ? 1 : $t;
    $h = [($ab[0] * $t + $x1) - $xc, ($ab[1] * $t + $y1) - $yc];
    $h2 = dot($h, $h);
    return $h2 <= $rc * $rc;
}

function dot($v1, $v2){
    return ($v1[0] * $v2[0]) + ($v1[1] * $v2[1]);
}