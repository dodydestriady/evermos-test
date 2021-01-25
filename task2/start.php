<?php

$grid = [
    0 => ["#", "#", "#", "#", "#", "#", "#", "#"],
    1 => ["#", ".", ".", ".", ".", ".", "$", "#"],
    2 => ["#", ".", "#", "#", "#", ".", ".", "#"],
    3 => ["#", ".", ".", ".", "#", ".", "#", "#"],
    4 => ["#", "x", "#", ".", ".", ".", ".", "#"],
    5 => ["#", "#", "#", "#", "#", "#", "#", "#"],
];

$routes[0] = [
    'path' => [],
    'direction' => [],
    'done' => 0,
];

$count = 0;
$run = 0;
while($count != count($routes)) {
    find_treasure($grid, $run);
    $count = count_routes_done();
    $run++;
}

$routes = array_filter($routes, function($var){
    return end($var['direction']) == 'Found';
});
usort($routes, function ($a, $b) {
    return count($a['path']) <=> count($b['path']);
});

render($grid, $routes[0]);

// functions
function route_exist($index){
    global $routes;
    $count = count($routes);
    for($i = 0; $i < $count; $i++) {
        if( $i != $index && (strcmp(json_encode($routes[$index]['path']), json_encode($routes[$i]['path'])) == 0))
        {
            return true;
        }
    }
    return false;
}

function count_routes_done() {
    global $routes;
    $count = 0;
    for($i = 0; $i < count($routes); $i++){
        if($routes[$i]['done'] == true){
            $count++;
        }
    }
    return $count++;
}

function render($grid, $route)
{
    $row = count($grid);
    $col = count($grid[0]);
    for($i = 0; $i < $row; $i++){
        for($j = 0; $j <$col; $j++){
            $value = $grid[$i][$j];
            if($value == "." && in_array([$i, $j], $route['path'])) {
                $key = array_search([$i, $j], $route['path']);
                switch ($route['direction'][$key]) {
                    case 'Up' :
                        echo "^ ";
                        break;
                    case 'Down' :
                        echo "v ";
                        break;
                    case 'Left' :
                        echo "< ";
                        break;
                    case 'Right' :
                        echo "> ";
                        break;
                }
            } else {
                echo $value." ";
            }
        }
        echo PHP_EOL;
    }
    foreach($route['direction'] as $key => $direction) {
        echo ($key+1).". $direction \n";
    }
    echo PHP_EOL;
}

function scan($grid)
{
    $scan = ['obstacles' => [], 'clear_paths' => [], 'treasure' => [], 'x_position' => []];
    $row = count($grid);
    $col = count($grid[0]);
    for($i = 0; $i < $row; $i++){
        for($j = 0; $j <$col; $j++){
            $value = $grid[$i][$j];
            switch($value) {
                case "#":
                    if( !in_array( [$i, $j], $scan['obstacles'] ) ){
                        $scan['obstacles'][] = [$i, $j];
                    }
                    break;
                case ".":
                    if( !in_array( [$i, $j], $scan['clear_paths'] ) ){
                        $scan['clear_paths'][] = [$i, $j];
                    }
                    break;
                case "$":
                    $scan['treasure'] = [$i, $j];
                    $scan['clear_paths'][] = [$i, $j];
                    break;
                case "x":
                    $scan['x_position'] = [$i, $j];
                    break;
            }
        }
    }
    return $scan;
}

function move($to, $from) {
    $move = false;
    switch ([$to[0] - $from[0], $to[1] - $from[1]]) {
        case [-1, 0]:
            $move = 'Up';
            break;
        case [1, 0]:
            $move = 'Down';
            break;
        case [0, -1]:
            $move = 'Left';
            break;
        case [0, 1]:
            $move = 'Right';
            break;
    }
    return $move;
}

function find_treasure($grid, $route_options = 0)
{
    global $routes;
    if ($route_options == 0) {
        $scan = scan($grid);
        $routes[0]['path'][] = $scan['x_position'];
        $routes[0]['direction'][] = 'start';
    }
    $x_position = end($routes[$route_options]['path']);
    $route_split = count($routes);
    while ($routes[$route_options]["done"] == 0) 
    {   
        $move = 0;
        for($i = -1; $i < 2 ; $i++){
            for($j = -1; $j < 2 ; $j++){
                $rowId = $x_position[0] + $i;
                $colId = $x_position[1] + $j;
                $value = $grid[$rowId][$colId];
                if ($value != '#' 
                && !in_array([$rowId, $colId], $routes[$route_options]['path']) 
                && $direction = move([$rowId, $colId], $x_position)) {
                    if ($move > 0) {

                        while( array_key_exists($route_split, $routes) ) {
                            $route_split++;
                        }
                        $routes[$route_split] = $routes[$route_options];
                        $routes[$route_split]["path"][] = [$rowId, $colId];
                        $routes[$route_split]["direction"][] = $direction;
                        
                        if ($value == '$') {
                            $routes[$route_split]["path"][] = [$rowId, $colId];
                            $routes[$route_split]["direction"][] = "Found";
                            $routes[$route_split]["done"] = 1;
                        } 
                    }
                    if($move == 0){
                        $routes[$route_options]["path"][] = $x_position;
                        $routes[$route_options]["direction"][] = $direction;
                            
                        if( !route_exist($route_options)) {
                            $move++;
                            $x_position = [$rowId, $colId];
                        } else {
                            array_pop($routes[$route_options]['path']); 
                            array_pop($routes[$route_options]['direction']);
                        }
                        if ($value === '$') {
                            $routes[$route_options]["path"][] = [$rowId, $colId];
                            $routes[$route_options]["direction"][] = "Found";
                            $routes[$route_options]["done"] = 1;
                            $i = 1;
                            $j = 1;
                        }
                    }

                    
                }
                if($i == 1 && $j == 1 && $move == 0) {
                    $routes[$route_options]["done"] = 1;
                }
            }
        }
    }
}
