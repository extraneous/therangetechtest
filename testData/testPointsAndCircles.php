<?php
$point1 = new stdClass();
$point1->type = "point";
$point1->name = "Point 1";
$point1->centerX = 10;
$point1->centerY = 10;
$shapes[] = $point1;

$circle1 = new stdClass();
$circle1->type = "circle";
$circle1->name = "Circle 1";
$circle1->radius = 3;
$circle1->centerX = 11;
$circle1->centerY = 11;
$shapes[] = $circle1;

$point2 = new stdClass();
$point2->type = "point";
$point2->name = "Point 2";
$point2->centerX = -5;
$point2->centerY = -5;
$shapes[] = $point2;

$circle2 = new stdClass();
$circle2->type = "circle";
$circle2->name = "Circle 2";
$circle2->radius = 4;
$circle2->centerX = 0;
$circle2->centerY = 0;
$shapes[] = $circle2;