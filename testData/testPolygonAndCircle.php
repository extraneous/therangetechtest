<?php

$polygon1 = new stdClass();
$polygon1->type = 'polygon';
$polygon1->name = 'Polygon 1';
$polygon1->coords = array([1,1],[4,5],[2,4]);
$shapes[] = $polygon1;

$circle1 = new stdClass();
$circle1->type = "circle";
$circle1->name = "Circle 1";
$circle1->radius = 3;
$circle1->centerX = 5;
$circle1->centerY = 5;
$shapes[] = $circle1;

$polygon2 = new stdClass();
$polygon2->type = 'polygon';
$polygon2->name = 'Polygon 2';
$polygon2->coords = array([1,1],[7,7],[4,6]);
$shapes[] = $polygon2;

$circle2 = new stdClass();
$circle2->type = "circle";
$circle2->name = "Circle 2";
$circle2->radius = 5;
$circle2->centerX = -7;
$circle2->centerY = -7;
$shapes[] = $circle2;