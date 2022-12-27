<?php
function getAllRestaurants()
{
   global $db;
   $query = "select * from restaurants";
   $statement = $db->prepare($query);
   $statement->execute();

   $results = $statement->fetchAll();  
   $statement->closeCursor();

   return $results;
}

function selectPrice($price_value) {
    if ($price_value == "all-price") {
        return 0;
    } elseif ($price_value == "one-dollar") {
        return 1;
    } elseif ($price_value == "two-dollar") {
        return 2;
    } elseif ($price_value == "three-dollar") {
        return 3;
    } elseif ($price_value == "four-dollar") {
        return 4;
    }
}

function filterRstsByPrice($price)
{
    global $db;
    if ($price == 0) {
        $query = "SELECT * FROM restaurants";
    } else {
        $query = "SELECT * FROM restaurants WHERE price = $price";
    }
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();
    return $results; 
}

function display_price($price) {
    if ($price == "1") {
        return "$";
    } elseif ($price == "2") {
        return "$$";
    } elseif ($price == "3") {
        return "$$$";
    } elseif ($price == "4") {
        return "$$$$";
    }
}

function display_rating($stars) {
    if ($stars == "1") {
        return array("checked", "", "", "", "");
    } elseif ($stars == "2") {
        return array("checked", "checked", "", "", "");
    } elseif ($stars == "3") {
        return array("checked", "checked", "checked", "", "");
    } elseif ($stars == "4") {
        return array("checked", "checked", "checked", "checked", "");
    } elseif ($stars == "5") {
        return array("checked", "checked", "checked", "checked", "checked");
    }
}
