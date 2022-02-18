<?php
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

$polygon3 = new stdClass();
$polygon3->type = 'polygon';
$polygon3->name = 'Polygon 3';
$polygon3->coords = array([5,6],[5,5.5],[10,6]);
$shapes[] = $polygon3;
