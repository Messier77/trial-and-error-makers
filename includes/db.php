<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "trialanderror-makers";

foreach($db as $key => $value) {
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli_connection = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

if ($connection) {
    // echo "Connected";
}

function get_connection() {
    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "trialanderror-makers";

    $mysqli_connection = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

    return $mysqli_connection;
}

function get_products() {
    $connection = get_connection();

    $query = "SELECT * FROM products";
    // $select_all_products_query = mysqli_query($connection, $query);
    $select_all_products_query = $connection->query($query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $myArray = $select_all_products_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}
function get_materials() {
    $connection = get_connection();

    $query = "SELECT * FROM materials";
    // $select_all_products_query = mysqli_query($connection, $query);
    $select_all_materials_query = $connection->query($query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $myArray = $select_all_materials_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}
function get_categories() {
    $connection = get_connection();

    $query = "SELECT * FROM categories";
    // $select_all_products_query = mysqli_query($connection, $query);
    $select_all_categories_query = $connection->query($query);
    
        // $myArray = mysqli_fetch_all($select_all_products_query, MYSQLI_ASSOC);
        $myArray = $select_all_categories_query->fetch_all(MYSQLI_ASSOC);
        $results = json_encode($myArray);

    $connection->close();
    return $results;    
}

?>