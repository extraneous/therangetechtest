<?php
$point1 = new stdClass();
$point1->type = "point";
$point1->name = "Point 1";
$point1->centerX = 2;
$point1->centerY = 4;
$shapes[] = $point1;

$polygon1 = new stdClass();
$polygon1->type = 'polygon';
$polygon1->name = 'Polygon 1';
$polygon1->coords = array([1,1],[4,5],[2,4]);
$shapes[] = $polygon1;

$polygon2 = new stdClass();
$polygon2->type = 'polygon';
$polygon2->name = 'Polygon 2';
$polygon2->coords = array([1,1],[7,7],[4,6]);
$shapes[] = $polygon2;