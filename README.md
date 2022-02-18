
# The Range - Technical Test
## The Task
**Collision Detection**

Given the 2D coordinates and dimensions of multiple objects on a 2D plane. We want to determine if any of these objects intersect or occupy the same space.
Bonus points if the solution allows for 3D coordinates and/or supports different shapes.

There’s no need to provide a visual solution to this, I’m more interested in seeing the business logic. The shapes and their coordinates can be randomly generated or user-provided. No specific requirement on the structure he should use for the solution or for defining a shape – can be as simple as an array [[0,0],[1,0],[0,1],[1,1]] to define a square of width ‘1’ – I want to be able to see a solution that can be run and verified that it calculates the result correctly.

## My Solution
I have gone for three basic geometry type1:-
1. Points
2. Circles
3. Polygons  
I use basic objects to represent these geometric shapes:-
### Point ###
Attributes are:-  
type: string - "point"  
name: string  
centerX: float  
centerY: float  
### Circle ###
Attributes are:-  
type: string - "circle"  
name: string  
centerX: float  
centerY: float  
radius:  float  
### Polygon ###
Attributes are:-
type: string - "polygon"  
name: string  
coords: array - array of x and y coordinates of the corner points of the polygon  

## Logic ##
main.php pulls in test geomtry into an array of shapes - I have commented out some of these so I could focus on each separeate scenario. The code loops through each shape and tests for collision for the other shapes in the array. A sub function determines which collision function to run by comparing the shape types.

Note: I am not 100% sure that the method used for circle and polygon is the most efficient. I ended up doing:-
1. Is the center of the circle inside the polygon.
2. Is the circle in collision with any of the line end points.
3. Then, only if we have not already detected a collision, Is the circle in collision with the lines making up the polygon.

To run the solution simply type php main.php in a terminal window. This does assume that you have php installed on your computer.